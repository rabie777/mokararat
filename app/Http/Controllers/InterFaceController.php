<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Requests\ValidRequest;
class InterFaceController extends Controller
{
    public function userinterface()
    {
        return view("face");
    }


    public function rabie(ValidRequest $request)
    {
         
        $validator = $request->filename;
        if ($validator->fails()) 
        {
            return back()->withErrors($validator->errors());
        }
        if ($file   =  $request->file('filename')) {
            $filename = 'uploaded-here.' . $file->getClientOriginalExtension();
            echo "done";
        }
    }
}
