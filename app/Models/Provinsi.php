<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama'
    ];

    public function kabupatens() {
        return $this->hasMany(Kabupaten::class);
    }
     public function penduduks() {
        return $this->hasMany(Penduduk::class, 'provinsi_id');
    }
}