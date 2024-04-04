<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function destroy(Category $category)
    {
        $category->blogs()->detach();

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
    public function removeBlog(Category $category, $blogId)
    {
        $category->blogs()->detach($blogId);

        return back()->with('success', 'Блог был успешно удален из категории.');
    }
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category->update($validatedData);

        return back()->with('success', 'Название категории успешно обновлено.');
    }
    public function create()
    {
        $blogs = Blog::all();
        return view('admin.categories.create', compact('blogs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::create($validatedData);

        if ($request->has('blogs')) {
            $category->blogs()->attach($request->input('blogs'));
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }
    public function adminIndex(): View
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    public function adminShow(Category $category)
    {
        $existingBlogIds = $category->blogs()->pluck('blogs.id');

        $availableBlogs = Blog::whereNotIn('id', $existingBlogIds)->get();

        return view('admin.categories.show', compact('category', 'availableBlogs'));
    }
    public function addBlog(Request $request, Category $category)
    {
        $blogId = $request->input('blog_id');

        $exists = $category->blogs()->where('blog_id', $blogId)->exists();

        if (!$exists) {
            $category->blogs()->attach($blogId);
            return back()->with('success', 'Блог успешно добавлен к категории.');
        }

        return back()->with('error', 'Этот блог уже принадлежит к данной категории.');
    }

    public function index(): View
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function show(Category $category, Request $request): View
    {
        $sortField = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = $category->blogs();

        if ($startDate || $endDate) {
            $query->whereBetween('created_at', [
                $startDate ?: '1970-01-01',
                $endDate ?: '2099-12-31'
            ]);
        }

        $blogs = $query->orderBy($sortField, $sortDirection)
            ->paginate(10);

        return view('categories.show', compact('category', 'blogs', 'sortField', 'sortDirection', 'startDate', 'endDate'));
    }
}
