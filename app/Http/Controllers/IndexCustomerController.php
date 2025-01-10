<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class IndexCustomerController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        return view('shop.page.index');
    }

    public function showProduct(): View|Factory|Application
    {
        $categories = Category::all();
        $products = Product::all();
        return view('shop.page.product',
            [
                'categories' => $categories,
                'products' => $products
            ]);
    }

    public function showProductDetail(): View|Factory|Application
    {
        return view('shop.page.product-detail');
    }

    public function showCart(): View|Factory|Application
    {
        return view('shop.page.cart');
    }

    public function showCheckout(): View|Factory|Application
    {
        return view('shop.page.checkout');
    }

    public function showContact(): View|Factory|Application
    {
        return view('shop.page.contact');
    }

    public function showYourOrder(): View|Factory|Application
    {
        return view('shop.page.your-order');
    }
}
