<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Returned extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'returns';
    protected $guarded = [];

    public function rental(): BelongsTo
    {
        return $this->belongsTo(Rental::class);
    }
}
