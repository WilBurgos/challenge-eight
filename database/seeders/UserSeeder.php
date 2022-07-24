<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user               = new User();
        $user->name         = 'Administrador Spot2';
        $user->email        = 'admin@spot2.mx';
        $user->password     = Hash::make('adminSpot2');
        $user->save();
    }
}
