<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'no_transaksi',
        'nama_barang',
        'harga',
        'qty',
        'subtotal',
    ];

    const CREATED_AT = 'creation_date';
    const UPDATEED_AT = 'update_date';

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class,'no_transaksi');
    }

    public function barang():HasMany
    {
        return $this->hasMany(Barang::class,'nama_barang');
    }
}
