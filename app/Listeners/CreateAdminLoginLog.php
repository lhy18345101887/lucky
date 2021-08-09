<?php

namespace App\Listeners;

use App\Events\AdminLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Model\Admin\LoginLog;

class CreateAdminLoginLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminLogin  $event
     * @return void
     */
    public function handle(AdminLogin $event)
    {
        LoginLog::create([
            'name' => $event->getUserName(),
            'ip' => $event->getUserIp(),
            'type' => $event->getLoginType(),
            'msg' => $event->getMsg(),
        ]);
    }
}
