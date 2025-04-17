<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =[
            'name'=>'User',
            'email'=>'user@admin.com',
            'password'=>bcrypt('password')
        ];
        User::create($user);

        $admin = [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=> bcrypt('password'),
            ],
            [
                'name'=>'Editor',
                'email'=>'editor@gmail.com',
                'password'=> bcrypt('password'),
            ],
            [
                'name'=>'Author',
                'email'=>'author@gmail.com',
                'password'=> bcrypt('password'),
            ],
        ];

        Admin::insert($admin);

        //Role
        Role::insert([
            [
                'name'=>'Admin',
                'slug'=>'admin'
            ],
            [
                'name'=>'Editor',
                'slug'=>'editor'
            ],
            [
                'name'=>'Author',
                'slug'=>'author'
            ],
        ]);

        //Permission
        Permission::insert([
            [
                'name'=>'Add Post',
                'slug'=>'add-post',
            ],
            [
                'name'=>'Delete Post',
                'slug'=>'delete-post',
            ],
        ]);


        Admin::whereId(1)->first()->roles()->attach([1]);
        Admin::whereId(2)->first()->roles()->attach([2]);
        Admin::whereId(3)->first()->roles()->attach([3]);

        Role::whereId(1)->first()->permissions()->attach([1,2]);
        Role::whereId(2)->first()->permissions()->attach([1]);
        Role::whereId(3)->first()->permissions()->attach([1]);
    }
}
