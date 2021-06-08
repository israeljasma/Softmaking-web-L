<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_name', 'rut', 'address', 'phone', 'email', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
