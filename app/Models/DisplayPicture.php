<?php

namespace Chatty\Models;

use Illuminate\Database\Eloquent\Model;

class DisplayPicture extends Model
{
    protected $fillable = [
    	'filename',
    ];

    public function user() {
    	return $this->belongsTo('Chatty\Models\User', 'user_id');
    }

}
