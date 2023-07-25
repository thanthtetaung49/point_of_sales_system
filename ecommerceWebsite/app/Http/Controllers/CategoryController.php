<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\FlareClient\View;

class CategoryController extends Controller
{
    // direct category list page
    public function categoryList() {
        $categoryData = Category::when(request('search'), function ($query) {
            $key = request('search');
            $query->orWhere('name', 'like', '%' . $key . '%');
        })->orderBy("created_at", "desc")->paginate(5);

        return view('admin.category.categoryList', compact('categoryData'));
    }
    // direct category page
    public function categoryPage() {
        return view('admin.category.createCategory');
    }

    // category create
    public function categoryCreate(Request $request) {
        Validator::make($request->all(), [
            "categoryName" => "required|unique:categories,name"
        ])->validate();

        Category::create([
            "name" => $request->categoryName
        ]);

        return redirect()->route('categoryListPage');
    }

    // direct category update page
    public function categoryUpdatePage($id) {
        $categoryData = Category::where('id', $id)->first();

        return View('admin.category.categoryUpdatePage', compact('categoryData'));
    }

    // category update
    public function categoryUpdate(Request $request) {
        Validator::make($request->all(), [
            "categoryName" => "required|unique:categories,name," . $request->id
        ])->validate();

        Category::where('id', $request->id)->update([
            "name" => $request->categoryName
        ]);

        return redirect()->route('categoryListPage');
    }

    // category delete
    public function categoryDelete($id) {
        Category::where('id', $id)->delete();

        return redirect()->route('dashboard'); }
}
