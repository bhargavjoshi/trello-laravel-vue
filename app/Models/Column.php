<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Column extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'sequence',
    ];

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    // Register event Listner
    public static function boot() {
        parent::boot();

        // this is called before delete() method
        static::deleting(function($column) {
            // Before we delete the column, let's delete all the cards related to it.
            $column->cards()->delete();
        });
    }
}
