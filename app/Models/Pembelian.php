<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'harga_beli',
        'harga_jual',
        'total_bayar',
        'total_harga',
        'jumlah_barang',
        'keterangan',
        'created_at',
        'updated_at',
    ];

    public function produk()
    {
        return $this->belongsTo(Products::class);
    }
}
