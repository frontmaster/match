<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyProject extends Model
{
    protected $fillable = ['project_title', 'project_type', 'price_min', 'price_max', 'content', 'user_id', 'apply_user_id'];
}
