<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
