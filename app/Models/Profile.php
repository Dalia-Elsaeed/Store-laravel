<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable =
    [
        'user_id','first_name','last_name','gender','birthday','street_address','city','state','country','locale'
    ];
     public function user(){
        return $this->belongsTo(User::class,'user_id','id');
}}
