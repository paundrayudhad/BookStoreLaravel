<?php

// app/Models/Book.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'stock',
        'cover_image',
        'pdf_file',
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function getCoverUrlAttribute()
    {
        return $this->cover_image ? asset('storage/'.$this->cover_image) : null;
    }

    public function getPdfUrlAttribute()
    {
        return $this->pdf_file ? asset('storage/'.$this->pdf_file) : null;
    }
}
