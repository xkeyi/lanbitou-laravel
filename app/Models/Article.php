<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Article extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $fillable = ['name', 'sort'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $article) {
            // dd($article);
            Log::info('保存');
            Log::info($article);
            Log::info(request()->all());
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function content()
    {
        return $this->morphOne('App\Models\Content', 'contentable');
    }
}
