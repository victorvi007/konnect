<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUlids;
    use InteractsWithMedia;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'banner_alpha',
        'banner_beta',
        'banner_gama',
        'location',
        'category',
        'product',
        'rating',
        'services',
    ];

    protected $casts = [
        'offers' => 'array',
    ];

    protected $hidden = [
        'media',
    ];

    public function registerMediaCollections(): void
    {
      $prefix = config('app.url');

      $this->addMediaCollection('banner_alphas')
        ->useFallbackUrl($prefix . '/images/default-banner-alpha.png')
        ->useFallbackPath(public_path('/images/default-banner-alpha.png'))
        ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png']);

      $this->addMediaCollection('banner_betas')
        ->useFallbackUrl($prefix . '/images/default-banner-beta.png')
        ->useFallbackPath(public_path('/images/default-banner-beta.png'))
        ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png']);

      $this->addMediaCollection('banner_gamas')
        ->useFallbackUrl($prefix . '/images/default-banner-gama.png')
        ->useFallbackPath(public_path('/images/default-banner-gama.png'))
        ->acceptsMimeTypes(['image/jpeg', 'image/jpg', 'image/png']);
    }


    public function getBannerAlphaAttribute()
    {
      $banner_alpha = $this->getFirstMediaUrl('banner_alphas');

      return $banner_alpha;
    }

    public function getBannerBetaAttribute()
    {
      $banner_beta = $this->getFirstMediaUrl('banner_betas');

      return $banner_beta;
    }

    public function getBannerGamaAttribute()
    {
      $banner_gama = $this->getFirstMediaUrl('banner_gamas');

      return $banner_gama;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
