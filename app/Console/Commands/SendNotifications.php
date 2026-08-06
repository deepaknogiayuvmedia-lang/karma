<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;
use App\User;
use App\Model\Notification;
use Google\Client;
use Illuminate\Support\Facades\Http;

class SendNotifications extends Command
{
    protected $signature = 'send:notifications';
    protected $description = 'Send notifications to users';

    public function handle()
    {
        // Only fetch active notifications not yet dispatched by the cron command
        $notification = Notification::active()->unsent()->latest()->first();

        if (!$notification) {
            $this->warn('No pending notification found. Create a new one from the Admin panel or resend an existing one.');
            return;
        }

        $title            = $notification->title;
        $body             = $notification->description;
        $image            = $notification->image;
        $roleType         = $notification->role_type;
        $notificationType = $notification->notification_type;

        $this->info("Sending \"{$roleType}\" notification: \"{$title}\"");

        // Dynamically choose model based on role_type
        $query = ($roleType === 'seller') ? \App\Model\Seller::query() : \App\User::query();
        $query->chunk(100, function ($recipients) use ($title, $body, $image, $notificationType) {
            foreach ($recipients as $recipient) {
                // Determine firebase token field (cm_firebase_token is standard)
                $fcmToken = $recipient->cm_firebase_token;

                // Push notification (only if token exists)
                if (!empty($fcmToken)) {
                    $this->sendNotification($fcmToken, $title, $body, $image);
                }

                // Email notification
                if (!empty($recipient->email)) {
                    $name = trim(($recipient->f_name ?? '') . ' ' . ($recipient->l_name ?? '')) ?: ($recipient->name ?? 'User');
                    try {
                        Mail::to($recipient->email)->send(new NotificationMail($title, $body, $name, $notificationType));
                    } catch (\Exception $e) {
                        $this->error("Failed to send email to {$recipient->email}: " . $e->getMessage());
                    }
                }
            }
        });

        // Mark as sent so it won't be dispatched again automatically
        $notification->cron_sent = true;
        $notification->save();

        $this->info('Notifications sent successfully');
    }

    // 🔥 Send Push Notification
    private function sendNotification($token, $title, $body,$image)
    {
        $accessToken = $this->getAccessToken();
        $url = "https://fcm.googleapis.com/v1/projects/multi-vendor-5d507/messages:send";

        $response = Http::withToken($accessToken)->post($url, [
            "message" => [
                "token" => $token,
                "notification" => [
                    "title" => $title,
                    "body"  => $body,
                    "image" => asset(config('app.public_storage_path') . '/notification') . '/' . $image
                ],
            ]
        ]);

        return $response->json();
    }

    // 🔐 OAuth Token
    private function getAccessToken()
    {
        $client = new Client();
        $client->setAuthConfig(public_path('firebase-service-account.json'));
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');

        $client->fetchAccessTokenWithAssertion();

        $token = $client->getAccessToken();

        return $token['access_token'];
    }
}