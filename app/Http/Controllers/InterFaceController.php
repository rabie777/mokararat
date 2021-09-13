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
       //echo "rabie";  
        $validator = $request->file('filename');
        // if ($validator->fails()) 
        // {echo "error here";
        //     return back()->withErrors($validator->errors());
        // }
        
         if($request->file('filename')){
            $file = $request->file('filename');
            $name = $file->getClientOriginalName();
            $extention= $file->getClientOriginalExtension();
             
            
           // return "done";
          
        }
        $filename=$file;
      
       
            $search2="</w:document>";
          
           
        $contents = file_get_contents($filename);
       
        $contents = preg_replace('/' . preg_quote('<w:document') . 
                          '.*?' .
                          preg_quote('>') . '/', '',  $contents);
      
        $contents = str_replace( $search2, "", $contents);
        $contents = str_replace("w:", "w", $contents);
        file_put_contents($filename,$contents);
        $file->move('maged',$name);
    }
}
