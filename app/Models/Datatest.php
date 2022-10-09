<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datatest extends Model
{
    use HasFactory;

    protected $table = 'datatest';

    protected $fillable = ['id', 'name', 'ram', 'internal', 'baterai', 'kam_depan', 'kam_belakang', 'harga', 'kid'];

    public function dtnormalize()
    {
        return $this->hasOne(Dtnormalize::class, 'pid', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kid', 'id');
    }

    public function hasil()
    {
        return $this->hasOne(Hasil::class, 'id_hasil', 'id');
    }
}
