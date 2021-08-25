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
        $orderNotifications= $Admin->notifications->where('type','App\Notifications\UserDeleted');
        $userdelNotifications = $Admin->notifications->where('type','App\Notifications\UserDeleted');
//        dd($userdelNotifications);
        $created_at = [];

        for($i = 0 ; $i < count($Admin-> notifications);$i++)
            $created_at[$i] = Carbon::parse($Admin->notifications[$i]->created_at);
                for($j = 0 ; $j < 2; $j++)
                    $norarr [$i][$j] =


        $notifications = [

            [

                'icon' => 'fas fa-fw fa-shopping-cart',
                'text' =>  $userdelNotifications->pluck('data'),
            ]
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
        $userdelNotifications->markAsRead();
        return [
            'label'       => count($notifications),
            'label_color' => 'danger',
            'icon_color'  => 'dark',
            'dropdown'    => $dropdownHtml,
        ];

    }
}
