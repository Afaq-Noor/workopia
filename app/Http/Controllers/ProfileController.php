<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request) {
        //Get logged in user
        $user = Auth::user();

        //Validate data 
        $validatedData = $request->validate([
            'name' => 'required|string' , 
            'email' => 'required|email' ,
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]) ;

        // Get user name and email
        $user->name = $request->input('name') ;
        $user->email = $request->input('email') ;

        
        // Check for image
        if($request->hasFile('avatar')) {
            //Delete old logo
            if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            }
            // store the file and get path
            $avatarPath = $request->file('avatar')->store('avatars', 'public') ;

            $user->avatar = $avatarPath ;
        }
        //Updated user info
        $user->save() ;

        return redirect()->route('dashboard')->with('success', 'Profile info updated!') ;
    }    
}
