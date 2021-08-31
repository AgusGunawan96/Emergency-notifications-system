<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vw_ens extends Model
{
    protected $table = "Vw_Ens";
    //table ini nanti di sesuain dengan nama yang ada di sql
    protected $guarded = [];
    protected $primaryKey = 'nEnsID';


    public function Employe()
    {
        return  $this->belongsTo('App\Vw_employe', 'nEmployeeID');
    }
}
