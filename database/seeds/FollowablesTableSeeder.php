<?php

use Illuminate\Database\Seeder;

class FollowablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('followables')->truncate();
        for($u = 1; $u<=App\User::count() ; $u++){
            $keys = [];
            for($r = 1; $r<=rand(1,10);$r++){
                array_push($keys,rand(1,App\Keyword::count()));
            }
            $keys = array_unique($keys);
            foreach($keys as $k){
                DB::table('followables')->insert([
                    'user_id' => rand(1,App\User::count()),
                    'followable_id' => $k,
                    'followable_type' => 'App\Keyword' 
                ]);
            }
            //=======================
            $keys = [];
            for($r = 1; $r<=rand(1,10);$r++){
                $val = rand(1,App\User::count());
                if($val == $u){
                    $r--;
                    continue;
                }
                array_push($keys,$val);
            }
            $keys = array_unique($keys);
            foreach($keys as $k){
                DB::table('followables')->insert([
                    'user_id' => rand(1,App\User::count()),
                    'followable_id' => $k,
                    'followable_type' => 'App\User' 
                ]);
            }
        }
        
    }
}
