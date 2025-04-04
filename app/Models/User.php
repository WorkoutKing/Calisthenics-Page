<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Basic;
use App\Models\Meta;
use App\Models\Workout;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'profile_picture',
        'last_login_ip',
        'last_login_at',
        'is_online',
        'privacy_policy_accepted'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'last_login_at' => 'datetime',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function basics()
    {
        return $this->hasMany(Basic::class);
    }

    // Optionally, add an accessor to retrieve the profile picture URL
    public function getProfilePictureUrlAttribute()
    {
        return $this->profile_picture
            ? asset('storage/profile_pictures/' . $this->profile_picture)
            : asset('images/default-avatar.png'); // Provide a default avatar image if no picture
    }
    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable');
    }

    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }
}
