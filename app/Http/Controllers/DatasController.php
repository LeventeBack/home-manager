<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\User;
use DB;

class DatasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()){
            $datas = Data::orderBy('created_at', 'desc')->get();   
        } else {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $datas = DB::table('datas')->whereIn('sensor_id',  array($user->sensors->getIds()))->orderBy('created_at', 'desc')->get();
            foreach ($datas as $data){
                return $data->sensor;
            }
        }

        return view('datas.index')->with('datas', $datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/datas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ARDUINIO REQUEST
        $this->validate($request, [
            'sensor_id' => 'required',
            'temperature' => 'required',
            'humidity' => 'required',
            'pressure' => 'required'
        ]);

        $data = new Data();
        $data->sensor_id = $request->input('sensor_id'); 
        $data->temperature = $request->input('temperature'); 
        $data->humidity = $request->input('humidity'); 
        $data->pressure = $request->input('pressure'); 

        $data->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Data::find($id);

        return view('datas.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('/datas');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('/datas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Data::find($id);

        if(auth()->user()->isAdmin()){
            $data->delete();
            return redirect('/datas')->with('success', 'Data Deleted');
        } else {
            return redirect('/datas')->with('error', 'Unathorized Page');   
        }
    }
}
