<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $fillable = ['name', 'sort'];

    public  function tags()
    {
        return $this->hasMany('App\Models\Tag');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
