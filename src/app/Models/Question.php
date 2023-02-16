<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function userReactions()
    {
        return $this->hasMany(UserReaction::class);
    }

    protected function reactionGood(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->userReactions()->where('reaction_id', 1)->count(),
        );
    }

    protected function reactionNormal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->userReactions()->where('reaction_id', 2)->count(),
        );
    }

    protected function reactionBad(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->userReactions()->where('reaction_id', 3)->count(),
        );
    }
}
