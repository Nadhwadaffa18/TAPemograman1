<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'nama',
        'icon',
        'deskripsi',
        'harga',
        'satuan',
        'tipe',
        'is_featured',
        'urutan',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'harga' => 'integer',
        'urutan' => 'integer',
    ];
}