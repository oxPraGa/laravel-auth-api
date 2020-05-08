<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = 'John super-admin';
        $user->email = 'super-admin@mail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123456'); // password
        $user->remember_token = Str::random(10);
        $user->save();
        $user->assignRole('super-admin');
        //
        $user = new User();
        $user->name = 'John admin';
        $user->email = 'admin@mail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123456'); // password
        $user->remember_token = Str::random(10);
        $user->save();
        $user->assignRole('admin');
        //
        $user = new User();
        $user->name = 'John provider';
        $user->email = 'provider@mail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123456'); // password
        $user->remember_token = Str::random(10);
        $user->save();
        $user->assignRole('provider');
        //
        $user = new User();
        $user->name = 'John pharmacy';
        $user->email = 'pharmacy@mail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123456'); // password
        $user->remember_token = Str::random(10);
        $user->save();
        $user->assignRole('pharmacy');

    }
}
