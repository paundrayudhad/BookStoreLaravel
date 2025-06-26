<?php

// app/Models/Book.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'book_type',
        'author',
        'publisher',
        'release_year',
        'category',
        'tags',
        'short_description',
        'synopsis',
        'isbn',
        'page_count',
        'weight',
        'dimensions',
        'price',
        'stock',
        'cover_image',
        'pdf_file'
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function getFormattedTagsAttribute()
    {
        return $this->tags ? implode(', ', $this->tags) : '';
    }

    public function getPhysicalAttributesAttribute()
    {
        if ($this->book_type !== 'fisik') return null;

        return [
            'weight' => $this->weight ? $this->weight . ' gram' : '-',
            'dimensions' => $this->dimensions ?: '-',
            'page_count' => $this->page_count ?: '-'
        ];
    }

    public function transactionDetails()
{
    return $this->hasMany(TransactionDetail::class);
}
}
