<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(15);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'slug'=>'required|string|unique:pages,slug',
            'content'=>'nullable|string',
        ]);

        Page::create($request->all());

        return redirect()->route('admin.pages.index')->with('success','Страница создана');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'slug'=>'required|string|unique:pages,slug,'.$page->id,
            'content'=>'nullable|string',
        ]);

        $page->update($request->all());

        return redirect()->route('admin.pages.index')->with('success','Страница обновлена');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success','Страница удалена');
    }
}
