<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            KeywordsTableSeeder::class,
            StoryTableSeeder::class,
            CommentTableSeeder::class,
            SentenceTableSeeder::class,
            StoryKeywordTableSeeder::class,
            FollowablesTableSeeder::class,
            RateablesTableSeeder::class,
        ]);
    }
}
