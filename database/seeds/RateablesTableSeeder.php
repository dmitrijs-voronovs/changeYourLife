<?php

use Illuminate\Database\Seeder;

class RateablesTableSeeder extends Seeder
{
    public function appendTable(Int $user_id, Int $entity_total_count, String $entity_name){
        $keys = [];
        for($r = 1; $r<=rand(1,200);$r++){
            array_push($keys,rand(1,$entity_total_count));
        }
        $keys = array_unique($keys);
        foreach($keys as $k){
            DB::table('rateables')->insert([
                'user_id' => $user_id,
                'rateable_id' => $k,
                'rateable_type' => $entity_name,
                'like'=>(rand(1,10)>8)?0:1
            ]);
        }
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
     public function run()
    {
        DB::table('rateables')->truncate();
        for($u = 1; $u<=App\User::count() ; $u++){
            $this->appendTable($u,App\Comment::count(),'App\Comment');
            $this->appendTable($u,App\Sentence::count(),'App\Sentence');
            $this->appendTable($u,App\Story::count(),'App\Story');
        }
    }
}
