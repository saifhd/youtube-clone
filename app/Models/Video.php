<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'path',
        'percentage'
    ];
    public function channel(){
        return $this->belongsTo(Channel::class);
    }
}
