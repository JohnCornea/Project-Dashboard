<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

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
        'firstname',
        'lastname',
        'email',
        'password',
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

    public function posts() : HasMany {
        return $this->hasMany(Post::class);
    }

    protected $appends = ['name', 'username'];

    protected function name(): Attribute
    {
        return new Attribute(
            get: fn() => $this->firstname . '' . $this->lastname
        );
    }

    protected function username(): Attribute
    {
        return new Attribute(
            get: fn() => Str::lower($this->firstname) . '@' . Str::lower($this->lastname) . '-' . $this->id
        );
    }

    // public function getNameAttribute()
    // {
    //     return $this->firstname . '' . $this->lastname;
    // }

    public function setNameAttribute($value)
    {
        return $this->attributes['firstname'] = $value;
    }
}
