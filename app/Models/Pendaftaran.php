<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    // Relasi ke Dokter (User dengan role dokter)
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}