<?php

// app/Models/Payment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'payment_method',
        'proof',
        'status',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'verified' => 'success',
            'rejected' => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    public function getProofUrlAttribute()
    {
        return $this->proof ? asset('storage/'.$this->proof) : null;
    }
}
