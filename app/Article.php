<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $guarded = [];

    // protected $fillable = ['title', 'content', 'image', 'status'];

	protected $attributes = [
		'status' => 1
    ]; //default for status is gonna be 1

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function getStatusAttribute($attribute)
    {
    	return [
    		0 => 'Unpublished',
    		1 => 'Published',
    	][$attribute];
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function viewedCounter()
    {
        $this->viewed += 1;
        return $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
