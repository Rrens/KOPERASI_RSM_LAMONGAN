<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_user',
        'subtotal',
        'diskon',
        'total_bayar',
        'kembalian',
        'poin_tambah',
        'metode_pembayaran',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_user');
    }

    public function penjualan_detail()
    {
        return $this->belongsTo(Penjualan_details::class);
    }

    public function detail()
    {
        // return $this->belongsToMany(Penjualan::class, 'penjualan_details', 'id', 'id_penjualan');
        return $this->belongsTo(Penjualan_details::class, 'id', 'id_penjualan');
    }

    // public function lap_anggota()
    // {
    //     return $this->belongsTo(lap_anggota::class);
    // }

    public function lap_anggota_detail()
    {
        return $this->belongsTo(lap_anggota_detail::class);
    }
}
