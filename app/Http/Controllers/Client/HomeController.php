<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::where('actif', true)->get();

        return view('clients.index', ['products' => $products, 'categories' => $categories]);
    }
    public function about(){
        return view ('clients.about');
    }
    public function contact(){
        return view ('clients.contact');
    }
}
