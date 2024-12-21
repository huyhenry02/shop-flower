<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AdminTagController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $tags = Tag::all();
        return view('admin.page.tag.index',
            [
                'tags' => $tags
            ]
        );
    }

    public function showCreate(): View|Factory|Application
    {
        return view('admin.page.tag.create');
    }

    public function showUpdate(Tag $tag): View|Factory|Application
    {
        return view('admin.page.tag.update',
            ['tag' => $tag]
        );
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $tag = new Tag();
            $tag->fill($input);
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tag.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function postUpdate(Tag $tag, Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $tag->fill($input);
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tag.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function delete(Tag $tag): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $tag->products()->detach();
            $tag->delete();
            DB::commit();
            return redirect()->route('admin.tag.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }
}
