<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'gender',
        'role_id',
        'password',
        'profile_picture',
        'birthdate',
        'bio',
        'situation_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function offers(){
        return $this->hasOne(Offer::class);
    }

    public function support_messages(){
        return $this->hasMany(SupportMessage::class);
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function situation()
    {
        return $this->belongsTo(Situations::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
