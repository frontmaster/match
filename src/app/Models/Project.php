<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectComment;

class Project extends Model
{
    protected $fillable = ['project_title', 'project_type', 'price_min', 'price_max', 'content', 'user_id'];

    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }
}
