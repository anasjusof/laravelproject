<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $directory = '/images/';
    //
    protected $fillable = [
        'file'
    ];

    public function getFileAttribute($photo){
    	return $this->directory . $photo;
    }

    public static function getFileSystemDirectory($photo){
    	$photo_directory = str_replace('/images/', '\\images\\', $photo);

    	return $photo_directory;
    }
}
