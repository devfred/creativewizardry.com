<?php

namespace Database\Seeders;

use App\Models\ContentItem;
use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;

use DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        
        $this->create_users();
        $this->create_categories();
        $this->create_tags();
        $this->create_content_items();        
    }

    private function create_users()
    {
        // User::factory(10)->create(); 
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    private function create_categories()
    {
        Category::create(['name' => "Uncategorized", 'slug'=>'uncategorized']);
        Category::create(['name' => "Thoughts", 'slug'=>'thoughts']);
        Category::create(['name' => "Notes", 'slug'=>'notes']);
        Category::create(['name' => "Research", 'slug'=>'research']);
        Category::create(['name' => "Quick Tips", 'slug'=>'quick-tips']);
    }

    private function create_tags()
    {                
        Tag::create(['name' => "HTML", 'slug'=>'html']);
        Tag::create(['name' => "CSS", 'slug'=>'css']);
        Tag::create(['name' => "JavaScript", 'slug'=>'javascript']);
        Tag::create(['name' => "NodeJS", 'slug'=>'node']);
        Tag::create(['name' => "C#", 'slug'=>'csharp']);
        Tag::create(['name' => ".Net", 'slug'=>'dotnet']);                
        Tag::create(['name' => "Git", 'slug'=>'git']);
        Tag::create(['name' => "GitLab", 'slug'=>'gitlab']);
        Tag::create(['name' => "Kubernetes", 'slug'=>'k8s']);
        Tag::create(['name' => "DotNetNuke", 'slug'=>'dnn']);
        Tag::create(['name' => "Laravel", 'slug'=>'laravel']);
        Tag::create(['name' => "Homelab", 'slug'=>'homelab']);
        Tag::create(['name' => "CI/CD", 'slug'=>'ci-cd']);
        Tag::create(['name' => "DevOps", 'slug'=>'devops']);
        Tag::create(['name' => "AI", 'slug'=>'ai']);
    }

    private function create_content_items()
    {                   
        $user = User::create(['email' => fake()->email, 'name'=>fake()->word, 'password'=>Hash::make('admin')]);

        $tagCount = Tag::count();
        $catCount = Category::count();

        for ($i = 0; $i < 30; $i++)
        {
            $title = fake()->sentence;
            $slug = strtolower( str_replace(".", "", str_replace(" ", "-", $title) ) );
            $item = ContentItem::create([
                'title' => $title, 
                'slug'=>$slug,
                'excerpt'=>join(fake()->paragraphs(2)), 
                'content'=>join(fake()->paragraphs(5) ), 
                'user_id'=>$user->id, 
                'category_id'=>rand(1,$catCount),
                'is_published' => rand(0,1),
                'published_at' => fake()->dateTime($max = '2015-08-15 00:00:00')  
            ]);

            // Maintain an array of assigned tags for the current item
            $assignedTags = [];

            // Generate unique tags until we have three
            while (count($assignedTags) < 3) {
                $tagId = rand(1, $tagCount);
                if (!in_array($tagId, $assignedTags)) {
                    $assignedTags[] = $tagId;
                }
            }

            // Create content_tag records
            $content_tags = array_map(function ($tagId) use ($item) {
                return [
                    'content_item_id' => $item->id,
                    'tag_id' => $tagId,
                ];
            }, $assignedTags);
            
            DB::table('content_item_tag')->insert($content_tags);
        }
    }
}