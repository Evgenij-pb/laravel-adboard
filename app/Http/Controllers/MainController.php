<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();

        $ads=Ad::where('is_verified','1')->orderBy('created_at', 'DESC')->whereDate('expires_at', '>', Carbon::now())->paginate(6);

        return view('main.index',[
            'categories' => $categories,
            'ads'=>$ads,
        ]);
    }

    /**
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function allInCategory($categoryId)
    {
        $ads=Ad::where("category_id","=","{$categoryId}")->where('is_verified','1')->whereDate('expires_at', '>', Carbon::now())->orderBy('created_at', 'DESC')->paginate(10);
        $categoryName = Category::find($categoryId)->name;

        return view('main.show_category',[
            'ads'=>$ads,
            'categoryName'=>$categoryName,
        ]);
    }

    /**
     * @param $categoryId
     * @param $adId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showAd( $categoryId, $adId)
    {
        $ad=Ad::where("id","=","{$adId}")->where("category_id","=","{$categoryId}")->where('is_verified','1')->whereDate('expires_at', '>', Carbon::now())->get();

        return view('main.show_ad',[
               'ad'=> $ad,
            ]);
    }

    /**
     * @param Request $searchRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function search(Request $searchRequest)
    {
        $searchStr = $searchRequest->search;
        $ads=Ad::where('title', 'LIKE',"%{$searchStr}%")->where('is_verified','1')->whereDate('expires_at', '>', Carbon::now())->orderBy('created_at', 'DESC')->paginate(10);
        return view('main.search_result',[
            'ads'=>$ads,
        ]);
    }
}
