<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $items = Portfolio::latest()->paginate(9);
        return view('portfolios.index', compact('items'));
    }

    public function create()
    {
        return view('portfolios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Portfolio::create($data);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio berhasil dibuat.');
    }

    public function show(Portfolio $portfolio)
    {
        return view('portfolios.show', ['item' => $portfolio]);
    }

    public function edit(Portfolio $portfolio)
    {
        return view('portfolios.edit', ['item' => $portfolio]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // remove old image
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $portfolio->update($data);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('success', 'Portfolio dihapus.');
    }
}
