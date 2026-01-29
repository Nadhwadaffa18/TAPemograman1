<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function layanan()
    {
        return view('layanan');
    }

    public function portofolio()
    {
        // AMBIL DATA DARI DATABASE
        $portfolios = Portfolio::latest()->get();

        // KIRIM KE BLADE
        return view('portofolio', compact('portfolios'));
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function kontakStore(Request $request)
    {
        // nanti
    }
}