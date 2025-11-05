<?php

namespace App\Models;

use Dotlogics\Grapesjs\App\Contracts\Editable;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements Editable
{
    use EditableTrait;

    protected $fillable = [
        'title',
        'slug',
        'html',
        'css',
        'json',
        'gjs_data',
    ];
}
