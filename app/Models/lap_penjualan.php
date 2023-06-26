<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lap_penjualan extends Model
{
    use HasFactory;
    protected $table = 'lap_penjualan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_penjualan_detail',
        // 'barang_terjual',
        // 'pemasukan',
        'keterangan',
        'tanggal',
        'created_at',
        'updated_at',
    ];

    public function penjualan_detail()
    {
        return $this->hasMany(Penjualan_details::class, 'id', 'id_penjualan_detail');
        // return $this->belongsToMany(Penjualan_details::class, 'penjualan', 'id', 'id_penjualan');
    }
}
