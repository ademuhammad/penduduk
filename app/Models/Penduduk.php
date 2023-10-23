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



    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('nik', 'like', '%' . $search . '%')->orWhere('nama', 'like', '%' . $search . '%');
        });

        $query->when($filters['provinsi'] ?? false, function ($query, $provinsi) {
            return $query->where('provinsi', 'like', '%' . $provinsi . '%');
        });

        $query->when($filters['kabupaten'] ?? false, function ($query, $kabupaten) {
            return $query->where('kabupaten', 'like', '%' . $kabupaten . '%');
        });
    }

    /**
     * Get the user that owns the Penduduk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kabupatens()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }

    public function provinsis()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
}