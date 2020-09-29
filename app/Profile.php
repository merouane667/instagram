<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function getImage()
    {
        $this->image ? $imagePath = $this->image : $imagePath = 'avatars/default.png';

        return '/storage/'.$imagePath;

    }

    public function followers()
    {
        return $this->belongsToMany('App\User');

    }
}
