<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'column_id',
        'title',
        'description',
        'sequence',
    ];

    public function column(): BelongsTo
    {
        return $this->belongsTo(Column::class);
    }
}
