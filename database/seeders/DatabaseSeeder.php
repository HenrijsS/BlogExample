<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        // Users
        User::factory()->has(
            Post::factory(3)->hasComments(3)
        )->create([
            'name' => 'Main user',
            'email' => 'test@example.com',
        ]);

        User::factory(2)->create([]);

        // Pre-defined categories
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Lifestyle'],
            ['name' => 'Food'],
            ['name' => 'Travel'],
        ];

        DB::table('categories')->insert($categories);

        // Get all category instances
        $categoryInstances = Category::all();

        // Posts
        Post::factory(15)->hasComments(3)->create()->each(function ($post) use ($categoryInstances) {
            // Attach multiple categories to each post
            $post->categories()->attach(
                $categoryInstances->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
