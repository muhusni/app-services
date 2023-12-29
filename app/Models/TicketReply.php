<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Tiket;

class TicketReply extends Model
{
    use HasFactory;
    protected $connection = 'mysql_tiket';
    protected $table = 'ticket_replies';

    protected $fillable = [
        'body', 'files', 'hash', 'ID', 'replyid', 'ticketid', 'timestamp', 'userid'
    ];

    public function tiket(): BelongsTo
    {
        return $this->belongsTo(Tiket::class, 'ticketid', 'ID');
    }
}
