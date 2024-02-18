<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TicketStatus extends Model
{
    use HasFactory;
    protected $connection = 'mysql_tiket';
    protected $table = 'custom_statuses';
    protected $primary_key = 'ID';
    protected $fillable = ['ID', 'name', 'color', 'close', 'text_color'];

    public function tickets(): BelongsTo
    {
        return $this->belongsTo(Tiket::class,'ID','status');
    }
}
