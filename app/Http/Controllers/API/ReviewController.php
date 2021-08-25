<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Product_review;

class ReviewController extends Controller
{
    public function index()
    {
        return   ReviewResource::collection(Review::paginate());

    }
    public function show($id)
    {
        $Review = Review::findorfail($id);

            return  new  ReviewResource($Review);


        //return response()->json($user);
    }
    public function store(StoreReviewRequest $request)
    {
        $request->headers->set('Accept' , 'application/json');
        $params = $request->except('_token');
        $Review = Review::create($params);
        Product_review::create([
            "product_id" => $request->product_id,
            "review_id" =>$Review->id
            ]);
        return new  ReviewResource($Review);


    }



    public function update(UpdateReviewRequest $request , $id)
    {
        $Review = Review::findorfail($id);

        if(auth()->user()->id  == $Review->customer_id)
        {
            $params = $request->except('_token');
            $Review->update($params);
            $Review->save();
            return new  ReviewResource($Review);


        }
        else
        {
            return response(['message' => 'you can only modify your own Review'] , 401);
        }
    }

    public function destroy($id)
    {
        // get user
        $Review = Review::findorfail($id);
        if(auth()->user()->id  == $Review->customer_id)
        {
            if($Review->delete()){
                return  new ReviewResource($Review);
            }
        }
        else
        {
            return response(['message' => 'you can only delete your own Review'] , 401);
        }

    }




}
