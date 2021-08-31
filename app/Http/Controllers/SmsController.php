<?php

namespace App\Http\Controllers;

use App\Jobs\SmsBroadcast;
use App\Jobs\InsertBatch;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use App\Cluster;
use App\Vw_ens;
// use App\Vw_employe;
//use App\Recivers;
use DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class SmsController extends Controller
{
    public function index(Request $request)
    {
        $uri = $request->segment(2);
        $cluster = Cluster::where('id', $uri)->first();
            return view('sms.index', compact('cluster'));
    }

    public function post_sms(Request $request)
    {
        
        $mark = $request-> input('mark');
        $da = [];
            foreach ($mark as $value) {
                array_push($da, $value);
            }
        // dd($da);
        $cluster = DB::table('Vw_Cluster')
            ->join('Vw_ClusterArea', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->join('Vw_Employee', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->where('Vw_Cluster.nClusterID', $da[0])
            ->orWhere('Vw_Cluster.nClusterID', $da[0])
            ->orWhere(function ($query) use ($da) {
                foreach ($da as $a) {
                    $query->orWhere('vw_cluster.nClusterID', $a);
                }
            })
            //->get();
            ->select('Vw_Cluster.nClusterID','Vw_Cluster.cClusterName', 'Vw_Employee.*')
            ->get(); 
        
        if($request->has('search_btn')){
            $disaster = DB::table('Vw_EnsDisaster')->get();
                return view('cluster', compact('cluster','da','disaster'));
            }
        if($request->has('send_btn')){
            if(count($cluster) == 0){
                return redirect()->route('clustername')->with('status', 'data employee kosong');
            }else{
            $employe = [];
            $clsr = [];
        
            foreach ($cluster as $value) {
                //  dd($value->nEmployeeID);
                array_push($employe, $value->nEmployeeID);
                array_push($clsr, $value->cClusterName);
            }
            $clsr_dt=array_count_values($clsr);
            
            $user = DB::table('Vw_Employee')
                        ->orWhere(function ($query) use ($employe) {
                            foreach ($employe as $users) {
                                $query->orWhere('nEmployeeID', $users);
                            }
                        })
            ->get();
            // return $user;
            // die;
            $merge=[];
            foreach($user as $item)
            {
                array_push($merge,[
                    'nEmployeeID' => $item->nEmployeeID,
                    'cEnsMessages' => $request->message,
                    'cEnsPhone' =>$item->cMobile,
                    'cEnsStatus' =>'Success',
                    'cEnsFeedback' => '',
                    'dEnsFedbackDate' =>NULL,
                    'dEnsDate' => date('Y-m-d H:i:s')
                ]);
            //sms api
                // $sms=$this->sendSms($item->cMobile, $request->message);
                //yang ini di cooment kalo mau tes masukin data tapi sms nya gasampe
                $this->dispatch(new SmsBroadcast($item->cMobile,  $request->message));
            }
            
            ///ens
            //DB::table('Vw_Ens')->insert($merge);
            $this->dispatch(new InsertBatch($merge));

            $alldst=$request->input('disaster'); 
            
            foreach($alldst as $item){
            $id = DB::table('Vw_EnsGroup')->insertGetId(
                ['dEnsGroupDate' => date('Y-m-d H:i:s'),
                'nEnsDisasterID' => $item]
            );
                foreach($da as $val){
                DB::table('Vw_EnsGroupDetail')->insert(
                    ['nEnsGroupID' => $id,
                    'nClusterID' => $val]
                );
                }
            }
            return redirect()->route('reciver')->with('status', 'send sms successfully');
            }
        }
        
    }
    
    public function send(Request $request)
    {
       
        $ens = $request->input('ens');
        $da = [];
        foreach ($ens as $value) {
            array_push($da, $value);
        }
        //dd($ens);
        $user = DB::table('Vw_Cluster')
            ->join('Vw_ClusterArea', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->join('Vw_Employee', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            //->leftjoin('Vw_Ens', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            // ->where('Vw_ClusterArea.nClusterID', $ens[0])
            // ->orWhere('Vw_ClusterArea.nClusterID', $ens[1])
            ->orWhere(function ($query) use ($da) {
                foreach ($da as $a) {
                    $query->orWhere('vw_cluster.nClusterID', $a);
                }
            })
            ->get();
            //proses pengecekan database di sql.    
        $merge = [];
       //foreach ini buat ngeluarin data users dari varibale $users di tampung di varibale $merge
        //dd($user);
         foreach ($user as $users) {
            array_push($merge, [
              //$tesinsert=[
                'nEmployeeID' => $users->nEmployeeID,
                'cEnsMessages' => $request->message,
                'cEnsPhone' =>$users->cMobile ,
                'cEnsStatus' =>'Success',
                'cEnsFeedback' => '',
                'dEnsFedbackDate' =>NULL,
                'dEnsDate' => date('Y-m-d H:i:s')              
            ]);
        }
        //dd($merge);
        //DB::table('Vw_Ens')->insert($merge);
        $this->dispatch(new InsertBatch($merge));
        return redirect()->route('reciver')->with('status', 'send sms successfully');
    }

    public function download()
    {
        return Excel::download(new UsersExport, 'feedback.xlsx');
    }

    public function send_user(Request $request)
    {
        $employeid=$request->input('nEmployeeID');
        $clusterid=$request->input('cClusterName');
        $da=$request->input('da');
        // dd($clusterid);
        $employe = [];
        $clsr = [];
            foreach ($employeid as $value) {
                array_push($clsr, $clusterid[$value]);
                array_push($employe, $value);
        }
        
        $disaster = DB::table('Vw_EnsDisaster')->get();
        // dd($da);
        // dd($employe, $clsr);
        $clsr_dt=array_count_values($clsr);

        $user = DB::table('Vw_Employee')
                    ->orWhere(function ($query) use ($employe) {
                        foreach ($employe as $users) {
                            $query->orWhere('nEmployeeID', $users);
                        }
                    })
        ->get();
        // return $user;
        // die;
        $merge=[];
            foreach($user as $item)
        {
            array_push($merge,[
                'nEmployeeID' => $item->nEmployeeID,
                'cEnsMessages' => $request->message,
                'cEnsPhone' =>$item->cMobile,
                'cEnsStatus' =>'Success',
                'cEnsFeedback' => '',
                'dEnsFedbackDate' =>NULL,
                'dEnsDate' => date('Y-m-d H:i:s')
            ]);
                //sms api
          //$sms=$this->sendSms($item->cMobile, $request->message);
          $this->dispatch(new SmsBroadcast($item->cMobile,  $request->message));
        }
    
        //DB::table('Vw_Ens')->insert($merge);
        $this->dispatch(new InsertBatch($merge));
    
        $alldst=$request->input('disaster');
            foreach($alldst as $item){
                $id = DB::table('Vw_EnsGroup')->insertGetId(
                    ['dEnsGroupDate' => date('Y-m-d H:i:s'),
                    'nEnsDisasterID' => $item]);
            foreach($da as $val){
                DB::table('Vw_EnsGroupDetail')->insert(
                ['nEnsGroupID' => $id,
                'nClusterID' => $val] );
            }
        }
        return redirect()->route('reciver')->with('status', 'send sms successfully');
    }
 
    public function send_all(Request $request)
    {
        //$sms=$this->sendSms('081912506827','testing masuk');
        // dd($request);
        //dd($sms);
        $alluser=$request->input('employe');
        //dd($alluser);
        // return $alluser;
        // die;
        $user = DB::table('Vw_Employee')
                    ->orWhere(function ($query) use ($alluser) {
                        foreach ($alluser as $users) {
                            $query->orWhere('nEmployeeID', $users);
                        }
                    })
        ->get();
        // return $user;
        // die;
        $merge=[];
        foreach($user as $item)
        {
            array_push($merge,[
                'nEmployeeID' => $item->nEmployeeID,
                'cEnsMessages' => $request->message,
                'cEnsPhone' =>$item->cMobile,
                'cEnsStatus' =>'Success',
                'cEnsFeedback' => '',
                'dEnsFedbackDate' =>NULL,
                'dEnsDate' => date('Y-m-d H:i:s')
            ]);
           
            $this->dispatch(new SmsBroadcast($item->cMobile,  $request->message));
      
            // $sms=$this->sendSms($item->cMobile, $request->message);
            // dd($sms);

        }
    
        //DB::table('Vw_Ens')->insert($merge);
        $this->dispatch(new InsertBatch($merge));

        $alldst=$request->input('disaster');
        $allclsr=$request->input('cluster');
        foreach($alldst as $item){
        $id = DB::table('Vw_EnsGroup')->insertGetId (
            ['dEnsGroupDate' => date('Y-m-d H:i:s'),
             'nEnsDisasterID' => $item]
        );
            foreach($allclsr as $val){
            DB::table('Vw_EnsGroupDetail')->insert(
                ['nEnsGroupID' => $id,
                'nClusterID' => $val]
            );
            }
        }
        return redirect()->route('reciver')->with('status', 'send sms successfully');

    }
    //
    public function send_feedback(Request $request)
    {
        // dd($request);
        
        $merge=[];

            array_push($merge,[
                'nEnsFeedSmsID' => $request->nEnsID,
                'dInsertDate' => date('Y-m-d H:i:s'),
                'dEnsFeedDate' => $request->dEnsFedbackDate,
                'cEnsFeedPhone' => $request->cMobile,
                'cEnsFeedContent' => $request->message
            ]);
            // if(preg_match('/\s/',$message)){
            //     return false;
            // }else{
            //     $this->sendSms($item->cMobile, $request->message);
            // }
            //$this->sendSms($request->cMobile, $request->message);
            $this->dispatch(new SmsBroadcast($request->cMobile,  $request->message));
            // $sms=$this->sendSms($request->cMobile, $request->message);
            // dd($sms);
    
        DB::table('Vw_EnsFeedback')->insert($merge);
        return redirect()->route('feedback')->with('status', 'send feedback successfully');

    }

    function test(){
 
        $this->dispatch(new SmsBroadcast());
    } 
    protected function sendSms ($mobile, $message)
    {
        $msgencode = urlencode($message);
        $url = 'http://api.gosmsgateway.net/api/Send.php?username=ewseedid&mobile=' . $mobile . '&message=' . $msgencode . '&password=gosms3929';
        $ch = \curl_init();
        \curl_setopt($ch, CURLOPT_URL, $url);
        \curl_setopt($ch, CURLOPT_POST, 0);
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = \curl_exec($ch);
        $err = \curl_error($ch);  //if you need
        \curl_close($ch);
        return $response;
    }
}