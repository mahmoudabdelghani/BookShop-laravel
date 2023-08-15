<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->paginate(12);
        $page = "Books";
        return view('books', [
            "page" => $page,
            "books" => $books
        ]);
    }

    public function create()
    {
        $page = "create book";
        $categories = Category::all();
        $tags = Tag::all();
        return view('create-book', ['page' => $page, 'categories' => $categories, 'tags' => $tags]);
    }

    public function store(CreateBookRequest $request)
    {
        $fileName = Book::uploadFile($request, $request->pic);
        $book = Book::create([
            "title" => $request->title,
            "price" => $request->price,
            "description" => $request->description,
            "cat_id" => $request->category,
            "pic" => $fileName
        ]);
        $tags = $request->input('tags', []);
        $book->tags()->sync($tags);
        return redirect()->route('books.index');
    }

    public function show($book)
    {
        $book = Book::findOrFail($book);
        // dd($book);
        return view('show-book', compact('book'),);

    }

    public function edit(Book $book)
    {   
        $categories = Category::all();
        $tags = Tag::all();
        return view('edit-book', compact('book', 'categories', 'tags'));
    }

    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:6|max:255',
            'price' => 'required|min_digits:0',
            'category' => 'required|exists:categories,id',
            'description' => 'required|max:255',
            'pic' => 'required|mimes:jpg,bmp,png',
            'tags' => 'array',
        ]);
    
        $book->update($validatedData);
    
        $tags = $request->input('tags', []);
        $book->tags()->sync($tags);
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($book)
    {
        $book = Book::find($book);
        $book->delete();
        return redirect()->back();
    }
}
