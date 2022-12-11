<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; //database
use App\Models\Category; //post model
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Http\Request;

class CategoryController extends Controller{
    /**
     * Show a list of all of the application's users.
     *
     * @return \Illuminate\Http\Response
     */


    /* Create */
    public function CreateCategory(Request $request)
    {
        DB::table('categories')->insert([
            'logo_url' => $request->logo_url,
            'title' => $request->title,
        ]);
    }

    /* Read */
    public function GetCategories()
    {
        $category = Category::all();
        return json_encode($category);
    }

    public function GetCategory($id)
    {
        $category = Category::find($id);
        return json_encode($category);
    }

    public function GetCategoryFromInput($input)
    {
        $category = Category::all()->where("title", "=", $input);
        return json_encode($category);
    }

    /* Update */
    public function UpdateCategory(Request $request, $id)
    {
        $category = Category::find($id);
        DB::table("categories")->where("id", "=", $category->id)->update([
            'title' => $request->title, 
            'logo_url' => $request->logo_url
        ]);
    }

    /* Delete */
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
    }


}

?>