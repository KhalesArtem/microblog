<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function removeCategoryFromBlog(Blog $blog, Category $category)
    {
        $blog->categories()->detach($category);
        return redirect()->route('admin.blogs.edit', $blog)->with('success', 'Category removed from blog successfully.');
    }
    public function updateCategories(Request $request, Blog $blog)
    {
        $blog->categories()->sync($request->input('categories'));
        return back()->with('success', 'Blog categories updated successfully.');
    }

    public function adminIndex(): View
    {
        $blogs = Blog::with('categories')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function adminShow(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.show', compact('blog', 'categories'));
    }

    public function show(Blog $blog): View
    {
        $categories = $blog->categories;
        return view('blogs.show', compact('blog', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'nullable|array',
        ]);

        $blog = Blog::create($validatedData);

        if ($request->has('categories')) {
            $blog->categories()->attach($request->input('categories'));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'nullable|array',
        ]);

        $blog->update($validatedData);

        if ($request->has('categories')) {
            $blog->categories()->sync($request->input('categories'));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }
}
