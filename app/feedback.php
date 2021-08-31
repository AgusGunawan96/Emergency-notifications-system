<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    protected $table = "Vw_EnsFeedback";
    //table ini nanti di sesuain dengan nama yang ada di sql
    protected $guarded = [];
    protected $primaryKey = 'nEnsFeedID';
}
