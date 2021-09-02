<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function tester(){
        $page=0;
        $text='';
        $count=1;
        $txt='';

        $xmll=simplexml_load_file("exp1.xml");
  
        function recurse($child)
        {
     
          $info=array("foo" => "bar");
    
           foreach($child->children() as $children)
            {
            
                if ($children->getName()=="wszCs" )
                  { 
                    $info["size"] = $children->attributes();
                  }
                  if ($children->getName()=="wcolor" )
                  {   
                    $info["color"] = $children->attributes();
                  }
                  if ($children->getName()=="wrFonts" )
                  { 
                    $info["Font"] = $children->attributes();
                  }
    
                  if ($children->getName()=="wb" )
                  { 
                    $info["Bold"] = "Bold";
                  } 
                 
            }
            return  $info;
          
        }
        
         
        $Rinfo=array();
        $color="";
        $size="";
        $Bold="";
        $Font="";
        //echo "ssss";
        $line=0;
        $myfile = fopen("sectors/01-01-01-0".$count.".html", "w") or die("Unable to open file!"); 
    
        foreach ($xmll->children() as $child)
            {
                //echo "sii,s";
     //echo $child->getName()."<br>";
        
            
             foreach($child->children() as $kid ) //Extra tages here 
             {
              //echo $kid ->getName()."<br>";
              if ($kid->getName()=="whyperlink")
              {
                foreach($kid->children() as $kid1 )  
                 {
                   
                  foreach($kid1->children() as $kid2 )
                     {
                      if ($kid2->getName()=="wrPr"){ // many styles here color & size
                        $Rinfo=recurse($kid2);
                        //echo "styles"."<br>";
                      }
    
    
    
                      if ($kid2->getName()=="wt")
                      {
                        if((isset($Rinfo["color"])))
                        {  
                          $color=$Rinfo["color"];
                        }
    
                        if((isset($Rinfo["size"])))
                        {   
                          //echo $kid1."<br>";
                          $size=$Rinfo["size"];
                        }
                        if((isset($Rinfo["Font"])))
                        { 
                          $Font=$Rinfo["Font"];
                        }
                        if((isset($Rinfo["Bold"])))
                        {
                          $Bold="Bold";
                        }
                        //echo "<span style=color:#$color;font-size:$size/2px;font-family:$Font;>$kid2</span>";
                          
                        $text.="<span style=color:#$color;font-size:".$size."px;font-family:$Font>$kid2 &nbsp</span>";
                                    $color="";
                                    $size="";
                                    $Bold="";
                                    $Font="";
                        }
                     }
                 }
              }
    
                      ////////////////////////////////////////
    
              
                      foreach($kid->children() as $kid1 ) // wrpr contain styles and test here you can find all text and its styles inside this foreach .
                      {
    
                        //echo $kid ->getName()."<br>";
                        
                       
    
                        //echo "**".$kid1->getName()."<br>";
                        if ($kid1->getName()=="wrPr")
                        { // many styles here color & size
                          $Rinfo=recurse($kid1);
                          //echo "styles"."<br>";
                        }
                              
                                if ($kid1->getName()=="wt")
                                {
                                  
                                  
                                  
                                    //echo $kid1."<br>";
                                    //echo "////////////////////";
                                          if((isset($Rinfo["color"])))
                                            {  
                                              $color=$Rinfo["color"];
                                            }
    
                                            if((isset($Rinfo["size"])))
                                            {   
                                              //echo $kid1."<br>";
                                              $size=$Rinfo["size"];
                                            }
                                            if((isset($Rinfo["Font"])))
                                            { 
                                              $Font=$Rinfo["Font"];
                                            }
                                            if((isset($Rinfo["Bold"])))
                                            {
                                              $Bold="Bold";
                                            }
                                            //&& !(str_starts_with($kid1, 'p'))
                                            //if($kid1 !=='.' ){ 
                                              //$txt.= $kid1;
                                            
                                  //echo "<span style=color:#$color;font-size:$size/2px;font-family:$Font;>$kid1</span>";
                                  if (str_starts_with($kid1, 'p')) {
                                    if (strchr($kid1,'C')) 
                                    {
                                      $text.='<p  align="center"; ><img src="assets/images/'.$kid1.'.png" ></p>';
                                    }
                                  if (strchr($kid1,'R')) 
                                    {
                                      $text.='<p  align="right" ><img src="assets/images/'.$kid1.'.png" ></p>';
    
                                    }
    
                                //echo $kid1 ."<br>";
                                  //$text.='<p align="center" ><a data-fancybox="images" href="assets/images/'.$kid1.'.png">اضغط هنا لمشاهدة الخريطة التوضيحية</a></p>';
                                
                                  }
                                  if (!str_starts_with($kid1, 'p')&&!str_starts_with($kid1, 'N')) {
                                  
                                  $text.="<span style='" ;
                                  if($color){ $text.= "color:#$color;"; }
                                  $Font="bahij";
                                  $text.="font-size:".$size."px;font-family:$Font;'>$kid1</span>"."\n";
                                  $color="";
                                    if ($kid1=='.'||$kid1=='،')
                                    {
                                      $text.="<br>";
                                    
                                    } 
    
                                    if ($kid1=='N')
                                    {
                                     
                                    $page++;
                                    break;
                                    } 

                                }   
                                if ($kid1=='N') {
                                  $count++;
                                  $text = $text;
                                  
                                  fwrite($myfile,$text);
                                          $color="";
                                          $size="";
                                          $Bold="";
                                          $Font="";
                                          $text="";
                                          $page++;

                                }    
                                if ($kid1=='NB')
                                {
                                 
                                $page++;
                                $text.="<br>";
                                } 

                                          
                                 $myfile = fopen("sectors/01-01-01-0".$count.".html", "w") or die("Unable to open file!");
                                 
                     }  
                    }
           
           }
           
          }
       
       
           
          fwrite($myfile,$text);
          fclose($myfile); 
  
      }
   



    }

