<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDocument extends Model
{
    protected $fillable = [
        'name', 'description', 'date', 'file'
    ];
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
