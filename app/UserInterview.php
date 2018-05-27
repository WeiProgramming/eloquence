<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInterview extends Model
{
    protected $fillable = ['company_name','position','current_interview','total_interviews','job_offer'];


    public function user(){
    	return $this->belongsTo('App\User');
    }
}