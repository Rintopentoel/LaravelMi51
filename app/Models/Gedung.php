<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;

    protected $fillable = ["nama_gedung", "alamat", "telepon"];

    public function permintaan()
    {
        return $this->hasMany(\App\Models\Permintaan::class, 'gedung_id');
    }
}
