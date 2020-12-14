<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainings')->insert([
            'title'=> 'laravel training day 1',
            'description' => 'haha belajar laravel',
            'trainer'=> 'en tarmizi',
            
        ]);
        
    }
}
