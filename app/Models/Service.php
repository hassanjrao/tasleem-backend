<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=[];

    protected $appends=['image_url'];

    public function getImageUrlAttribute(){
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function serviceCategory(){
        return $this->belongsTo(ServiceCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
