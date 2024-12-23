<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AdminProductController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $products = Product::all();
        return view('admin.page.product.index',
            [
                'products' => $products
            ]);
    }

    public function showCreate(): View|Factory|Application
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.page.product.create',
            [
                'categories' => $categories,
                'tags' => $tags
            ]);
    }

    public function showUpdate(): View|Factory|Application
    {
        return view('admin.page.product.update');
    }
}
