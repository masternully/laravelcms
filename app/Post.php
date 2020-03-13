<?php

namespace App;

use App\Tag;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body'];

    public function user(){ return $this->belongsTo(User::class);}
    public function categories(){ return $this->belongsToMany(Category::class)->withTimestamps();}
    public function tags(){ return $this->belongsToMany(Tag::class)->withTimestamps();}

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getUrlAttribute(){
        return route('posts.show', $this->id);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function favorite_to_users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function scopeApproved($query){
        return $query->where('is_approved', 1);
    }

    public function scopePublished($query){
        return $query->where('status', 1);
    }
}
