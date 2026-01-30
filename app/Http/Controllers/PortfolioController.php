<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::all();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|url',
            'description' => 'required|string|min:10',
            'price' => 'nullable|numeric|min:0',
        ]);

        // Remove price if column doesn't exist
        if (!Schema::hasColumn('portfolios', 'price')) {
            unset($validated['price']);
        }

        Portfolio::create($validated);

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Portfolio berhasil ditambahkan!');
    }

    public function show(Portfolio $portfolio)
    {
        return view('admin.portfolios.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'image' => 'nullable|url',
            'description' => 'required|string|min:10',
            'price' => 'nullable|numeric|min:0',
        ]);

        // Remove price if column doesn't exist
        if (!Schema::hasColumn('portfolios', 'price')) {
            unset($validated['price']);
        }

        $portfolio->update($validated);

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Portfolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()
            ->route('portfolios.index')
            ->with('success', 'Portfolio berhasil dihapus!');
    }
}
