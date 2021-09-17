<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NotificationsController extends Controller
{
    public  function getNotificationsData()
    {
        $Admin = Auth::guard('admin')->user();
        $orderNotifications= $Admin->unreadNotifications->where('type' , 'App\Notifications\OrderPlaced');
        $userdelNotifications = $Admin->unreadNotifications->where('type','App\Notifications\UserDeleted');


        $notifications = [
            [ 
                'icon' => 'fas fa-fw fa-shopping-cart',
                'text' => $orderNotifications->first()['data']['message'],

            ] ,

            [

                'icon' => 'fas fa-fw fa-delete',
                'text' =>  $userdelNotifications->first()['data']['message'],
            ],

        ];
        $dropdownHtml = '';

        foreach ($notifications as $key => $not) {
            $icon = "<i class='mr-2 {$not['icon']}'></i>";

            

            $dropdownHtml .= "<a href='' class='dropdown-item'>
                            {$icon}{$not['text']}
                          </a>";

            if ($key < count($notifications) - 1) {
                $dropdownHtml .= "<div class='dropdown-divider'></div>";
            }
        }

        // Return the new notification data.
            $orderNotifications->markAsRead();
            $userdelNotifications->markAsRead();


        return [
            'label'       => count($notifications),
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];


    }
}
