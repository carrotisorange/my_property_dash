<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use DB;

use Carbon\Carbon;

use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $featured_blog = DB::table('users')
        ->join('blogs', 'users.id','user_id_foreign')
        ->select('*', 'blogs.created_at as created_at')
        ->where('published', '1')
        ->latest('blogs.id')
        ->limit(1)
        ->get();

        $blogs = DB::table('blogs')->where('published', '1')->count();

         $previous_blogs = DB::table('users')
        ->join('blogs', 'users.id','user_id_foreign')
        ->select('*', 'blogs.created_at as created_at')
        ->where('published', '1')
        ->orderBy('blogs.id', 'asc')
        
        ->limit($blogs-1)
        ->get();

    
        return view('landing-page.blogs', compact('featured_blog', 'previous_blogs'));
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

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
      
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
 
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
             
            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('blogs')
        ->insert([
            'title' => $request->title,
            'category' => $request->category,
            'body' => $request->body,
            'published' => 0,
            'user_id_foreign' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        return redirect('/users/'.Auth::user()->id.'/#blogs')->with('success', 'New blog has been posted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
