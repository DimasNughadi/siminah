<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontainer extends Model
{
    protected $table = 'kontainer';
    protected $primaryKey = 'id_kontainer';
    protected $fillable = [
        'id_kontainer',
        'id_lokasi',
        // Add other fillable properties here
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id_lokasi');
    }
    public function sumbangan()
{
    return $this->hasMany(Sumbangan::class, 'id_kontainer');
}
}
