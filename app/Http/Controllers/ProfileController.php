<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;




class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $profiles = User::orderBy('id','desc')->paginate(5);
        $i = ($request->input('page', 1) - 1) * 5;
        return view('admin.profile.index', compact('profiles','i'));

    }
    public function edit($id){
        $profile = User::find($id);

        return view('admin.profile.edit', compact('profile'));

    }
    public function update(ProfileUpdateRequest $request,$id){
        // $request -> validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'phone' => 'required',
        //     'address' => 'required',
        // ]);
       $profile = User::find($id);
       $profile ->name = $request['name'];
       $profile ->email = $request['email'];
       $profile ->phone = $request['phone'];
       $profile ->address = $request['address'];
       $profile -> save();
        return redirect('admin/profile')->with('success','profile update successfully .');
    }
    public function delete($id){
       $profile = User::find($id);
       $profile->delete();
       return back()->with('success','product delete successfully .');
    }

}
