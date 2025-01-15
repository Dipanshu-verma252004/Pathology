<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;


class SubCategoryController extends Controller
{
    function index() {
        $sub_categories=SubCategory::all();

        return view('Sub_Catagory.index',compact('sub_categories'));

    }

    function add() {
        $categories=Category::all();
        return view('Sub_Catagory.add',compact('categories'));
        
    }

    function store(Request $req) {
        $validate=$req->validate([
            'name'=>'required'
        ]);
        SubCategory::create([
            'category_id' => $req->category_id,
            'name' =>$req->name
        ]);
        return redirect()->route('sub_category.index');


        function edit($id) {
            $sub_categories=SubCategory::find($id);
    
            return view ('sub_category.edit',compact('sub_categories'));
            
        }

        // function update(Request $req) {
        //     $sub_categories=sub_Category::find($req->id);
        //     $sub_categories->name=$req->name;
        //     $sub_categories->save();
        //     return redirect('/sub_category');
    
        // }


    }



}
