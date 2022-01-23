<?php

namespace App\Http\Controllers\Categories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function category()
    {

        $sub_categories = SubCategory::first();
        $main_categories = Category::all();
        return view('categories.index' , ['sub_categories' => $sub_categories , 'main_categories' => $main_categories]);
    }


    public function get_causes_against_category($id)
    {
         $data = DB::table('sub_categories as sub_cat')
                        ->selectRaw('(Select image from categories where id = sub_cat.parent_category_id) as cat_image,
                                     (Select title from categories where id = sub_cat.parent_category_id) as cat_title')
                        ->whereRaw('parent_category_id IN ('.$id.')')
                        ->get();
                 
                       echo json_encode($data);
    }
}

