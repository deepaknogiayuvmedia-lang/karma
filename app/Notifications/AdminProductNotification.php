<?php

namespace App\Notifications;

use App\Model\Product;
use App\Model\Seller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminProductNotification extends Notification
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
        $seller = Seller::find($this->product->seller_id);
        $sellerName = $seller ? ($seller->shop->name ?? $seller->f_name . ' ' . $seller->l_name) : 'Admin';

        return (new MailMessage)
            ->subject("Product {$actionText}: {$this->product->name}")
            ->greeting("Hello Admin!")
            ->line("A product has been {$this->action}.")
            ->line("Product: {$this->product->name}")
            ->line("Code: {$this->product->code}")
            ->line("Price: ₹{$this->product->unit_price}")
            ->line("Seller: {$sellerName}")
            ->line($this->message ? "Note: {$this->message}" : '')
            ->action('View Product', route('admin.product.view', $this->product->id))
            ->line('Thank you!');
    }

    public function toArray($notifiable)
    {
        $seller = Seller::find($this->product->seller_id);

        return [
            'product_id' => $this->product->id,
            'product_name' => $this->product->name,
            'product_code' => $this->product->code,
            'seller_id' => $this->product->seller_id,
            'seller_name' => $seller ? ($seller->shop->name ?? $seller->f_name) : 'Admin',
            'action' => $this->action,
            'message' => $this->message,
            'created_at' => now()->toDateTimeString(),
        ];
    }
}
