<?php

namespace Modules\Category\Http\Controllers;

use Modules\Support\Http\Controllers\BackendController;
use Modules\Category\Http\Requests\CategoryValidate;
use Modules\Category\Models\Category;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

class CategoryController extends BackendController
{
    public function index(): Response
    {
        $categorys = Category::orderBy('id')
            ->search(request('searchContext'), request('searchTerm'))
            ->paginate(request('rowsPerPage', 10))
            ->withQueryString()
            ->through(fn ($category) => [
                'id' => $category->id,
                'name' => $category->name,
                'created_at' => $category->created_at->format('d/m/Y H:i') . 'h'
            ]);

        return inertia('Category/CategoryIndex', [
            'categorys' => $categorys
        ]);
    }

    public function create(): Response
    {
        return inertia('Category/CategoryForm');
    }

    public function store(CategoryValidate $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('category.index')
            ->with('success', 'Category created.');
    }

    public function edit(int $id): Response
    {
        $category = Category::find($id);

        return inertia('Category/CategoryForm', [
            'category' => $category
        ]);
    }

    public function update(CategoryValidate $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $category->update($request->validated());

        return redirect()->route('category.index')
            ->with('success', 'Category updated.');
    }

    public function destroy(int $id): RedirectResponse
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category deleted.');
    }
}
