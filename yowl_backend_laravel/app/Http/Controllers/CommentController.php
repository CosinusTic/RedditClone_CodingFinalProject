<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; //database
use App\Models\Comment; //comment model
use App\Models\Post; //post model
use App\Models\User; //user model


use Illuminate\Http\Request;

class CommentController extends Controller{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */


    /* Read */
    public function GetComments()
    {
        $comments = Comment::all();
        return json_encode($comments);
    }

    public function GetComment($id)
    {
        $category = Comment::find($id);
        return json_encode($category);
    }

    public function GetCommentByPost($id)
    {
        $comment = Comment::all()->where("post_id", "=", $id);
        return json_encode($comment);
    }

    public function CommentsCountPerPosts($id)
    {
        $post = Post::find($id);
        $count = DB::select("select count(id) from comments where post_id = " . $post->id);
        return json_encode($count);
    }

    public function GetTopCommentedPosts()
    {
        $response = DB::select("select author_id, count(id) from comments group by author_id order by count(id) desc limit 3");
        return json_encode($response);
    }


    /* Create */
    public function AddCommentToPostByUser(Request $request, $post_id, $user_id)
    {
        $post = Post::find($post_id);
        $user = User::find($user_id);
        DB::table('comments')->insert([
            'post_id' => $post->id, 
            'content' => $request->content,
            'author_id' => $user->id
        ]);
    }

    /* Update */
    public function UpdateCommentByUser($comment_id, $user_id)
    {
        $comment = Comment::find($comment_id);
        $user = User::find($user_id);
        $new_message = "'pardon javais mal ecrit je rajoute ce commentaire en esperant qu il vous plaise' ";
        DB::update("update comments set content =" . $new_message . " where id = ? and author_id = ?", [$comment->id, $user->id]);
    }

    /* Delete */
    public function DeleteCommentById($id) // for admin
    {
        $comment = Comment::find($id);
        $comment->delete();
    }

    public function DeleteCommentByPostByUserById($post_id, $user_id, $comment_id) //for user
    {
        $post = Post::find($post_id);
        $user = User::find($user_id);
        $comment = Comment::find($comment_id);
        if($comment->author_id == $user->id && $comment->post_id == $post->id)
        {
            $comment->delete();
        }
    }

    public function DeleteAllCommentsPerPost($post_id) //for admin (when deleting a post, call to this function to delete all its comments from db)
    {
        $post = Post::find($post_id);
        $comments = Comment::all()->where("post_id", "=", $post->id);
        // $comments->delete();
        foreach($comments as $comment)
        {
            $comment->delete();
        }
    }

    public function DeleteAllCommentsPerUser($id)
    {
        $user = User::find($id);
        $comments = Comment::all()->where("author_id", "=", $user->id);

        foreach($comments as $comment)
        {
            $comment->delete();
        }
    }

}

?>