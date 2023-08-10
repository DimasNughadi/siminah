<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id_permintaan';
    protected $fillable = [
        'id_permintaan',
        'id_kontainer',
        'id_lokasi',
        'id_admin_kelurahan',
        // Add other fillable properties here
    ];

    public function kontainer()
    {
        return $this->belongsTo(Kontainer::class, 'id_kontainer', 'id_kontainer');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id_lokasi');
    }

    public function adminKelurahan()
    {
        return $this->belongsTo(Adminkelurahan::class, 'id_admin_kelurahan', 'id_admin_kelurahan');
    }
}
