<?php

use App\ContentItem;
use App\User;
use App\Tag;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
        $this->call('UserTableSeeder');
        $this->call('CategoryTableSeeder');
        if(getenv('APP_ENV') != "production")
        {
            $this->call('TagTableSeeder');
            $this->call('ContentTableSeeder');
        }
        
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create(['email' => env('ADMIN_EMAIL'), 'name'=>env('ADMIN_NAME'), 'password'=>Hash::make(env('ADMIN_PASS'))]);
    }

}
class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->delete();
        Category::create(['name' => "Uncategorized", 'slug'=>'uncategorized']);
        Category::create(['name' => "Thoughts", 'slug'=>'thoughts']);
        Category::create(['name' => "Notes", 'slug'=>'notes']);
        Category::create(['name' => "Research", 'slug'=>'research']);
        Category::create(['name' => "Quick Tips", 'slug'=>'quick-tips']);
    }
}
class TagTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tags')->delete();
        DB::table('content_item_tag')->delete();
        Tag::create(['name' => "Javascript", 'slug'=>'javascript']);
        Tag::create(['name' => "HTML", 'slug'=>'html']);
        Tag::create(['name' => "CSS", 'slug'=>'css']);
        Tag::create(['name' => "CSharp", 'slug'=>'csharp']);
        Tag::create(['name' => "DotNet", 'slug'=>'dotnet']);
        Tag::create(['name' => "Powershell", 'slug'=>'powershell']);
        Tag::create(['name' => "MSBuild", 'slug'=>'msbuild']);
        Tag::create(['name' => "PHP", 'slug'=>'php']);
    }
}

class ContentTableSeeder extends Seeder
{
    public function run()
    {        
        DB::table('content_items')->delete();
        $faker = Faker\Factory::create();        
        $user = User::create(['email' => $faker->email, 'name'=>$faker->word, 'password'=>Hash::make('admin')]);

        $tagCount = Tag::count();
        $catCount = Category::count();

        for ($i = 0; $i < 30; $i++)
        {
            $title = $faker->sentence;
            $slug = strtolower( str_replace(".", "", str_replace(" ", "-", $title) ) );
            $item = ContentItem::create([
                'title' => $title, 
                'slug'=>$slug,
                'excerpt'=>join('<br/><br/>',$faker->paragraphs(2)), 
                'content'=>join( '<br/><br/>', $faker->paragraphs(5) ), 
                'user_id'=>$user->id, 
                'category_id'=>rand(1,$catCount),
                'is_published' => rand(0,1),
                'published_at' => $faker->dateTime($max = '2015-08-15 00:00:00')  
            ]);
            $content_tags = array(
                array('content_item_id' => $item->id, 'tag_id'=>rand(1,$tagCount)),
                array('content_item_id' => $item->id, 'tag_id'=>rand(1,$tagCount)),
                array('content_item_id' => $item->id, 'tag_id'=>rand(1,$tagCount))
            );
            DB::table('content_item_tag')->insert($content_tags);
        }

    }

}
