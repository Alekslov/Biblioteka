<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Validator;
class BookController extends Controller
{

    public function __construct()   //kad negaletu nepriregistraves vartotojas uzeiti i puslapi ir kazka daryti
    {
        $this->middleware('auth');
    }                               //iki cia
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authors = Author::all();
        // $book = Book::all();

        if ($request->author_id) {
            $books = Book::where('author_id', $request->author_id)->get();
            $filterBy = $request->author_id;
        }
        else {
            $books = Book::all();
        }
        
        return view('book.index', [
            'books' => $books,
            'authors' => $authors,
            'filterBy' => $filterBy ?? 0
            ]);

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('book.create', ['authors' => $authors]);
 
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'book_title' => ['required', 'min:3', 'max:64'],
            'book_isbn' => ['required', 'min:2', 'max:20'],
            'book_pages' => ['required', 'min:1', 'max:1000'],
        ],
         [
             'book_title.min' => 'Pavadinimas trumpesnis nei 3 simboliai',
             'book_isbn.min' => 'ISBN trumpesnis nei 3 simboliai',
             'book_pages.min' => 'Puslapiu skaicius negali buti tuscias laukelis'
         ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $book = new Book;
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'Book was created');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(),
        [
            'book_title' => ['required', 'min:3', 'max:64'],
            'book_isbn' => ['required', 'min:2', 'max:20'],
            'book_pages' => ['required', 'min:1', 'max:1000'],
        ],
         [
             'book_title.min' => 'Pavadinimas trumpesnis nei 3 simboliai',
             'book_isbn.min' => 'ISBN trumpesnis nei 3 simboliai',
             'book_pages.min' => 'Puslapiu skaicius negali buti tuscias laukelis'
         ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $book->title = $request->book_title;
       $book->isbn = $request->book_isbn;
       $book->pages = $request->book_pages;
       $book->about = $request->book_about;
       $book->author_id = $request->author_id;
       $book->save();
       return redirect()->route('book.index')->with('success_message', 'Book was edited');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
       return redirect()->route('book.index')->with('info_message', 'Book was deleted');
    }
}
