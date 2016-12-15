<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birthday',
        'address',
        'phone',
        'role',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['birthday'];
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function isAdmin()
    {
        return $this->role == config('user.role.admin');
    }

    public function getAvatarPath()
    {
        return asset(config('settings.avatar_path') . $this->image);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function followers()
    {
        return $this->hasMany(Relationship::class);
    }

    public function followeds()
    {
        return $this->hasMany(Relationship::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $value ?: config('settings.avatar_default');
    }

    public function setRoleAttribute($value)
    {
        if (!$value) {
            $this->attributes['role'] = config('user.role.user');
        }
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function isUser()
    {
        return $this->role == config('user.role.user');
    }
}
