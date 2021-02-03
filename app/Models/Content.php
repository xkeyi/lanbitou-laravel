<?php


namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $fillable = ['contentable_type', 'contentable_id', 'body', 'markdown'];

    public function contentable()
    {
        return $this->morphTo();
    }
}
