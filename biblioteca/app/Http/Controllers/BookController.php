<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Books/BookComponent', ['books' => Book::with('authors', 'categories', 'reservations')->get(), 'users' => Auth::user()]);

        // return view('books', ['books' => Book::with('authors', 'categories', 'reservations')->get(), 'users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Books/BookCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        /* // Crea il libro e ottieni l'istanza del libro creato
        $book = Book::create($request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:255'],
            'year' => ['required', 'max:4'],
            'pages' => ['required', 'max:4'],
            'numcopies' => ['required', 'max:4'],
            'author' => ['required', 'max:50'],
            'city' => ['required', 'max:50'],
            'category' => ['required', 'max:50'],
        ]));

        // Crea l'autore associato al libro
        $author = Author::create($request->validate([
            'author' => ['required', 'max:50'],
            'city' => ['required', 'max:50'],
        ]));

        // Associa l'autore al libro appena creato
        $book->author()->associate($author)->save();

        // Crea la categoria associata al libro
        $category = Category::create($request->validate([
            'category' => ['required', 'max:50'],
        ]));

        // Associa la categoria al libro appena creato
        $book->category()->associate($category)->save();

        // Ritorna alla vista dei libri
        return redirect()->route('books.index'); */

        $book = Book::create($request->validate([
            'title' => ['required', 'max:50'],
            'description' => ['required', 'max:255'],
            'year' => ['required', 'max:4'],
            'pages' => ['required', 'max:4'],
            'numcopies' => ['required', 'max:4'],
        ]));


        // Creazione dell'autore associato al libro
        $author = new Author([
            'name' => $request->input('name'), // Assicurati di avere un campo 'name' nel tuo form
            'city' => $request->input('city'), // Assicurati di avere un campo 'city' nel tuo form
        ]);
        $book->authors()->save($author);

        // Creazione della categoria
        $category = new Category([
            'name' => $request->input('category'), // Assicurati di avere un campo 'category' nel tuo form
        ]);
        $book->categories()->save($category);



        return to_route('books.index');
    }




    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book = Book::with('authors', 'categories', 'reservations')->findOrFail($book->id);
        //return $book;
        return view('detailpage', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // Ottieni l'ID originario del libro
        $originalBookId = $book->id;

        // Aggiorna i campi del libro
        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'pages' => $request->pages,
            'numcopies' => $request->numcopies,
            'updated_at' => now(),
        ]);

        // Verifica se il campo category è stato inviato nel form
        if ($request->has('category')) {
            // Aggiorna anche la tabella categories solo se il campo category è stato modificato
            $book->categories()->update([
                'name' => $request->category,
                'updated_at' => now(),
            ]);
        }

        // Aggiorna anche la tabella authors
        $book->authors()->update([
            'name' => $request->author,
            'city' => $request->city, // Assumendo che tu abbia un campo city nell'autore
            'updated_at' => now(),
        ]);

        // Reindirizza alla pagina desiderata dopo l'aggiornamento
        return redirect('/books')->with('success', 'Libro aggiornato con successo!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }
}
