<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginPage(Request $request){
        return view('admin.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ],
        [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);

        if(Auth::guard("admin")->attempt($request->only('email','password'))){
            return redirect()->route("admin.dashboard");
        }
        else{
            return redirect()->back()->withErrors(["Login credentials mismatch"]);
        }
    }

    public function dashboard(Request $request){
        $available_books = Book::available()->count();
        // dd($available_books);
        $no_stock_books = Book::where('stocks',0)->orWhereNull('stocks')->count();
        // total_purchase
        return view('admin.dashboard',compact('available_books','no_stock_books'));
    }

    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('admin.login.page');
    }
}
