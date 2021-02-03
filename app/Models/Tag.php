<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $fillable = ['name', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function articles()
    {
        return $this->belongsToMany('App\Models\Article');
    }
}
