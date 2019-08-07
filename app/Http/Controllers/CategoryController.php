<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $search = request('search');
       
       $categories = Category::with('tickets')
                            ->search($search)
                            ->orderBy('name')
                            ->paginate(10);
                   
       return view('categories.index', compact('categories'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       return view('categories.form');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(CategoryRequest $request)
   {
      Category::create($request->all());

       return redirect('categories')
           ->withSuccess('Categoria de chamados cadastrado com sucesso!');
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(Category $category)
   {
       return view('categories.form', compact('category'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(CategoryRequest $request, Category $category)
   {
       $category->update($request->all());

       return redirect('categories')
           ->withSuccess('Categoria de chamados atualizado com sucesso!');       
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Category $category)
   {  
       if ($category->tickets()->exists()) {
           return back()->withError('Oops, há chamados associados à categoria, por favor verifique!');
       }

       $category->delete();

       return redirect('categories')
           ->withSuccess('Categoria de chamados excluído com sucesso!');
   }
}
