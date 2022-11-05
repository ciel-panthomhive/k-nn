<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carinorm extends Model
{
    use HasFactory;

    protected $table = 'carinorm';

    protected $fillable = ['id', 'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang', 'nharga', 'nklas'];

    public function datauji()
    {
        return $this->belongsTo(Datauji::class, 'id', 'id');
    }
}
