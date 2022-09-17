<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordReset;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'comment'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));

        return redirect('/')->with('flash_message', 'パスワード再発行メールを送信しました');
    }

    public function PostProjects()
    {
        return $this->hasMany('App\PostProject', 'post_user_id');
    }

    public function ApplyProjects()
    {
        return $this->hasMany('App\ApplyProject', 'apply_user_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($user) {

            $user->PostProjects()->delete();
        });
    }
}
