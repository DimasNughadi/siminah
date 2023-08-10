<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $table = 'redeem';
    protected $primaryKey = 'id_redeem';
    protected $fillable = [
        'id_redeem',
        'id_donatur',
        'id_reward',
        // Add other fillable properties here
    ];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'id_donatur', 'id_donatur');
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'id_reward', 'id_reward');
    }
}
