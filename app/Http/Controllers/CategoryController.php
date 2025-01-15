<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    function add() {
        return view('category.add');
        
    }

    function store(Request $req) {
        $validate=$req->validate([
            'name'=>'required'
        ]);
        category::create($validate);
        return redirect()->route('category.index')->with("success","category create successfully");

    }

    function index() {
        $categories=Category::all();
        return view('category.index',compact('categories'));

    }

    function edit($id) {
        $categories=Category::find($id);

        return view ('category.edit',compact('categories'));
        
    }

    function update(Request $req) {
        $categories=Category::find($req->id);
        $categories->name=$req->name;
        $categories->save();
        return redirect('/category');

    }
}
