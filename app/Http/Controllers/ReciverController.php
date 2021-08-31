<?php

namespace App\Http\Controllers;

use App\feedback;
use App\Vw_ens;
// use Yajra\DataTables\Datatables;
// use App\Vw_employe;
use DB;
use Illuminate\Http\Request;

class ReciverController extends Controller
{
    
    public function index()
    {
        // $empsmsfb = DB::table('Vw_Ens')
        // ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
        // ->select('Vw_Ens.*', 'Vw_Employee.*')
        // ->whereBetween('Vw_Ens.dEnsDate', array($date.' 00:00:00', $date.' 23:59:59'))->get();
        
         $reciver = DB::table('Vw_ens')
                 ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
                 ->select('Vw_Ens.*', 'Vw_Employee.*')
                 ->orderBy('dEnsDate', 'desc')
                 ->get();
             
        //kalo ini ga sesuai ganti dEnsdDate nya jadi ensid/ 
        return view('reciver.index', compact('reciver'));
    }
    public function feedback()
    {
        //$feedback=feedback::all();
        $feedback = DB::table('Vw_EnsFeedback')
                ->orderBy('nEnsFeedID', 'desc')
                ->get();
        return view('reciver.feedback',compact('feedback'));
    }
}
