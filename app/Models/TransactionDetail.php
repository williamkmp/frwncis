<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_header_id',
        'product_name',
        'price',
        'quantity',
        'subtotal',
    ];

    public function transactionHeader()
    {
        return $this->belongsTo(TransactionHeader::class);
    }
}
