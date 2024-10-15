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
        'transaksi_id',
        'barang_id',
        'harga',
        'qty',
        'subtotal',
    ];

    

    public function barang():BelongsTo

    {
        return $this->belongsTo(Barang::class,'barang_id');
    }
    public function transaksi(): BelongsTo

    {
        return $this->belongsTo(transaksi::class);
    }
}
