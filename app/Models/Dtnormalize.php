<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtnormalize extends Model
{
    use HasFactory;

    protected $table = 'dtnormalize';

    protected $fillable = ['pid', 'testname', 'testram', 'testinternal', 'testbaterai', 'testkam_depan', 'testkam_belakang', 'testharga', 'testklasifikasi'];

    public function datatest()
    {
        return $this->belongsTo(Datatest::class, 'pid', 'id');
    }
}
