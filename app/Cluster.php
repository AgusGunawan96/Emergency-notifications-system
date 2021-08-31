<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $table = "Vw_Cluster";
    //table ini nanti di sesuain dengan nama yang ada di sql
    protected $guarded = [];
}
