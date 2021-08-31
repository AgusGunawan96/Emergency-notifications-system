<?php
namespace App\Http\Controllers;

use App\Cluster as AppCluster;
use Illuminate\Http\Request;
use DB;
use DataTables;

class ClusternameController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(function($request, $next){
        //     $giveAuth=CheckPageAccess(\Auth::user()->id, 'SEED-PREPARE', 'view');
        //     if(CheckPageAccess(\Auth::user()->id, 'ENS-SMS-SENDER', 'view')==1)return $next($request);
        //     abort(403, 'You do not have access to this module');
        // });
    }

    public function json() 
    {
        return DataTables::of(AppCluster::all())->addIndexColumn()->make(true);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cluster = AppCluster::all();
        $disaster = DB::table('Vw_EnsDisaster')->get();
            return view('clustername', compact('cluster','disaster'));
    }

    public function show($id)
    {
        $cluster = AppCluster::all();
        $user = User::find($id);
            return view('user.show', compact('cluster', 'user'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
            return redirect()->route('clustername');
    }


    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
            return redirect()->route('clustername');
    }
}

