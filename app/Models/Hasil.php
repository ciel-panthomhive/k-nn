<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $table = 'hasil';

    protected $fillable = ['id', 'id_hasil'];

    public function datatest()
    {
        return $this->belongsTo(Datatest::class, 'id_hasil', 'id');
    }
}
