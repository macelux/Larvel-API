<?php

namespace App\Providers;

use App\Providers\Created;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class SendCreationNotification
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
     * @param  Created  $event
     * @return void
     */
    public function handle(Created $event)
    {

//        return $event->model->toArray();
//        dd($event->model);
        return redirect()->route('products.index');


    }
}
