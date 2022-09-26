<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datauji extends Model
{
    use HasFactory;

    protected $table = 'datauji';

    protected $fillable = ['id', 'ram_u', 'internal_u', 'baterai_u', 'kam_depan_u', 'kam_belakang_u', 'kid_u'];

    public function dunormalize()
    {
        return $this->hasOne(Dunormalize::class, 'pid_u', 'id');
    }

    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class, 'kid_u', 'id');
    // }
}
