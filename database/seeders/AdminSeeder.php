<?php

namespace Database\Seeders;

use Domain\Admin\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory([
            'name' => 'Tara Matthew',
            'email' => 'taramatthew.93@gmail.com'
        ])->create();
    }
}
