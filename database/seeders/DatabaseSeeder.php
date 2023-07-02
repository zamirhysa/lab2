<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
          // \App\Models\User::factory(5)->create();

          $user=User::factory()->create([
            'name'=>'Zam',
            'email'=>'zamm@live.com'




          ]);
           Listing::factory(6)->create([

                'user_id'=>$user->id

           ]);

        // \App\Models\User::factory()->create([php a
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Listing::create(
        //     [
        //         'title'=>'PHP developer',
        //         'tags'=>'php laravel',
        //         'company'=>'e-com',
        //         'location'=>'Prishtine',
        //         'email'=>'abc@live.com',
        //         'website'=>'http.com',
        //         'description'=>'PHP zhvillues etc'
        //     ]);

        //     Listing::create(
        //         [
        //             'title'=>'PHP developer',
        //             'tags'=>'php laravel',
        //             'company'=>'e-com',
        //             'location'=>'Prishtine',
        //             'email'=>'abc@live.com',
        //             'website'=>'http.com',
        //             'description'=>'PHP zhvillues etc'
        //         ]);


         
    }
}
