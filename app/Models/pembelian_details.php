<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelian_details extends Model
{
    use HasFactory;

    protected $table = 'pembelian_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_pembelian',
        'id_product',
        'harga_beli',
        'harga_jual',
        'total_harga',
        'jumlah_barang',
        'created_at',
        'updated_at',
    ];

    public function product()
    {
        return $this->hasMany(Products::class, 'id', 'id_product');
    }
}
