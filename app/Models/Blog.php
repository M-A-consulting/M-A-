<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'title',
        'user_id',
        'content',
        'image',
    ];
    protected $casts = [
        'image' => 'array',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comment(): HasMany
    {
        return $this->hasMany(comment::class);
    }
}
