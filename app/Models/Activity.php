<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = ['id', 'target_type', 'target_id', 'user_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['title'];

    public function getTitleAttribute()
    {
        return $this->user->name . ' ' . $this->target_type . ' ';
    }
}
