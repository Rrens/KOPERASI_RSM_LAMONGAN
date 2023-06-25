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
        'id_user',
        'id_penjualan_detail',
        'credit_masuk',
        'credit_keluar',
        'poin_masuk',
        'poin_keluar',
        'tanggal',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'id_user');
    }
}
