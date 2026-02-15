<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * Create a new notification.
     */
    public static function create(User $user, string $type, string $title, string $message, ?string $actionUrl = null)
    {
        return Notification::create([
            'user_id' => $user->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'action_url' => $actionUrl,
        ]);
    }

    /**
     * Send notification to all admins.
     */
    public static function notifyAllAdmins(string $type, string $title, string $message, ?string $actionUrl = null)
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            self::create($admin, $type, $title, $message, $actionUrl);
        }
    }

    /**
     * Send new order notification.
     */
    public static function newOrder(User $admin, $orderId, $customerName)
    {
        return self::create(
            $admin,
            'order',
            'New Order Received',
            "New order from {$customerName}",
            route('admin.orders.show', $orderId)
        );
    }

    /**
     * Send low stock notification.
     */
    public static function lowStock(User $admin, $productName, $stock)
    {
        return self::create(
            $admin,
            'product',
            'Low Stock Alert',
            "{$productName} is running low on stock ({$stock} units remaining)",
            route('admin.products.index')
        );
    }

    /**
     * Send new user registration notification.
     */
    public static function newUserRegistration(User $admin, $userName)
    {
        return self::create(
            $admin,
            'user',
            'New User Registered',
            "{$userName} has registered on the platform",
            route('admin.users.index')
        );
    }
}