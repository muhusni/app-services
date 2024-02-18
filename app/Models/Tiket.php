<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tiket extends Model
{
    use HasFactory;
    protected $connection = 'mysql_tiket';
    protected $table = 'tickets';

    protected $fillable = [
        'ID',
        'title',
        'body',
        'categoryid',
        'status'
    ];

    public function ticketReplies(): HasMany
    {
        return $this->hasMany(TicketReply::class, 'ticketid', 'ID');
    }

    public function ticketCategory(): HasOne
    {
        return $this->hasOne(TicketCategory::class,'ID', 'categoryid');
    }

    public function ticketStatus(): HasOne
    {
        return $this->hasOne(TicketStatus::class,'ID', 'status');
    }
}
