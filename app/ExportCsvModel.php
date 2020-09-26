<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExportCsvModel extends Model
{
    //
    protected $fillable=[
        'user',
        'title_wishtlist',
        'number_of_items'
    ];
}
