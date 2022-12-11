<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; //database
use App\Models\Post; //post model
use App\Models\User; //user model
use App\Models\Category; //category model
use Illuminate\Http\Request;

class PostController extends Controller{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */



    /* Create */
    public function TestCreate()
    {
        DB::table('posts')->insert([
            'author_id' => '1',
            'description' => 'Welcome everyone to Rabbit, the social media where everything is like Reddit, except Reddit is better',
            'image_url' => 'https://pbs.twimg.com/profile_images/1278817894952955904/u9yblLLY_400x400.jpg',
            'category_id' => "4"
        ]);
    }

    public function CreatePost(Request $request)
    {
        DB::table('posts')->insert([
            'author_id' => $request->author_id,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'category_id' => $request->category_id
        ]);
    }

    /* Read */
    public function GetPosts()
    {
        $posts = Post::all();
        return json_encode($posts);
    }

    public function GetPost($id)
    {
        $post = Post::find($id);
        return json_encode($post);
    }

    public function GetPostsFromUser($user_id)
    {
        $results = Post::all()->where("author_id", '=', $user_id);
        return json_encode($results); 
    }

    public function FilterByCategory($category_id)
    {
        $posts = Post::all()->where("category_id", "=", $category_id);
        return json_encode($posts);
    }

    public function AltFilterByCategory($title)
    {
        $category = Category::where("title", "=", $title)->get()->first();
        // dd($category);
        // $posts = Post::all()->where("category_id", "=", $category->id);
        $posts = DB::select("select * from posts where category_id = " . $category->id);
        return json_encode($posts);
    }

    public function GetSearchedPosts($search)
    {
        $posts = DB::select("select * from posts where description LIKE '%" . $search . "%'");
        return json_encode($posts);     
    }

    public function GetPostAuthors()
    {
        $authors = DB::select("select id, author_id from posts");
        return json_encode($authors);
    }

    public function GetPostAuthor($id)
    {
        $author = DB::select("select id, author_id from posts where id=$id");
        return json_encode($author);
    }

    public function GetPostCategories()
    {
        $authors = DB::select("select id, category_id from posts");
        return json_encode($authors);
    }
    
    public function GetPostCountPerCategory($id)
    {
        $category = Category::find($id);
        $count = DB::select("select count(id) from posts where category_id = " . $category->id);
        return json_encode($count);
    }

    public function getTop3PostAuthorId()
    {
        $response = DB::select("select author_id, count(id) from posts group by author_id order by count(id) desc limit 3;");
        return json_encode($response);
    }
    

    /* Delete */
    public function deletePost($id)
    {
        $post = Post::find($id);
        // dd($post);
        $post->delete();
    }

    public function deletePostsPerCategory($category_id)
    {
        $category = Category::find($category_id);
        $posts = Post::all()->where("category_id", "=", $category->id);
        dd($posts);
        $posts->delete();
    }

    

    
}

?>