<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserActionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $action;
    public $details;

    /**
     * Create a new event instance.
     *
     * @param mixed $user ผู้ใช้ที่ทำการกระทำ
     * @param string $action การกระทำ เช่น 'created', 'deleted'
     * @param array $details รายละเอียดเพิ่มเติม เช่น ['post_id' => 1]
     */
    public function __construct($user, string $action, array $details = [])
    {
        $this->user = $user;
        $this->action = $action;
        $this->details = $details;
    }
}