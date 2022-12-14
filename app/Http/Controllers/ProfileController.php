<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;




class ProfileController extends Controller
{
    public function index(Request $request)
    {
        if($request['name']!= null){
            $profiles = User::where('name','LIKE','%'.$request->name.'%')->paginate(5);

        }else{
            $profiles = User::orderBy('id', 'desc')->paginate(5);

        }

        $i = ($request->input('page', 1) - 1) * 5;

        return view('admin.profile.index', compact('profiles', 'i'));
    }


    public function edit(User $profile)
    {
        return view('admin.profile.edit', compact('profile'));
    }



    public function update(ProfileUpdateRequest $request,User $profile)
    {
        $profile->name = $request['name'];
        $profile->email = $request['email'];
        $profile->phone = $request['phone'];
        $profile->address = $request['address'];
        $profile->save();

        return redirect('admin/profile')->with('success', 'profile update successfully .');
    }


    public function delete(User $profile)
    {
       
        if($image = Image::where('imageable_id',$profile->id)->first()){
         unlink(public_path('img/profile/' . $image->name));
         $profile->image()->delete();
        }
        $profile->delete();

        return back()->with('success', 'product delete successfully .');
    }
}
