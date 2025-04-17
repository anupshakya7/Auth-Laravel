<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'user',
                'email'=>'user@gmail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'editor',
                'email'=>'editor@gmail.com',
                'password'=>bcrypt('password')
            ],
        ]);

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
    }
}
