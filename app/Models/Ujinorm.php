<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujinorm extends Model
{
    use HasFactory;

    protected $table = 'ujinorm';

    protected $fillable = ['id', 'nname', 'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang', 'nharga'];

    public function uji()
    {
        return $this->belongsTo(Uji::class, 'id', 'id');
    }
}
