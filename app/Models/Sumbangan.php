<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumbangan extends Model
{
    protected $table = 'sumbangan';
    // Add the primary key field if it exists for the sumbangan table
    // protected $primaryKey = 'id_sumbangan'; // Replace with the actual primary key if available
    protected $fillable = [
        'id_donatur',
        'id_kontainer',
        'tanggal',
        'berat',
        'photo',
        'status',
        'keterangan',
        'poin_reward',
        // Add other fillable properties here
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'id_donatur', 'id_donatur');
    }

    public function kontainer()
    {
        return $this->belongsTo(Kontainer::class, 'id_kontainer', 'id_kontainer');
    }
}
