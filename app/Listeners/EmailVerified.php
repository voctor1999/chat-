<?php

namespace App\Listeners;

//删掉use App\Providers\Verified;
use Illuminate\Auth\Events\Verified; // [修改] 替换为正确的事件类
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailVerified
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
     * @param  Illuminate\Auth\Events\Verified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        session()->flash('success', '恭喜您，邮箱账号激活成功！');
    }
}
