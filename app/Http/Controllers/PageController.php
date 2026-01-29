<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\pesan;

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
        $layanan = Service::where('tipe', 'layanan')->orderBy('urutan')->get();
        $paket = Service::where('tipe', 'paket')->orderBy('urutan')->get();
        
        return view('layanan', compact('layanan', 'paket'));
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
        $services = Service::orderBy('urutan')->get();
        return view('kontak', compact('services'));
    }

    public function kontakStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'paket' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        pesan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'paket' => $request->paket,
            'pesan' => $request->pesan,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}