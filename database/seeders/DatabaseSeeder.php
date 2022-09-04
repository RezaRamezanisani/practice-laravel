<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(10)->create();
//         Role::factory(3)->create();

        $this->call([UsersTableSeeder::class]);
//         $this->call([UsersTableSeeder::class,PostsTableSeeder::class]);
//        php artisan db:seed or php artisan migrate:fresh --seed or php artisan db:seed --class=UsersTableSeeder



        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
