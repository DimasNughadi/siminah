<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminkelurahan extends Model
{
    protected $table = 'adminkelurahan';
    protected $primaryKey = 'id_admin_kelurahan';
    protected $fillable = [
        'id_admin_kelurahan',
        'id_lokasi',
        'nama_admin',
        'username',
        'password',
        'alamat_rumah',
        'no_hp',
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id_lokasi');
    }
}
