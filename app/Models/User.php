<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUlids;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'phone',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'media',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


      // Define the media collections for Avatars
  public function registerMediaCollections(): void
  {
    $prefix = config('app.url');

    $this->addMediaCollection('avatars')
      ->useFallbackUrl($prefix . '/images/default-avatar.png')
      ->useFallbackPath(public_path('/images/default-avatar.png'))
      ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png']);
  }

  public function setNameAttribute($name)
  {
    $name = ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    $this->attributes['name'] = $name;
  }

  public function getNameAttribute()
  {
    $name = ucfirst($this->attributes['firstname']) . ' ' . ucfirst($this->attributes['lastname']);
    return $name;
  }

  public function getAvatarAttribute()
  {
    $avatar = $this->getFirstMediaUrl('avatars');

    return $avatar;
  }
}
