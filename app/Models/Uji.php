<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uji extends Model
{
    use HasFactory;

    protected $table = 'uji';

    protected $fillable = ['id', 'name', 'ram', 'internal', 'baterai', 'kam_depan', 'kam_belakang', 'harga', 'kid', 'klasifikasi'];

    public function datatest()
    {
        return $this->belongsTo(Datatest::class, 'id', 'id');
    }

    public function ujinorm()
    {
        return $this->hasOne(Ujinorm::class, 'id', 'id');
    }

    public function kelas1()
    {
        return $this->belongsTo(Kelas::class, 'kid', 'id');
    }

    public function kelas2()
    {
        return $this->belongsTo(Kelas::class, 'klasifikasi', 'id');
    }
}
