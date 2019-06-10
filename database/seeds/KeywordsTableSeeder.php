<?php

use Illuminate\Database\Seeder;

class KeywordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Keyword::truncate();
        $word_list =['Dictionary', 'Western', 'Romance', 'Comics/Graphic novel', 'Fan fiction', 'Legend', 'Narrative nonfiction', 'Magical realism', 'Tall tale', 'Haiku', 'Memoir', 'Crime/detective', 'Dystopia', 'Thriller', 'Contemporary', 'Speech', 'Folktale', 'Westerns', 'Fairy tale', 'Musical', 'Historical fiction', 'Horror', 'Suspense/thriller', 'Journalism', 'Reference book', 'Biography', 'Fable', 'Short story', 'Mythopoeia', 'Textbook', 'Detective story', 'Meta fiction', 'Satire', 'Guide', 'Swashbuckler', 'Lab report', 'Humor', 'Realistic fiction', 'Essay', 'DIY', 'Classic', 'Mythology', 'Play', 'Fantasy', 'Picture book', 'Self-help book', 'Mystery', 'Science fiction'];
        foreach($word_list as $k=>$v){
            App\Keyword::create(['word'=>$v]);
        }
        // factory(App\Keyword::class,50)->create();
    }
}
