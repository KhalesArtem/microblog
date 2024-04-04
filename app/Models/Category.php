<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class);
    }
}
