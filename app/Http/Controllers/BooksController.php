<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function listBooks(Request $request)
    {
        $books = Book::orderBy('name')->paginate(4);
        return view('books.list', compact('books'));
    }

    public function createBook(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('books.create');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'price' => ['required', 'integer', 'min:0'],
            'stocks' => ['required', 'integer', 'min:0'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
        }

        Book::create([
            'name' => $validated['name'],
            'image' => $imagePath,
            'price' => $validated['price'],
            'stocks' => $validated['stocks'],
            'available' => $request->boolean('available'),
        ]);

        return redirect()
            ->route('admin.books')
            ->with('success', 'Book created successfully.');
    }

    public function editBook(Request $request, int $book_id)
    {
        $book = Book::find($book_id);
        if (!$book) {
            return redirect()->back()->withErrors([
                'book' => 'Book not found!'
            ]);
        }

        if ($request->isMethod('get')) {
            return view('books.edit', compact('book'));
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'price' => ['required', 'integer', 'min:0'],
            'stocks' => ['required', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {

            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }

            $book->image = $request
                ->file('image')
                ->store('books', 'public');
        }

        $book->name = $validated['name'];
        $book->price = $validated['price'];
        $book->stocks = $validated['stocks'];
        $book->available = $request->boolean('available');

        $book->save();

        return redirect()
            ->route('admin.books')
            ->with('success', 'Book updated successfully.');
    }

    public function toggleAvailability(Request $request, int $book_id)
    {
        $book = Book::find($book_id);
        if (!$book) {
            return redirect()->back()->withErrors([
                'success' => false,
                'book' => 'Book not found!'
            ]);
        }
        $book->available = (int)!$book->available;
        $book->save();
        return response()->json([
            'success' => true,
            'available' => $book->available,
        ]);
    }
}
