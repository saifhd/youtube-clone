<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class Channel extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable=[
        'name',
        'description',
        'image'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
        ->width(100)
            ->height(100)
            ->sharpen(10);
    }
    public function image(){
        if($this->media->first()){
            return $this->media->first()->getFullUrl('thumb');
        }
        return null;
    }
    public function subscribed_users()
    {
        return $this->belongsToMany(User::class, 'subscriptions', 'channel_id', 'user_id');
    }

    public function videos(){
        return $this->hasMany(Video::class);
    }
}
