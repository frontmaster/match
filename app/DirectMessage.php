<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectMessage extends Model
{
    protected $fillable = ['msg'];

    public function postUser()
    {
        return $this->belongsTo('App\User', 'post_user_id');
    }

    public function applyUser()
    {
        return $this->belongsTo('App\User', 'apply_user_id');
    }

    public function project()
    {
        return $this->belongsTo('App\PostProject', 'project_id');
    }
}
