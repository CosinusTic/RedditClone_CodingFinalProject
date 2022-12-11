<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
 
class AdsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'author_id' => Str::random(12),
            'description' => Str::random(25), 
            'image_URL' => 'https://' . Str::random(30) . '.com',
            'category_id' => Str::random(4)

        ]); 
    }
}
