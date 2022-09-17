<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostProject extends Model
{
    use SoftDeletes;
    protected $table = 'postProjects';
    protected $fillable = ['title', 'low_price', 'high_price', 'content'];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'post_user_id')->withTrashed();
    }

    public function publicMsgs()
    {
        return $this->hasMany('App\PublicMessage', 'project_id');
    }

    public function DirectMsgs()
    {
        return $this->hasMany('App\DirectMessage', 'project_id');
    }

    public function applyProjects()
    {
        return $this->hasMany('App\ApplyProject', 'project_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'project_id');
    }

    
    
    
}
