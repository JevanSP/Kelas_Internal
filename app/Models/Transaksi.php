<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'tgl_transaksi',
        'user_id',
        'total_bayar',
        'uang_masuk',
        'kembalian',
    ];

    

    public function detail_transaksi():HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class ,'user_id');
    }
}
