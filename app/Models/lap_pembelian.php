<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lap_pembelian extends Model
{
    use HasFactory;
    protected $table = 'lap_pembelian';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_pembelian',
        'barang_dibeli',
        'pengeluaran',
        'keterangan',
        'created_at',
        'updated_at',
    ];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id', 'id_pembelian');
    }
}
