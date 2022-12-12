<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdController extends Controller
{
    const NoImagePath ='/storage/img/notimage.png';

    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $ads=$user->ads()->orderBy('updated_at', 'DESC')->paginate(6);
        $adsCount=$user->ads()->count();

        return view('user.index',[
            'ads'=>$ads,
            'adsCount'=>$adsCount,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();


        return view('user.create_ad',[
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|max:80',
            'category'=>'required',
            'image' => 'mimes:jpeg,bmp,png,webp',
            'title'=>'required|max:80',
            'description'=>'required|min:40',
            'price'=>'numeric',
        ]);

        $imagePath=self::NoImagePath;

        if ($request->file('image') && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $newFileName = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path() . '/storage/ad_images',$newFileName);
            $imagePath = '/storage/ad_images/'.$newFileName;
        }
        $user = Auth::user();
        $user->ads()->create([
            'title'=>$request->title,
            'category_id'=>$request->category,
            'image' => $imagePath,
            'description'=>$request->description,
            'price'=>$request->price,
            'expires_at'=>Carbon::now()->addDays(30),
        ]);

        return redirect(route('userHome'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        $this->authorize('owner',$ad);

        return view('user.show_ad',[
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
        $this->authorize('owner',$ad);
        $categories = Category::all();

        return view('user.edit_ad',[
            'ad'=> $ad,
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

        $this->authorize('owner',$ad);

        $ad->update([
            'title'=>$request->title,
            'category_id'=>$request->category,
            'image' => $imagePath,
            'description'=>$request->description,
            'price'=>$request->price,
        ]);

        return redirect(route('userHome'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $this->authorize('owner',$ad);
        if($ad->image !== self::NoImagePath){
            $imageFilename=pathinfo($ad->image)['basename'];
            Storage::delete('public/ad_images/'.$imageFilename);
        }

        $ad->delete();

        return redirect(route('userHome'));
    }

    /**
     * @param Ad $ad
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function extend(Ad $ad)
    {
        $this->authorize('owner',$ad);
        $ad->update([
            'expires_at'=>Carbon::now()->addDays(30),
        ]);

        return redirect(route('userHome'));
    }
}
