<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Pesan;
use Illuminate\Support\Facades\Schema;

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
        try {
            if (Schema::hasTable('services')) {
                $layanan = Service::where('tipe', 'layanan')->orderBy('urutan')->get();
                $paket = Service::where('tipe', 'paket')->orderBy('urutan')->get();
            } else {
                $layanan = collect([]);
                $paket = collect([]);
            }
        } catch (\Exception $e) {
            $layanan = collect([]);
            $paket = collect([]);
        }
        
        return view('layanan', compact('layanan', 'paket'));
    }

    public function portofolio()
    {
        try {
            if (Schema::hasTable('portfolios')) {
                $portfolios = Portfolio::latest()->get();
            } else {
                $portfolios = collect([]);
            }
        } catch (\Exception $e) {
            $portfolios = collect([]);
        }

        return view('portofolio', compact('portfolios'));
    }

    public function kontak()
    {
        try {
            if (Schema::hasTable('services')) {
                $services = Service::orderBy('urutan')->get();
            } else {
                $services = collect([]);
            }
        } catch (\Exception $e) {
            $services = collect([]);
        }
        return view('kontak', compact('services'));
    }

    public function promo()
    {
        return view('promo');
    }

    public function kontakStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'paket' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        Pesan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'paket' => $request->paket,
            'pesan' => $request->pesan,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}