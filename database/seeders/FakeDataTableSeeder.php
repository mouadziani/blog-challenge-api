<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class FakeDataTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->has(Post::factory()->times(mt_rand(10, 20)))
            ->count(10)
            ->create();
    }
}
