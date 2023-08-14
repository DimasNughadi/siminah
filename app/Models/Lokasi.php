<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';
    protected $primaryKey = 'id_lokasi';
    protected $fillable = [
        'id_lokasi',
        'nama_kelurahan',
        'latitude',
        'longitude',
        'deskripsi',
        // Add other fillable properties here
    ];

    public function adminkelurahan()
    {
        return $this->hasMany(Adminkelurahan::class, 'id_lokasi', 'id_lokasi');
    }

    public function kontainer()
    {
        return $this->hasMany(Kontainer::class, 'id_lokasi', 'id_lokasi');
    }

    public function permintaan()
    {
        return $this->hasMany(Permintaan::class, 'id_lokasi', 'id_lokasi');
    }
}
