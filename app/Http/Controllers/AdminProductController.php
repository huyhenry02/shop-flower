<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AdminProductController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        return view('admin.page.product.index');
    }

    public function showCreate(): View|Factory|Application
    {
        return view('admin.page.product.create');
    }

    public function showUpdate(): View|Factory|Application
    {
        return view('admin.page.product.update');
    }
}
