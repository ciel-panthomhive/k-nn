<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtnormalize extends Model
{
    use HasFactory;

    protected $table = 'dtnormalize';

    protected $fillable = ['pid', 'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang', 'nharga', 'nklas'];

    public function datatest()
    {
        return $this->belongsTo(Datatest::class, 'pid', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'nklas', 'id');
    }
}
