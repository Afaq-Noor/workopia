<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Load job listings from file 
        $jobListings = include database_path('seeders/job_listings.php') ;

        //Get test user id
        $testUserId = User::where('email', 'test@gmail.com')->value('id') ;

        //Get user ids from user model
        $user_id = User::where('email', '!=', 'test@gmail.com')->pluck('id')->toArray() ;

        foreach($jobListings as $index => &$listing) {
            if($index < 2) {
                // Assign user id to listings
                $listing['user_id'] = $testUserId;
            } else {
            // Assign user id to listing
            $listing['user_id']  = $user_id[array_rand($user_id)] ;     
            }
            
            //Add timestamps
            $listing['created_at'] = now() ;
            $listing['updated_at'] = now() ;
        } 

        //Insert job listings
        DB::table('job_listings')->insert($jobListings) ;
        echo 'Jobs created successfully!' ;
    }
}
