<?php

namespace App\Models;

use Dotlogics\Grapesjs\App\Contracts\Editable;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Illuminate\Database\Eloquent\Model;

class Form extends Model implements Editable
{
    use EditableTrait;

    protected $fillable = ['gjs_data'];
}
