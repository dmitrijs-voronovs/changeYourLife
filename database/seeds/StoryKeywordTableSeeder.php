<?php

use Illuminate\Database\Seeder;

class StoryKeywordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('story_keyword')->truncate();
        for($s = 1; $s<= App\Story::count(); $s++){
            for($k = 1; $k<= App\Keyword::count(); $k++){
                if (rand(1,100)>95) DB::table('story_keyword')->insert([
                    'story_id'=> $s,
                    'keyword_id'=> $k
                ]);
            }
        }
    }
}
