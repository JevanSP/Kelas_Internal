<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'id_jenis',
        'foto',
        'nama_barang',
        'harga',
        'stok',
    ];

    // const CREATED_AT = 'creation_date';
    // const UPDATEED_AT = 'update_date';

    public function jenis_barang():BelongsTo
    {
        return $this->belongsTo(JenisBarang::class,'id_jenis');
    }
    public function detail_transaksi():HasMany
    {
        return $this->hasMany(DetailTransaksi::class,'no_transaksi');
    }
}
