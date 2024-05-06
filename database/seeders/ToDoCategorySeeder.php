<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToDoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_category')->insert([
            [
                'name' => 'Important',
            ],
            [
                'name' => 'Urgent',
            ],
            [
                'name' => 'Normal',
            ],
        ]);
    }
}
