<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInterview extends Model
{
    protected $fillable = ['user_id','company_name','position','current_interview','total_interview','job_offer', 'progress'];


    public function user(){
    	return $this->belongsTo('App\User');
    }
}