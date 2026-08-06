<?php

namespace App\Notifications;

use App\Model\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductStatusNotification extends Notification
{
    use Queueable;

    protected $product;
    protected $action;
    protected $message;

    public function __construct(Product $product, $action, $message = null)
    {
        $this->product = $product;
        $this->action = $action;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        $actionText = ucfirst(str_replace('_', ' ', $this->action));

        return (new MailMessage)
            ->subject("Product {$actionText}: {$this->product->name}")
            ->greeting("Hello {$notifiable->f_name}!")
            ->line("Your product \"{$this->product->name}\" has been {$this->action}.")
            ->line("Product Code: {$this->product->code}")
            ->line("Price: ₹{$this->product->unit_price}")
            ->line($this->message ? "Note: {$this->message}" : '')
            ->action('View Product', route('seller.product.view', $this->product->id))
            ->line('Thank you for using our marketplace!');
    }

    public function toArray($notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'product_code' => $this->product->code,
            'action' => $this->action,
            'message' => $this->message,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}
