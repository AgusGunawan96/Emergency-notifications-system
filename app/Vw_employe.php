<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vw_employe extends Model
{
    protected $table = "Vw_Employee";
    //table ini nanti di sesuain dengan nama yang ada di sql
    protected $guarded = [];
    protected $primaryKey = 'nEmployeeID';
}
