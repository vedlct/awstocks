<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    public $table = 'history';
    public $timestamps = false;
    public $primaryKey = 'historyId';
}
