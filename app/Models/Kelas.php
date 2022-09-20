<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = ['id', 'klas'];

    public function datatest()
    {
        return $this->hasMany(Datatest::class, 'kid', 'id');
    }

    // public function datauji()
    // {
    //     return $this->hasMany(Datauji::class, 'kid_u', 'id');
    // }
}
