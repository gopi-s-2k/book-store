<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{

    protected $fillable = [
        "name",
        "image",
        "price",
        "stocks",
        "available",
    ];

    #[Scope]
    protected function available(Builder $query): void
    {
        $query->where('available', 1)->where('stocks', '>', 0);
    }

    /**
     * Get the user's first name.
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $this->image ? Storage::url($this->image) : Storage::url('books/default_book.png'),
        );
    }
}
