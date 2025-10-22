<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'booking_trx_id',
        'city',
        'post_code',
        'address',
        'quantity',
        'sub_total_amount',
        'grand_total_amount',
        'discount_amount',
        'is_paid',
        'shoe_id',
        'shoe_size',
        'promo_code_id',
        'proof',
    ];

    // Generate ID transaksi unik dengan prefix 'SSGOY-' dan 4 digit acak
    // Looping sampai menemukan ID yang belum dipakai di kolom booking_trx_id
    public static function generateUniqueTrxId()
    {
        $prefix = 'SSGOY-';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (self::where('booking_trx_id', $randomString)->exist());

        return $randomString;
    }

    // Relasi: transaksi ini terkait dengan satu sepatu
    public function shoe(): BelongsTo
    {
        return $this->belongsTo(Shoe::class, 'shoe_id');
    }

    // Relasi: transaksi ini bisa menggunakan satu kode promo
    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }
}
