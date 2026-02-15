<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Hitung cart items
        $cartCount = Cart::where('user_id', auth()->id())->count();
        
        return view('user.dashboard', compact('cartCount'));
    }
}