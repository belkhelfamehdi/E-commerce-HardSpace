<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(5); 
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'category_name' => $request->input('category_name'),
            ]);

            return redirect()->route('admin.category')->with('success','La categorie a été créé.');
    }

    /**
     * Display the specified resource.
     */
    public function SearchCategory(Request $request)
    {
        $categories = Category::all();
    if($request->keyword != ''){
    $categories = Category::where('category_name','LIKE','%'.$request->keyword.'%')->get();
    }
    return response()->json([
        'categories' => $categories
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * ;odifier les donnee de category.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.category')
                        ->with('success','La categorie a été mis à jour.');
    }

    /**
     * Supprimer une category.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category')
                        ->with('success','La categorie a été supprimé.');
    }
}
