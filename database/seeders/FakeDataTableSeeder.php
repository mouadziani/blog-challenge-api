<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakeDataTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            User::factory()
                ->has(Post::factory()->times(mt_rand(10, 20)))
                ->create([
                    'email' => "user$i@test.com",
                ]);
        }
    }
}
