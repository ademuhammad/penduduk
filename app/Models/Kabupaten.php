<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'provinsi_id'
    ];

    
    /**
     * Get the user that owns the Kabupaten
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    /**
     * Get all of the comments for the Kabupaten
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penduduks()
    {
        return $this->hasMany(Penduduk::class,'kabupaten_id');
    }
}