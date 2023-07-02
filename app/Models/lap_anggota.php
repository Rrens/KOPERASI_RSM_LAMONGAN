<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lap_anggota extends Model
{
    use HasFactory;
    protected $table = 'lap_anggota';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        // 'id_user',
        // 'id_penjualan',

        'tanggal',
        'created_at',
        'updated_at',
    ];

    public function lap_anggota_detail()
    {
        return $this->belongsTo(lap_anggota_detail::class);
    }
}
