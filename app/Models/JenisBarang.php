<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisBarang extends Model
{
    use HasFactory;

    protected $table = 'jenis_barang';

    protected $fillable = [
        'nama_jenis',
    ];

    // const CREATED_AT = 'creation_date';
    // const UPDATEED_AT = 'update_date';

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class,'nama_barang');
    }
}
