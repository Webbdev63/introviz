<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'currency', 'active', 'starts_at', 'ends_at', 'payment_status', 'payment_id', 'source_type', 'source_type', 'payment_date', 'receipt_url', 'record',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
