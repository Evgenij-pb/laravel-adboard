<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    const NoImagePath ='/storage/img/notimage.png';

    public function __construct()
    {
        $this->middleware('adminCheck');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads=Ad::orderBy('created_at', 'DESC')->paginate(9);

        return view('admin.index',[
            'ads'=>$ads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(route('adminHome'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(route('adminHome'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        return view('admin.show_ad',[
            'ad'=> $ad,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        $categories = Category::all();

        return view('admin.edit_ad',[
            'ad'=>$ad,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        $this->validate($request,[
        'title'=>'required|max:80',
        'category'=>'required',
        'image' => 'mimes:jpeg,bmp,png,webp',
        'title'=>'required|max:80',
        'description'=>'required|min:40',
        'price'=>'numeric',
    ]);

        if ($request->file('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $newFileName = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path() . '/storage/ad_images',$newFileName);
            $imagePath = '/storage/ad_images/'.$newFileName;
        }else{
            $imagePath = $ad->image;
        }

        $ad->update([
            'title'=>$request->title,
            'category_id'=>$request->category,
            'image' => $imagePath,
            'description'=>$request->description,
            'price'=>$request->price,
        ]);

        return redirect(route('adminHome'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        if($ad->image !== self::NoImagePath){
            $imageFilename=pathinfo($ad->image)['basename'];
            Storage::delete('public/ad_images/'.$imageFilename);
        }

        $ad->delete();

        return redirect(route('adminHome'));
    }

    /**
     * @param Ad $ad
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function approve(Ad $ad)
    {
        if(!$ad->is_verified){
            $ad->update([
                'is_verified'=>'1',
            ]);
        } else{
            $ad->update([
                'is_verified'=>'0',
            ]);
        }

        return redirect(route('adminHome'));
    }
}
