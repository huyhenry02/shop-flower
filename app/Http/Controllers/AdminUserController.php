<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AdminUserController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $users = User::where('role', 'customer')->get();
        return view('admin.page.user.index',
            [
                'users' => $users
            ]
        );
    }

    public function showCreate(): View|Factory|Application
    {
        return view('admin.page.user.create');
    }

    public function showUpdate(): View|Factory|Application
    {
        return view('admin.page.user.update');
    }
}
