<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ApplyProject extends Model
{
    use SoftDeletes;
    use Notifiable;
    protected $fillable = ['title', 'low_price', 'high_price', 'content'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function applyUser()
    {
        return $this->belongsTo('App\User', 'apply_user_id');
    }

    public function postUser()
    {
        return $this->belongsTo('App\User', 'post_user_id');
    }

    public function postProject()
    {
        return $this->belongsTo('App\PostProject', 'project_id')->withTrashed();
    }
}
