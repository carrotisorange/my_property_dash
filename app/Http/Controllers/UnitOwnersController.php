<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\UnitOwner;
use Illuminate\Support\Facades\Auth;

class UnitOwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $property = explode(",", Auth::user()->property);
        
       if(Auth::user()->status === 'registered'){
        $searchKeyInput = $request->searchKeyInput; 
        
        if(count($property) > 1){
            $investors = DB::table('units')
            ->join('unit_owners', 'unit_owner_id', 'unit_unit_owner_id')
            ->whereIn('unit_property', [$property[0],$property[1]])
            ->where('unit_owner', 'like', '%'.$searchKeyInput.'%')
            ->get();
         }else{
            $investors = DB::table('units')
            ->join('unit_owners', 'unit_owner_id', 'unit_unit_owner_id')
            ->where('unit_property', $property[0])
            ->where('unit_owner', 'like', '%'.$searchKeyInput.'%')
            ->get();
         }
        return view('investors', compact('investors'));
       }else{
           return view('unregistered');
       }
    }

    public function search(Request $request){

        $property = explode(",", Auth::user()->property);

        $search = $request->search;

        //creating session for searching unit owner.
        $request->session()->put('search_unit_owner', $search);

        if(count($property) > 1){
            $investors = DB::table('units')
            ->join('unit_owners', 'unit_owner_id', 'unit_unit_owner_id')
            ->whereIn('unit_property', [$property[0],$property[1]])
            ->where('unit_owner', 'like', '%'.$searchKeyInput.'%')
            ->get();
         }else{
            $investors = DB::table('units')
            ->join('unit_owners', 'unit_owner_id', 'unit_unit_owner_id')
            ->where('unit_property', $property[0])
            ->where('unit_owner', 'like', '%'.$searchKeyInput.'%')
            ->get();
         }
        
        

        return view('investors', compact('investors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($unit_id, $unit_owner_id)
    {
        if(Auth::user()->status === 'registered' || auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'manager'){
            $investor = UnitOwner::findOrFail($unit_owner_id);

            $investor_billings = DB::table('units')
           ->join('unit_owners', 'unit_id', 'unit_unit_owner_id')
           ->join('billings', 'unit_owner_id', 'billing_tenant_id')
           ->get();
   
            return view('admin.show-investor', compact('investor'));
        }else{
            return view('unregistered');
        }

       
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
