<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan_details extends Model
{
    use HasFactory;

    protected $table = 'penjualan_details';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_penjualan',
        'id_product',
        'harga_jual',
        'jumlah_barang',
        'harga_akhir',
        'created_at',
        'updated_at',
    ];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id', 'id_penjualan');
    }

    public function product()
    {
        return $this->hasMany(Products::class, 'id', 'id_product');
    }
}
