<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\feedback;
use DB;

class FeedbackDateController extends Controller
{
    public function index()
    {
        //$feedback=feedback::all();
        $dates = Array();
        $smsfb = null;
        $feed = DB::table('Vw_EnsFeedback')->orderBy('dEnsFeedDate', 'ASC')->get();
        $jml = count($feed);
            for($i = 0; $i < $jml; $i++){
                $date = date('Y-m-d', strtotime($feed[$i]->dEnsFeedDate));
            if(in_array($date, $dates)){   
            }else{
                $dates[] = $date;
            }
        }
        //$feedback=DB::table('Vw_EnsFeedback')->distinct(substr('dEnsFeedDate',0,10))->get();
        return view('feedback_date.index',compact('dates'));
    }


    public function show($date)
    {
        //$feedback =DB::table('Vw_EnsFeedback')
        //->Where('dEnsFeedDate',$date)
        //->whereLike('Vw_EnsFeedback.dEnsFeedDate',$date) 
        //->orWhere('dEnsFeedDate', 'like', '%' . $date . '%')
        //->whereDate('Vw_EnsFeedback', $date)
        //->whereDate('Vw_EnsFeedback', '2016-12-31')
        //->get();
        //return view('feed$feedback_date.show', compact('feed$feedback'));
        //dd($feedback);   
        
        $feedback = DB::table('Vw_EnsFeedback')
        ->orWhere(function ($query) use ($date){
                //$query->orWhere('dEnsFeedDate', $date);
                //$query->orWhere('dEnsFeedDate', 'like', '%' . $date . '%');
                $query->whereDate('dEnsFeedDate', $date); 
          })
        ->get(); 
        return view('feedback_date.show',compact('feedback')); 
    }
}
