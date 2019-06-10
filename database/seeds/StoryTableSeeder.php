<?php

use Illuminate\Database\Seeder;

class StoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Story::truncate();
        factory(App\Story::class,40)->create();
    }
}
