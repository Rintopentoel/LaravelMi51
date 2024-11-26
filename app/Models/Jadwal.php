<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Void_;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal','tanggal_servis_selanjutnya','ruang_id','user_id','status','foto'];

    public function ruang(){
        return $this->belongsTo(Ruang::class, 'ruang_id', 'id');
    }
}
