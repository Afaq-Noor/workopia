<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index() {
        $user = Auth::user() ;

        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 
        'desc')->paginate(9) ;

        return view('jobs.bookmarked')->with('bookmarks' , $bookmarks) ;
    }

    public function store(Job $job) {
        $user = Auth::user();

        if($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
              return back()->with('error' , 'Job is already bookmarked') ;

        }

        
              //create new bookmark 
              $user->bookmarkedJobs()->attach($job->id) ;

            return back()->with('success' , 'Job bookmarked successfully!') ;
    }



    
    public function destroy(Job $job) {
        $user = Auth::user();

        if(!$user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
              return back()->with('error' , 'Job is not bookmarked') ;

        }

        
              //create new bookmark 
              $user->bookmarkedJobs()->detach($job->id) ;
 
            return back()->with('success' , 'bookmark removed successfully!') ;
    }
 }
