<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    protected $table = 'donatur';
    protected $primaryKey = 'id_donatur';
    protected $fillable = [
        'id_donatur',
        'no_hp',
        'nama_donatur',
        'alamat_donatur',
        'kelurahan',
        'photo',
        'password',
        // Add other fillable properties here
    ];

    public function redeem()
    {
        return $this->hasMany(Redeem::class, 'id_donatur', 'id_donatur');
    }

    public function sumbangan()
    {
        return $this->hasMany(Sumbangan::class, 'id_donatur', 'id_donatur');
    }
}
