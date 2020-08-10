<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, App\User, Carbon\Carbon, Auth, Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function search(Request $request){
        $search = $request->get('search');

        $request->session()->put('search_user', $search);

        $users = DB::table('users')
        ->whereRaw("name like '%$search%' ")
        ->get();

        return view('users.users', compact('users'));
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
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'status' => 'registered',
            'user_type' => $request->user_type,
            'property' => Auth::user()->property,
            'property_type' => Auth::user()->property_type,
            'property_ownership' => Auth::user()->property_ownership,
            'password' => Hash::make(12345678),
            'created_at' => Carbon::now(),
            'account_type' => 'basic',
        ]);

        return redirect('/users')->with('success', 'A new user has been added to the record!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        // if($user_id === Auth::user()->id ){
            $user = User::findOrFail($user_id);
            return view('users.show-user', compact('user'));
        // }else{
        //     return view('unregistered');
        // }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('users.edit-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        if($request->action === 'change_footer_message' ){
            DB::table('users')
            ->where('id', $user_id)
            ->update(
                    [
                        'note' => $request->note,
                    ]
                );

                return back()->with('success', 'Footer message has been updated!');
        }
        if($request->password === null){
            DB::table('users')
           
            ->update(
                    [
                  
                        'email_verified_at' => Carbon::now()
                    ]
                );

                return redirect('/users/'.$user_id)->with('success', 'User Profile has been updated!');
        }else{
            DB::table('users')
            ->where('id', $user_id)
            ->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]
                );

            Auth::logout();

            return redirect('/login')->with('success', 'You have been logged out!');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DB::table('concerns')->delete();

        // DB::table('units')->where('unit_property', 'Bayani Hall')->delete();

        return redirect('/#users')->with('success', 'User has been deleted!');
    }
}
