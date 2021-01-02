<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = "clients";
    
    protected $fillable = [
        'name', 'description', 'url_logo', 'url_site'
    ];
}
