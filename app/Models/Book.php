<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        "title",
        "price",
        "description",
        "pic",
        "cat_id"
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function uploadFile($request, $neededFile)
    {
        $fileName = "book_" . time() . '_' . $neededFile->getClientOriginalName();
        $request->file('pic')->storeAs(
            'public/books',
            $fileName
        );
        return $fileName;
    }
}