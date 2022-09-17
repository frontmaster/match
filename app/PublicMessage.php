<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicMessage extends Model
{

    protected $fillable =['msg'];

    public function applyUsers()
    {
        return $this->hasMany('App\User', 'apply_user_id');
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function project()
    {
        return $this->belongsTo('App\PostProject', 'project_id');
    }


}
