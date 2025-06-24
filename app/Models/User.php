<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function hasPurchased($bookId)
    {
        return $this->transactions()
            ->where('status', 'completed')
            ->whereHas('details', function($query) use ($bookId) {
                $query->where('book_id', $bookId);
            })
            ->exists();
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }
}
