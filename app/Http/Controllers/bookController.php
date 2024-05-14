<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\book;
use App\Models\place;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = category::select('id', 'name')->latest()->get();
        $place = place::select('id', 'name')->latest()->get();
        $book = book::latest()->get();
        
        // dd($book);
     
        return view('parent',compact('category','place','book'));
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
        'title' => 'required',
        'category_id' => 'required',
        'place_id' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:4000',
        'author' => 'required',
        'edition' => 'required',
        'publishing' => 'required',
        'isbn' => 'required|unique:books,isbn',
        'pdf' => 'required|mimes:pdf|max:4000',
    ]);

    try {
        
        $book = $request->all();

        $image = $request->file('image');
        $image->storeAs('public/book', $image->hashName());

        $pdf = $request->file('pdf');
        $pdf->storeAs('public/book', $pdf->hashName());

        $data = book::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'place_id' => $request->place_id,
            'image' => $image->hashName(),
            'author' => $request->author,
            'edition' => $request->edition,
            'publishing' => $request->publishing,
            'isbn' => $request->isbn,
            'pdf' => $pdf->hashName(),
        ]);
        

        
        return redirect()->back()->with('success', 'Book Added Successfully');
    } catch (Exception $e) {
       
        return redirect()->back()->with('error', 'Failed To Add Book');
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
        $validated = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'place_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:4000',
            'author' => 'required',
            'edition' => 'required',
            'publishing' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $id,
            'pdf' => 'mimes:pdf|max:4000',
        ]);
    
        try {
            // Cari buku berdasarkan ID
            $book = book::findOrFail($id);
    
            // Update data buku
    
    
            if ($request->hasFile('image') && !$request->hasFile('pdf')) {
                if ($book->image) {
                    Storage::delete('public/book/' . $book->image);
                }
                $image = $request->file('image');
                $image->storeAs('public/book', $image->hashName());
                $data['image'] = $image->hashName();
            } 
            // Jika hanya file PDF yang diunggah
            elseif (!$request->hasFile('image') && $request->hasFile('pdf')) {
                if ($book->pdf) {
                    Storage::delete('public/book/' . $book->pdf);
                }
                $pdf = $request->file('pdf');
                $pdf->storeAs('public/book', $pdf->hashName());
                $data['pdf'] = $pdf->hashName();
            } 
            // Jika kedua file diunggah
            elseif ($request->hasFile('image') && $request->hasFile('pdf')) {
                if ($book->image) {
                    Storage::delete('public/book/' . $book->image);
                }
                if ($book->pdf) {
                    Storage::delete('public/book/' . $book->pdf);
                }
                $image = $request->file('image');
                $image->storeAs('public/book', $image->hashName());
                $data['image'] = $image->hashName();
    
                $pdf = $request->file('pdf');
                $pdf->storeAs('public/book', $pdf->hashName());
                $data['pdf'] = $pdf->hashName();
            }
    
            // Simpan perubahan ke database
            $book->update($data);
            return redirect()->back()->with('success', 'Book Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed To Update Book');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // find book by id
            $book = book::find($id);
            // book prod
            Storage::disk('local')->delete('public/book/' . basename($book->image));
            Storage::disk('local')->delete('public/book/'.basename($book->pdf));
            $book->delete();
            return redirect()->back()->with('success', 'Success To Delete Category');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed To Delete Category');
        }
    }
}
