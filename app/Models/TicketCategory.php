<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketCategory extends Model
{
    use HasFactory;
    protected $connection = 'mysql_tiket';
    protected $table = 'ticket_categories';
    protected $primary_key = 'ID';
    protected $fillable = ['ID', 'name', 'description', 'cat_parent', 'image', 'no_tickets', 'auto_assign'];

    public function tickets(): BelongsTo
    {
        return $this->belongsTo(Tiket::class,'ID', 'categoryid');
    }
}
