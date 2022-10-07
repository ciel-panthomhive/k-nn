<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dunormalize extends Model
{
    use HasFactory;

    protected $table = 'dunormalize';

    protected $fillable = ['id', 'nram', 'ninternal', 'nbaterai', 'nkam_depan', 'nkam_belakang', 'nharga'];

    public function datauji()
    {
        return $this->belongsTo(Datauji::class, 'id', 'id');
    }
}
