<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'description',
        'quantity',
        'minimum_stock',
        'condition',
    ];

    /**
     * URL publik untuk foto peralatan (null bila belum ada foto).
     * Root-relative supaya tetap benar berapa pun host/port yang dipakai.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return '/storage/' . ltrim($this->image, '/');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }
}
