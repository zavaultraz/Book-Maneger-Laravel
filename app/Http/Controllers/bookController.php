<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\category;
use App\Models\place;
use Illuminate\Http\Request;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = category::select('id', 'name')->latest()->get();
        $place = place::select('id', 'name')->latest()->get();
        return view('parent',compact('category','place'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'=> 'required',
            'category_id'=>'required',
            'place_id'=>'required',  
            'image'=>'required|image|mimes:jpeg,png,jpg|max:4000',        
            'author'=>'required',
            'edition'=>'required',
            'author'=>'required',
            'publishing'=>'required',
            'isbn'=>'required|unique',
            'pdf'=>'required|file|mimes:pdf|max:4000',
        ]);
        try {
            $image = $request->file('image');
            $image->storeAs('public/book', $image->hashName());
            $pdf = $request->file('pdf');
            $pdf->storeAs('public/book', $pdf->hashName());
            book::create()
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
