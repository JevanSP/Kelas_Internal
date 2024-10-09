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
        'no_transaksi',
        'tgl_transaksi',
        'total_bayar',
        'uang_masuk',
        'kembalian',
    ];

    const CREATED_AT = 'creation_date';
    const UPDATEED_AT = 'update_date';

    public function detail_transaksi():HasMany
    {
        return $this->hasMany(DetailTransaksi::class,'no_transaksi');
    }
    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class ,'id_user');
    }
}
