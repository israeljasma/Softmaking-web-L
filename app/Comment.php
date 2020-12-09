<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id', 'user_id', 'comment'
    ];

    public function ticket(){
        return $this->belongsTo('App\Ticket');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
