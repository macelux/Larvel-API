<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();

        $admin->name = "enoch";
        $admin->email = "profe@gmail.com";
        $admin->password = Hash::make('Wool1234');
        $admin->is_super = 1;
        $admin->save();

        User::factory()->count(50)->create();
        Admin::factory()->count(10)->create();
 
    }
}
