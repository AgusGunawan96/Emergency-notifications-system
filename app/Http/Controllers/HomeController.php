<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vw_ens;
use App\feedback;
use DB;
class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userPerMonth = array();
            for ($i = 1; $i <= 12; $i++) {
                $userPerMonth[$i] = DB::table("Vw_Ens")
                    ->whereMonth('dEnsDate', '=', $i)
                    ->count();
            }
        
        $userPerBulan = array();
            for ($j = 1; $j <= 12; $j++) {
                $userPerBulan[$j] = DB::table("Vw_Ens")
                    ->whereMonth('dEnsFedbackDate', '=', $j)
                    ->where('cEnsFeedback', '!=', '')
                    ->count();
            }

        
        $cluster=DB::table('Vw_Cluster')->pluck('nClusterID', 'cClusterName');
        // dd($cluster);
        $data_cluster_ens = array();
            foreach ($cluster as $clusters) {
            // dd($clusters);
                $data_cluster_ens[$clusters] = DB::table('Vw_Ens')
                    ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
                    ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
                    ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
                    ->where('Vw_Cluster.nClusterID', $clusters)->count();
            }

        $data_cluster_fb1 = array();
            foreach ($cluster as $clusters) {
            // dd($clusters);
                $data_cluster_fb1[$clusters] = DB::table('Vw_Ens')
                    ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
                    ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
                    ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
                    ->where('Vw_Cluster.nClusterID', $clusters)
                    ->where('Vw_Ens.cEnsFeedback', '1')->count();
            }
        $data_cluster_fb2 = array();
            foreach ($cluster as $clusters) {
            // dd($clusters);
                $data_cluster_fb2[$clusters] = DB::table('Vw_Ens')
                    ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
                    ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
                    ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
                    ->where('Vw_Cluster.nClusterID', $clusters)
                    ->where('Vw_Ens.cEnsFeedback', '2')->count();
                }

        $data_cluster_today = array();
        $today = date('Y-m-d');
        $today_in = $today." 00:00:00.000";
        $today_out = $today." 23:59:59.000";
        
        $data_cluster_today = DB::table('Vw_Ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->whereBetween('Vw_Ens.dEnsDate', [$today_in, $today_out])->get();
    
        // dd($data_cluster_today);
        $today_fb = DB::table('Vw_Ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->where('Vw_Ens.cEnsFeedback', '!=', '')
            ->whereBetween('Vw_Ens.dEnsDate', [$today_in, $today_out])->get();

        $need_help = DB::table('Vw_Ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->where('Vw_Ens.cEnsFeedback', '=', '2')
            ->whereBetween('Vw_Ens.dEnsDate', [$today_in, $today_out])->get();

        // dd($today_fb);

        $ens_5 = DB::table('Vw_Ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->orderBy('nEnsID', 'DESC')->offset(0)->limit(5)->get();

        $fb_5 = DB::table('Vw_Ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->where('Vw_Ens.cEnsFeedback', '!=', '')
            ->orderBy('nEnsID', 'DESC')->offset(0)->limit(5)->get();
        // ->whereBetween('Vw_Ens.dEnsDate', [$today_in, $today_out])->get();

                
        $data_disaster = DB::table('Vw_EnsGroupDetail')
            ->join('Vw_EnsGroup', 'Vw_EnsGroupDetail.nEnsGroupID', '=', 'Vw_EnsGroup.nEnsGroupID')
            ->join('Vw_EnsDisaster', 'Vw_EnsGroup.nEnsDisasterID', '=', 'Vw_EnsDisaster.nEnsDisasterID')
            ->join('Vw_Cluster', 'Vw_EnsGroupDetail.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->take(3)
            ->orderBy('nEnsGroupDetailID', 'DESC')->get();

            // $data_disaster = DB::table('Vw_EnsEmployee')
            //     ->join('Vw_EnsGroup', 'Vw_EnsEmployee.nEnsGroupID', '=', 'Vw_EnsGroup.nEnsGroupID')
            //     ->join('Vw_EnsDisaster', 'Vw_EnsGroup.nEnsDisasterID', '=', 'Vw_EnsDisaster.nEnsDisasterID')
            //     ->join('Vw_Ens', 'Vw_EnsEmployee.nEnsID', '=', 'Vw_Ens.nEnsID')
            //     ->take(3)
            //     ->orderby('nEnsEmployeeID', 'DESC')->get();
           
        //dd($data_disaster);
        // $data_disaster = DB::table('Vw_EnsEmployee')
        //     ->join('Vw_EnsGroup', 'Vw_EnsEmployee.nEnsEmployeeID', '=', 'Vw_EnsGroup.nEnsGroupID')
        //     ->join('Vw_EnsDisaster', 'Vw_EnsGroup.nEnsDisasterID', '=', 'Vw_EnsDisaster.nEnsDisasterID')
        //     ->join('Vw_Ens', 'Vw_EnsEmployee.nEnsID', '=', 'Vw_Ens.nEnsID')
        //     ->take(3)
        //     ->orderBy('nEnsEmployeeID', 'DESC')->get();


        // $data_disaster = Array();
        // foreach ($data_disaster2 as $value) {
        //     $data_disaster[$value->dEnsGroupDate][] = $value;
        // }

        // foreach ($data_disaster as $key => $value) {
        //     var_dump($key);
        //     foreach ($value as $val) {
        //         var_dump($val);
        //     }
        //     dd("1");
        // }
        // dd($data_disaster);

        $bls_fb1 = DB::table('Vw_Ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->where('Vw_Ens.cEnsFeedback', '=', '1')
            ->whereBetween('Vw_Ens.dEnsDate', [$today_in, $today_out])->count();

        $bls_fb2 = DB::table('Vw_Ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->where('Vw_Ens.cEnsFeedback', '=', '2')
            ->whereBetween('Vw_Ens.dEnsDate', [$today_in, $today_out])->count();

        $nobls_fb = DB::table('Vw_Ens')
            ->join('Vw_Employee', 'Vw_Ens.nEmployeeID', '=', 'Vw_Employee.nEmployeeID')
            ->join('Vw_ClusterArea', 'Vw_Employee.nSiteAreaID', '=', 'Vw_ClusterArea.nSiteAreaID')
            ->join('Vw_Cluster', 'Vw_ClusterArea.nClusterID', '=', 'Vw_Cluster.nClusterID')
            ->where('Vw_Ens.cEnsFeedback', '=', '')
            ->whereBetween('Vw_Ens.dEnsDate', [$today_in, $today_out])->count();

        $fb_1hr = [];
        $fb_2hr = [];
        $fb_3hr = [];
        $fb_more = [];
        $fb_tms = [];
            foreach ($today_fb as $value) {
                $date = strtotime($value->dEnsFedbackDate) - strtotime($value->dEnsDate);
                $times = $date/60;
                    if($times <= 60){
                        array_push($fb_1hr, $times);
                    }else if($times > 60 && $times <= 120){
                 array_push($fb_2hr, $times);
            }
                else if($times > 120 && $times <= 180){
                    array_push($fb_3hr, $times);
                        }else{
                    array_push($fb_more, $times);
                }
            }
        $jml1hr = count($fb_1hr);
            if(count($fb_2hr) != 0){
                $jml2hr = count($fb_2hr)+$jml1hr;
                    }else{
                $jml2hr = 0;
            }
        if(count($fb_3hr) != 0){
            $jml3hr = count($fb_3hr)+$jml2hr;
                }else{
            $jml3hr = 0;
            }
        if(count($fb_more) != 0){
            $jmlmore = count($fb_more)+$jml3hr;
                }else{
            $jmlmore = 0;
            }
        array_push($fb_tms, $jml1hr, $jml2hr, $jml3hr, $jmlmore);
        // dd($fb_tms);
        $ens=Vw_ens::all()->count();
        $reciver=DB::table('Vw_Ens')->count();
        $feedback=DB::table('Vw_EnsFeedback')->count();
            return view('home',compact('ens','cluster','reciver','feedback','userPerMonth','userPerBulan','data_cluster_ens','data_cluster_fb1','data_cluster_fb2','data_cluster_today','today_fb','ens_5','fb_5','data_disaster','bls_fb1','bls_fb2','nobls_fb','fb_tms','need_help'));
    }
}