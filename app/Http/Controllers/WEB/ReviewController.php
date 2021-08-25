<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
     public function index()
        {
            $Reviews = Review::with(['user' , 'product'])->get();

            for($i  = 0 ; $i < count($Reviews) ; $i++)
            {
                $Reviews[$i]->count = $i + 1;
            }



            return view('pages.reviews' , compact('Reviews'));
        }
}
