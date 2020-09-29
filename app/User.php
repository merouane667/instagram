<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUserMail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password',
    ];

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
    //creer un profile directement apres avoir creer l'utilisateur
    protected static function boot()
    {
        parent::boot();

        static::created(function($user){

            $data = $user->profile()->create([

                'title' => 'Profil de '.$user->username
            ]);
            

            Mail::to($data->user->email)->send(new WelcomeUserMail());

        });

    }
    //pour retourner l'utilisateur en passons le username et non l'id
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');

    }

    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('created_at','DESC');

    }

    public function following()
    {
        return $this->belongsToMany('App\Profile');

    }

    public function likes() {
        return $this->hasMany('App\Like');
    }
    public function comments() {
        return $this->hasMany('App\Comment');
    }




}
