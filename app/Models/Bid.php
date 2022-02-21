<?php

namespace App\Models;

use App\Traits\Userable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bid extends Model
{
    use HasFactory;
    use Userable;

    protected $fillable = ['value', 'auction_id'];

    public function auction(): BelongsTo
    {
        return $this->belongsTo(Auction::class);
    }
}
