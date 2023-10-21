<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nik',
        'jeniskelamin',
        'tanggallahir',
        'alamat',
        'kabupaten_id',
        'provinsi_id'
    ];

    /**
     * Get the user that owns the Penduduk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}