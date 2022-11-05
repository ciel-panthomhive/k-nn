<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pencarian extends Model
{
    use HasFactory;

    protected $table = 'pencarian';

    protected $fillable = ['id', 'ram_u', 'internal_u', 'baterai_u', 'kam_depan_u', 'kam_belakang_u', 'harga_u', 'kid_u'];

    public function carinorm()
    {
        return $this->hasOne(Carinorm::class, 'id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kid_u', 'id');
    }
}
