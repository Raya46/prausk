<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request){
        Category::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'success');
    }

    public function update(Request $request, $id){
        $category = Category::find($id);

        $category->update([
            'name' => $request->name
        ]);
    }

    public function destroy($id){
        $category = Category::find($id);

        $category->delete();
    }
}
