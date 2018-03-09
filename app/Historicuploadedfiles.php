<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historicuploadedfiles extends Model
{
    public $table = 'historicuploadedfiles';
    public $timestamps = false;
    public $primaryKey = 'historicUploadedFilesId';
}
