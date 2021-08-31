<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vw_ens;
use DB;
class ReciverDateController extends Controller
{
    
    public function index()
    {
        //$reciver = Vw_ens::all();
        $dates = Array();
        $empsmsfb = null;
        $feed = DB::table('Vw_Ens')->orderBy('dEnsDate', 'DESC')->get();
        $jml = count($feed);
            for($i = 0; $i < $jml; $i++){
                $date = date('Y-m-d', strtotime($feed[$i]->dEnsDate));
                    if(in_array($date, $dates)){   
                    }else{
                $dates[] = $date;
            }
        }
        return view('reciver_date.index', compact('dates'));
    }

    public function show($date)
    {
        // $reciver =DB::table('Vw_ens')
        //               ->where('dEnsDate',$date)
        //               ->get();
        $reciver = DB::table('Vw_ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->select('Vw_Ens.*', 'Vw_Employee.*')
            ->orWhere(function ($query) use ($date){
                //$query->orWhere('dEnsDate', $date);
                $query->whereDate('dEnsDate', $date); 
                //$query->orWhere('dEnsFeedDate', 'like', '%' . $date . '%');
            })
            ->get(); 
        //return view('reciver_date.show', compact('reciver'));
        return view('reciver.index', compact('reciver'));  
    }
}
