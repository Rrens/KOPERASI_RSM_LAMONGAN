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
        'keterangan',
        'total_bayar',
        'jumlah_barang',
        'created_at',
        'updated_at',
    ];

    public function product_to_pembelian()
    {
        return $this->hasMany(Products::class, 'id_pembelian');
    }

    public function pembelian_detail()
    {
        return $this->belongsTo(pembelian_details::class);
    }
}
