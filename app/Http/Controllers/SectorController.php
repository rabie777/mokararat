<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectorController extends Controller
{
   //////////////header///////////////////
    

  /////////////////////////////////
    public function tester(){
        $page=0;
        $text='';
        $count=1;
        $head=0;
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
                        //echo "<div style=color:#$color;font-size:$size/2px;font-family:$Font;>$kid2</div>";
                          
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
                                            
                                 // echo "<div style=color:#$color;font-size:$size/2px;font-family:$Font;>$kid1</div>";
                                  if (str_starts_with($kid1, 'P')) {
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
                                  if (!str_starts_with($kid1, 'P')&&!str_starts_with($kid1, 'N')) {
                                  ////////////////////////////////////////////////////
                                   
                                  /*if (str_starts_with($kid1, 'HB')) {
                                   $text.="<div class='Header_Box' >";
                                   
                                  }
                             
                                  $text.="<span  style='" ;
                                  if($color){ $text.= "color:#$color;"; }
                                  //s$Font="bahij";
                                  $text.="font-size:".$size."px;font-family:$Font;'>$kid1</span>"."\n";
                                   


                                  if (str_starts_with($kid1, 'EH')) {
                                    
                                    $text.="</div>";
                                    
                                  
                                  }*/
                                  //////////////////////////////////////////////////////
                                   if ($kid1=='TB') {
                                    $text.="<div class='Title_Box'>";
                                   }
                              
                                   $text.="<span  style='" ;
                                   if($color){ $text.= "color:#$color;"; }
                                   //s$Font="bahij";
                                   $text.="font-size:".$size."px;font-family:$Font;'>$kid1</span>"."\n";
                                    
 
                                   if ($kid1=='ET') {
                                     $text.="</div>";
                                   }
                                  //////////////////////////////////////////////////
                                    
                                /*  if (str_starts_with($kid1, 'TB')) {
                                    
                      
                                    $text.="<div class='Title_Box' >";
                                  
                                  }
                                  
                                  $text.="<span  style='" ;
                                  if($color){ $text.= "color:#$color;"; }
                                  //s$Font="bahij";
                                  $text.="font-size:".$size."px;font-family:$Font;'>$kid1</span>"."\n";
                                  


                                  if (str_starts_with($kid1, 'ET')) {
                                    
                                    $text.="</div>";
                                    $text.=" ";
                                  
                                  }*/




                                  /*$text.="<div  style='" ;
                                  if($color){ $text.= "color:#$color;"; }
                                  //s$Font="bahij";
                                  $text.="font-size:".$size."px;font-family:$Font;'>$kid1</div>"."\n";
          
*/





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

                                                                  ///////////////////////////////start of header ///////////////////////////
     
      $pageTop=' 
      <!doctype html>
      <html dir="rtl">

      <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>تعريف الطهارة لغة وشرعًا</title>
        <meta property="og:title" content="دار الإفتاء المصرية">
        <meta property="og:description" content="دار الإفتاء المصرية">
        <meta name="keywords" content="دار الإفتاء المصرية">
        <meta name="description" content="دار الإفتاء المصرية">
        <meta name="author" content="http://dar-alifta.org/">
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/favicon-16x16.png">
        <link rel="manifest"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage"
          content="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/fav/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <!-- Vendor CSS -->
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/bootstrap-rtl/bootstrap-rtl.css">
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/simple-line-icons/css/simple-line-icons.min.css">
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/css/theme-animate.css">
        <!-- custom Font Icon -->
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/Fonts/ICONS/styles.css">
        <!-- Theme CSS -->
        <!--<link rel="stylesheet" href="../css/theme.css">
                  <link rel="stylesheet" href="../css/theme-elements.css">
                  <link rel="stylesheet" href="../css/theme-blog.css">
                  <link rel="stylesheet" href="../css/theme-shop.css">-->
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/css/rtl-theme.css">
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/css/rtl-theme-elements.css">
        <!-- Skin CSS -->
        <link rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/css/skins/default.css">
        <!--<script src="../master/style-switcher/style.switcher.localstorage.js"></script>-->
        <!-- mCustomScrollbar -->
        <link rel="stylesheet" type="text/css"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/mCustomScrollbar/jquery.mCustomScrollbar.css">
        <!-- Head Libs -->
        <script
          src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/modernizr/modernizr.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script
          src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/js/ie10-viewport-bug-workaround.js"></script>
        <script
          src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/prefixfree/prefixfree.min.js"></script>
        <!-- hover.css -->
        <link rel="stylesheet" type="text/css"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/css/hover.css">
        <!-- Main CSS -->
        <link href="https://fonts.googleapis.com/css?family=Cairo|Tajawal&amp;display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://www.fontstatic.com/f=bahij">
        <link rel="stylesheet" type="text/css"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/css/Viewer-rtl.css">
        <!-- slick 1.6 CSS -->
        <link rel="stylesheet" type="text/css"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/slick_1.6/slick.css">
        <link rel="stylesheet" type="text/css"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/slick_1.6/slick-theme.css">
        <!-- Templat CSS -->
        <link rel="stylesheet" type="text/css"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/css/Templates-rtl.css">
        <link type="text/css" rel="stylesheet"
          href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/css/fonts.css"
          charset="utf-8">
        <style>
          #MainArea .MainScr .MainScr_med_med,
          .SupportTempsInPopup .MainScr .MainScr_med_med {
            background: #ffffff;
          }
      
          #Temp009 .TextArea {
            max-height: 75vh;
          }
      
          .MainScr {
            margin-bottom: 0px !important;
          }
      
          .body {
            height: 100% !important;
          }
          .Header_Box {
            background-color: #e6ffff;
            color: black;
            border: 2px solid black;
            margin: 20px;
            padding: 20px;
          }
          .Title_Box{
            background-color: #00ffff;
            color: black;
            border: 2px solid black;
            margin: 20px;
            padding: 20px;
          }
        </style>
      </head>
      
      <body id="mybody">
        <div class="site-overlay"></div>
        <div class="body">
      
          <div class="cleaner"></div>
          <div id="R02">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="table MainAreTable">
                    <div class="table-row">
                      <div class="table-cell SideMenuWrapper">
                        <div class="features_btns">
                          <div class="features_main">
                            <a id="t0_btn" href="#" rel="toggle[HelpingTools]"
                              data-openimage="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/HelpingTools_Down.png"
                              data-closedimage="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/HelpingTools_Top.png"
                              class="hvr-bounce-to-bottom HomeToolTip01" title="الأدوات المساعدة"> <img
                                src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/HelpingTools_Down.png"
                                border="0"> </a>
                          </div>
                          <div id="HelpingTools" class="features_2">
                            <a href="#" data-toggle="modal" data-target="#Notes_Scr"
                              class="hvr-bounce-to-bottom HomeToolTip01" title="الملاحظات"> <img
                                src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/Note.png"
                                alt=""> </a>
                            <a href="https://storage.googleapis.com/ifta-learning-dp/uploads/courses_reference/012/unit1/index.html"
                              data-toggle="modal" data-target="#References_Scr"
                              class="hvr-bounce-to-bottom HomeToolTip01 fancybox fancybox.iframe" title="المراجع"> <img
                                src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/Glossary.png"
                                alt=""> </a>
                            <a onclick="window.location.reload(true)" href="javascript:void()"
                              class="hvr-bounce-to-bottom HomeToolTip01" title="إعادة تحميل الصفحة"> <img
                                src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/Reload.png"
                                alt=""> </a>
                            <a class="fancybox fancybox.iframe hvr-bounce-to-bottom HomeToolTip01"
                              href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/templates/01-12/course_help.html"
                              title="ارشادات الاستخدام"> <img
                                src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/Help.png"
                                alt=""> </a>
                            <a class="hvr-bounce-to-bottom HomeToolTip01 fullScreen" href="javascript:void()"
                              title="ملئ الشاشة"> <img
                                src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/fullscreen.png"
                                alt=""> </a>
                          </div>
                        </div>
                      </div>
                      <div class="table-cell MainAreWrapper">
                        <div class="unit_btns">
                          <a class="hvr-bounce-to-bottom" href="#"> <img class="icon"
                              src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/unit_menu_icon_01.png"
                              alt=""> <span class="text">المقدمة</span> </a>
                          <a class="fancybox fancybox.iframe hvr-bounce-to-bottom"
                            href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/templates/01-12/map/map.html"
                            title="الخريطة"> <img class="icon"
                              src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/unit_menu_icon_02.png"
                              alt=""> <span class="text">الخريطة</span> </a>
                          <a class="fancybox fancybox.iframe hvr-bounce-to-bottom"
                            href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/templates/01-12/glossaries.html"
                            title="المعاجم"> <img class="icon"
                              src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/unit_menu_icon_03.png"
                              alt=""> <span class="text">المعجم</span> </a>
                          <a class="fancybox fancybox.iframe hvr-bounce-to-bottom"
                            href="https://storage.googleapis.com/ifta-learning-dp/uploads/courses_libs/index.html"
                            title="المكتبة"> <img class="icon"
                              src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/References.png"
                              alt=""> <span class="text">المكتبة</span> </a>
                          <a href="rm011.htm" class="hvr-bounce-to-bottom" title="الخلاصة"> <img class="icon"
                              src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/unit_menu_icon_05.png"
                              alt=""> <span class="text">الملخص</span> </a>
                        </div>
                        <!-- Temp comes her -->
                        <div id="MainArea">
                          <div id="Temp009" class="MainBg" data-appear-animation="fadeIn" data-appear-animation-delay="100">
                            <div class="wrapper">
                              <div class="Title2" data-appear-animation="fadeInDown" data-appear-animation-delay="200">
                                <div class="table TitleBox2">
                                  <div class="table-row">
                                    <div class="table-cell td01"></div>
                                    <div class="table-cell td06">
                                      <div class="table TitleBox2-main">
                                        <div class="table-row">
                                          <div class="table-cell right-s">
                                          </div>
                                          <div class="table-cell">
                                          </div>
                                          <div class="table-cell left-s">
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="table-cell td07"></div>
                                  </div>
                                </div>
                              </div>
                              <div class="cleaner"></div>
                              <div id="MainScr" class="table MainScr" data-appear-animation="bounceIn"
                                data-appear-animation-delay="800">
                                <div class="table-row">
                                  <div class="table-cell MainScr_top_right"></div>
                                  <div class="table-cell MainScr_top_med"></div>
                                  <div class="table-cell MainScr_top_left"></div>
                                </div>
                                <div class="table-row">
                                  <div class="table-cell MainScr_med_right"></div>
                                  <div class="table-cell MainScr_med_med">
                                    <div class="TextArea content-rd">
             
        ';
   /////////////////////////////// end of header   //////////////////////////


///////////////////////////////begin of footer ////////////////////////////////

$next=$count+1;
 
$bef="LeftArrow";
$nxt="RightArrow";
if($count==1)
{  
$num=$count;
$bef="LeftArrow off ";
}
else
{   $num=$count-1;
     
}
 

 

$tools='
        </div> 
        </div> 
        <div class="table-cell MainScr_med_left"></div> 
       </div> 
       <div class="table-row"> 
        <div class="table-cell MainScr_bot_right"></div> 
        <div class="table-cell MainScr_bot_med"> 

        <a href="01-01-01-0'.$num.'.html" class="'.$bef.'" title="السابق"></a>

         <a href="01-01-01-01.html" class="HomeArrow" title="المقدمة"></a> 

         <a href="01-01-01-0'.$next.'.html" class="'.$nxt.'" title="التالي"></a> 

         <a href="javascript:void()" class="centerArrow " title="جميع الحقوق محفوظة دار الإفتاء المصرية"></a> 
         <img id="increaseFont" src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/templates/Temp-General/FontPlus.png" class="FontPlus" title="تكبير حجم الخط"> 
         <img src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/templates/Temp-General/fontDefualt.png" id="bahij" class="fontDefualt" title="إستعاد حجم الخط"> 
         <img src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/templates/Temp-General/fontMins.png" id="decreaseFont" class="fontMins " title="تصغير حجم الخط"> 
        </div>';
        $footer='
        <div class="table-cell MainScr_bot_left"></div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="cleaner"></div>
<div id="R03">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="table NavigationTable">
<div class="table-row">
<!-- <div id="blank_div" class="table-cell blank_div"> </div> -->
<!--  <div id="NavigationArea" class="table-cell">
<div class="NavBox"> <a href="0361-01.html" class="RightArrow off" title="السابق"></a>
<div class="pagerBox">
<div class="inner"> <span class="PageNum"> <span id="Page_N">99</span> <span>من</span> <span id="Page_T">99</span> </span>
<input id="p_txt" class="go_to HomeToolTip02" type="text" placeholder="ادخل" title="قم بادخال رقم الصفحة المراد الانتقال اليها">
<button id="go_btn" type="button"><i class="fa fa-hand-o-up"></i></button>
</div>
</div> 
<a href="#" class="LeftArrow" title="التالي"></a> </div>
</div>-->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- <div class="footer"> جميع الحقوق محفوظة © | دار الإفتاء المصرية  </div> -->
<div class="modal fade modal_style1" id="Notes_Scr" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<div class="table modal_header_table">
<div class="table-row">
<div class="table-cell icon_area">
<img
  src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/Note.png"
  width="23" height="23" alt="">
</div>
<div class="table-cell title_area">
ملاحظات الوحدة
</div>
<div class="table-cell close_area" data-dismiss="modal" aria-hidden="true">
<img
  src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/viewer/icons/close_big.png"
  width="20" height="20" data-dismiss="modal" aria-hidden="true" alt="">
</div>
</div>
</div>
</div>
<div class="modal-body">
<ul class="nav nav-tabs nav-left tabs-primary">
<li class="active"> <a href="#Add_Notes" data-toggle="tab"><i class="fa fa-plus"></i> إضافة ملاحظة</a>
</li>
</ul>
<div class="tab-content">
<div id="Add_Notes" class="tab-pane active">
<form>
<div class="form-group has-error has-feedback">
  <span class="new_title_icon"><i class="fa fa-quote-right" aria-hidden="true"></i></span>
  <label for="NoteTitle" class="new_title_txt">عنوان الملاحظة:</label>
  <input type="text" class="form-control " id="NoteTitle" placeholder="فضلا قم بادخال عنوان الملحوظة">
</div>
<div class="alert alert-danger" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span> برجاء ادخال عنوان للملاحظة
</div>
<div class="form-group">
  <span class="new_title_icon"><i class="fa fa-align-right" aria-hidden="true"></i></span>
  <label class="new_title_txt" for="exampleInputPassword1">محتوي الملاحظة :</label>
  <textarea class="form-control" id="textarea" name="textarea"
    placeholder="فضلا قم بادخال عنوان الملحوظة"></textarea>
</div>
<div class="alert alert-danger hidden" role="alert">
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">خطأ:</span> برجاء ادخال محتوي للملاحظة
</div>
<div class="modal-footer">
  <div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <span class="glyphicon icon-check icons" aria-hidden="true"></span> تم حفظ الملحوظة بنجاح
  </div>
  <a data-bb-handler="cancel" class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i
      class="fa fa-times"></i> إلغاء</a>
  <a data-bb-handler="confirm" class="btn btn-primary"><i class="fa fa-check"></i> حفظ</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Vendor -->
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/jquery/jquery.min.js"></script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/jquery.appear/jquery.appear.min.js"></script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/jquery-cookie/jquery-cookie.min.js"></script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/common/common.min.js"></script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/jquery.validation/jquery.validation.min.js"></script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/jquery.stellar/jquery.stellar.min.js"></script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<!-- Theme Base, Components and Settings 
<script src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/js/theme.js"></script> -->
<!-- Current Page Vendor and Views -->
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/js/views/view.home.js"></script>
<!-- Theme Custom -->
<script src="./assets/custom.js"></script>
<!-- Theme Initialization Files -->
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/js/theme.init.js"></script>
<!-- Tooltip  -->
<link rel="stylesheet" type="text/css"
href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/tooltipster/css/tooltipster.bundle.css">
<link rel="stylesheet" type="text/css"
href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css">
<link rel="stylesheet" type="text/css"
href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css">
<link rel="stylesheet" type="text/css"
href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/tooltipster/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-punk.min.css">
<script type="text/javascript"
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/tooltipster/js/tooltipster.bundle.min.js"></script>
<script>
$(document).ready(function () {



$(".fontMins, .FontPlus, .fontDefualt, .HomeArrow, .centerArrow ,.LeftArrow,.RightArrow,.HomeToolTip04,.HomeToolTip03,.HomeToolTip02,.HomeToolTip01,.tooltip_temp009").tooltipster(

{
animation: "grow",
delay: 10,
theme: "tooltipster-light",
touchDevices: true,
trigger: "hover",
maxWidth: 400,
distance: 5,
side: ["right", "top", "bottom", "left"]


}
);





});
</script>
<!-- Add fancyBox -->
<link rel="stylesheet"
href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/fancybox/source/jquery.fancybox8cbb.css?v=2.1.5"
type="text/css" media="screen">
<script type="text/javascript"
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/fancybox/source/jquery.fancybox.pack8cbb.js?v=2.1.5"></script>
<!-- Optionally add helpers - button, thumbnail and/or media -->
<!--<link rel="stylesheet" href="script/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="script/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="script/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="script/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="script/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>-->
<!-- Text ReSizer -->
<script src="./assets/textsizer.js"></script>
<script src="./assets/custom.js"></script>
<script type="text/javascript">

$(document).ready(function () {
$(".fancybox").fancybox();
});

jQuery(document).ready(function () {
jQuery(".various").fancybox({
maxWidth: 1200,
maxHeight: 700,

fitToView: false,
width: "95%",
height: "98%",
autoSize: false,
closeClick: false,
openEffect: "fade",
openSpeed: 500,
closeEffect: "fade",
padding: 0,
closeBtn: false
});

jQuery(".PhotoPop").fancybox({
maxWidth: 1000,
maxHeight: 700,
minWidth: 200,
minHeight: 200,
fitToView: false,
//width		: "50%",
//height		: "50%",
fitToView: true,
autoSize: true,
autoScale: true,
closeClick: false,
openEffect: "fade",
openSpeed: 500,
closeEffect: "fade",
padding: 20,
closeBtn: true
});

jQuery(".PhotoPop").on("click", function () {
setTimeout(function () { $(".fancybox-skin").addClass("new-pop-01"); }, 50);
});


jQuery(".PhotoG").fancybox({
openEffect: "elastic",
closeEffect: "elastic",
});

jQuery(".PhotoG").on("click", function () {
setTimeout(function () { $(".fancybox-skin").addClass("new-pop-01"); }, 50);
});

$(".single_photo").fancybox({
maxWidth: 1600,
helpers: {
title: {
type: "float"
}
}
});

jQuery(".InteractivePhotoPop").fancybox({
maxWidth: 1200,
//maxHeight	: 700,
minWidth: 200,
minHeight: 200,
//fitToView	: false,
width: "90vw",
height: "90vh",
fitToView: true,
autoSize: true,
autoScale: true,
closeClick: false,
openEffect: "fade",
openSpeed: 500,
closeEffect: "fade",
padding: 20,
closeBtn: true
});

jQuery(".InteractivePhotoPop").on("click", function () {
setTimeout(function () { $(".fancybox-skin").addClass("new-pop-01"); }, 50);
setTimeout(function () { $(".fancybox-skin").addClass("Interactive-pop-01"); }, 50);
});

});
</script>
<!-- mCustomScrollbar -->
<link rel="stylesheet" type="text/css"
href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/mCustomScrollbar/jquery.mCustomScrollbar.css">
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
(function ($) {
$(window).on("load", function () {
$.mCustomScrollbar.defaults.scrollButtons.enable = true; //enable scrolling buttons by default
$(".p_menu_container").mCustomScrollbar({
axis: "y",
theme: "light-3",

});
$(".inner_txt").mCustomScrollbar({
axis: "y",
theme: "dark-3",

});
$(".Notes_result_wrapper").mCustomScrollbar({
axis: "y",
theme: "rounded-dark",

});
$(".TermsArea").mCustomScrollbar({
axis: "y",
theme: "rounded-dark",

});

$(".ReferencesArea").mCustomScrollbar({
axis: "y",
theme: "rounded-dark",

});

$(".content-rd").mCustomScrollbar({
axis: "y",
theme: "rounded-dark",

});

$(".dark-3").mCustomScrollbar({
axis: "y",
theme: "dark-3",

});
});
})(jQuery);
</script>
<script>
(function ($) {
$(window).on("load", function () {
$.mCustomScrollbar.defaults.scrollButtons.enable = true; //enable scrolling buttons by default
$(".modal-mCustomScrollbar").mCustomScrollbar({
axis: "yx",
theme: "dark-3",
setHeight: 400,

});


});
})(jQuery);
</script>
<!-- Pushy CSS -->
<link rel="stylesheet"
href="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/pushy/css/pushy.css">
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/pushy/js/pushy.js"></script>
<!--<script>

$("#SearchBtn").on("click", function ()
{ pushy = $("#Search"); push = $("#Search"); init(); DPush(); });

$("#MenuBtn").on("click", function ()
{ pushy = $("#MainMenu"); push = $("#MainMenu"); init(); DPush(); });
</script>-->
<!-- Animated Collapsible DIV v2.4 -->
<script type="text/javascript">
var Closed = false;
jQuery(document).ready(function () {
$("#t0_btn").on("click", function () {


if (!Closed) {
$(".blank_div").animate({ opacity: 0 }, 400);
Closed = true;
}
else {

$(".blank_div").animate({ opacity: 1, }, 400);
Closed = false;
}


})


});
</script>
<script type="text/javascript"
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/AnimatedCollapsibleDIVv2.4/animatedcollapse.js"></script>
<script type="text/javascript">
animatedcollapse.addDiv("HelpingTools", "fade=1,speed=400,group=HelpingTools")

//animatedcollapse.addDiv("home_u_btn", "fade=1,speed=400,group=u_btns")
//animatedcollapse.addDiv("introduction_u_btn", "fade=1,speed=400,group=u_btns,hide=1")
//animatedcollapse.addDiv("objectives_u_btn", "fade=1,speed=400,group=u_btns,hide=1")
//animatedcollapse.addDiv("activities_u_btn", "fade=1,speed=400,group=u_btns")
//animatedcollapse.addDiv("output_u_btn", "fade=1,speed=400,group=u_btns,hide=1")
//animatedcollapse.addDiv("summary_u_btn", "fade=1,speed=400,group=u_btns,hide=1")
//animatedcollapse.addDiv("LearningResources_u_btn", "fade=1,speed=400,group=u_btns,hide=1")

animatedcollapse.ontoggle = function ($, divobj, state) { //fires each time a DIV is expanded/contracted
//$: Access to jQuery
//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
//state: "block" or "none", depending on state


}

animatedcollapse.init()

</script>
<!-- slick 1.6 JS -->
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/slick_1.6/slick.js"
type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(document).on("ready", function () {

$(".slider-for").slick({

arrows: false,
fade: true,
dots: false,
adaptiveHeight: true,
asNavFor: ".slider-nav",
rtl: true,
});
$(".slider-nav").slick({
centerMode: true,
centerPadding: "00px",
slidesToShow: 3,
slidesToScroll: 1,
autoplay: false,
autoplaySpeed: 2000,
adaptiveHeight: true,
asNavFor: ".slider-for",
rtl: true,
arrows: false,


focusOnSelect: true
});

$(".PhotosWrapper").slick({
infinite: true,
slidesToShow: 3,
slidesToScroll: 1,
rtl: true,
adaptiveHeight: true,
dots: true,
infinite: false,
responsive: [
{
breakpoint: 769,
settings: {
slidesToShow: 2,
slidesToScroll: 2,

}
},

{
breakpoint: 601,
settings: {
slidesToShow: 1,
slidesToScroll: 1,

}
},
]
});

$("#grid-containter").slick({
infinite: true,
slidesToShow: 3,
slidesToScroll: 1,
rtl: true,
adaptiveHeight: true,
dots: true,
infinite: false,
responsive: [
{
breakpoint: 992,
settings: {
slidesToShow: 2,
slidesToScroll: 2,

}
},

{
breakpoint: 550,
settings: {
slidesToShow: 1,
slidesToScroll: 1,

}
},
]
});

$(".DragSlider").slick({
infinite: true,
slidesToShow: 5,
slidesToScroll: 1,
rtl: true,
adaptiveHeight: true,
dots: true,
arrows: true,
infinite: false,
responsive: [
{
breakpoint: 991,
settings: {
slidesToShow: 3,
slidesToScroll: 1,

}
},

{
breakpoint: 601,
settings: {
dots: true,
arrows: true,
slidesToShow: 2,
slidesToScroll: 1,

}
},

{
breakpoint: 360,
settings: {
slidesToShow: 1,
slidesToScroll: 1,

}
},


]
});

//$(".tabs_links").slick({
//  
//  slidesToShow: 3,
//  slidesToScroll: 1,
//  rtl:true,
//  adaptiveHeight: true,
//  dots: false,
//  infinite: false,
//  responsive: [
//    {
//      breakpoint: 768,
//      settings: {
//        slidesToShow: 2,
//        slidesToScroll: 1,
//       
//      }
//    },
//	
//	{
//      breakpoint: 481,
//      settings: {
//        slidesToShow: 1,
//        slidesToScroll: 1,
//       
//      }
//    },
//]
//});

$(".tabs_links").slick({

slidesToShow: 3,
slidesToScroll: 1,
//rtl:true,
adaptiveHeight: true,
dots: false,
infinite: false,
vertical: true,
verticalSwiping: true,
responsive: [
{
breakpoint: 992,
settings: {
vertical: false,
slidesToShow: 3,
slidesToScroll: 1,
rtl: true,

}
},

{
breakpoint: 768,
settings: {
slidesToShow: 2,
slidesToScroll: 1,
vertical: false,
rtl: true,

}
},

{
breakpoint: 481,
settings: {
slidesToShow: 1,
slidesToScroll: 1,
vertical: false,
rtl: true,

}
},
]
});

});
</script>
<!-- tabs-module | http://jsfiddle.net/HTHnW/2/ -->
<script type="text/javascript">//<![CDATA[
$(window).load(function () {
$(".tabs_links a").on("click", function () {
$(this).addClass("current_tab");
$(this).parent().siblings().find("a").removeClass("current_tab");
});
});//]]> 

</script>
<!-- Flip JS -->
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/Flip_1.1.1/jquery.flip.js"
type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(function () {

$(".card-grid").flip({
trigger: "click",
autoSize: true,
});

});
</script>
<!-- IE 10 hack css | https://css-tricks.com/ie-10-specific-styles/ -->
<script>
var doc = document.documentElement;
doc.setAttribute("data-useragent", navigator.userAgent);
</script>
<script type="text/javascript">
jQuery(document).ready(function () {


var src = $("#goal_chr").attr("src");
$("#goal_chr").attr("src", src + "?" + Math.random());

});

</script>
<script
src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/script/nav.js"></script>
<!-- Full screen with animation problem solution  -->
<script>
$(document).on("webkitfullscreenchange", function () {
if (document.webkitFullscreenElement !== null) {
$("body").addClass("in-fullscreen");
} else {
$("body").removeClass("in-fullscreen");
}
});
</script>
</body>

</html>';






/////////////////////////////end of footer ////////////////////////////////////////
                                }   
                                if ($kid1=='N') {
                                  $count++;
                                  $text = $pageTop.$text.$tools.$footer;
                                  fwrite($myfile,$text);
                                          $color="";
                                          $size="";
                                          $Bold="";
                                          $Font="";
                                          $text="";
                                          $page++;

                                }    
                                if ($kid1=='EB')
                                {
                                 
                                $page++;
                                $text.="<br>";
                                } 

                                          
                                 $myfile = fopen("sectors/01-01-01-0".$count.".html", "w") or die("Unable to open file!");
                                 
                     }  
                    }
           
           }
           
          }
   //  echo $count."<br>";
   if($page<$count-1){
    $text = $pageTop.$text.$tools.$footer;
   }
else{
echo $count;
$next=$count;
////////////////////////

$tools='
      </div> 
      </div> 
      <div class="table-cell MainScr_med_left"></div> 
     </div> 
     <div class="table-row"> 
      <div class="table-cell MainScr_bot_right"></div> 
      <div class="table-cell MainScr_bot_med"> 

      <a href="01-01-01-0'.$num.'.html" class='.$bef.' title="السابق"></a>

       <a href="01-01-01-01.html" class="HomeArrow" title="المقدمة"></a> 

       <a href="01-01-01-0'.$next.'.html" class="RightArrow off" title="التالي"></a> 

       <a href="javascript:void()" class="centerArrow " title="جميع الحقوق محفوظة دار الإفتاء المصرية"></a> 
       <img id="increaseFont" src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/templates/Temp-General/FontPlus.png" class="FontPlus" title="تكبير حجم الخط"> 
       <img src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/templates/Temp-General/fontDefualt.png" id="bahij" class="fontDefualt" title="إستعاد حجم الخط"> 
       <img src="https://storage.googleapis.com/ifta-learning-dp/uploads/ifta_content/temps/assets/images/templates/Temp-General/fontMins.png" id="decreaseFont" class="fontMins " title="تصغير حجم الخط"> 
      </div>';
////////////////////////
$text = $pageTop.$text.$tools.$footer;
}
       //$nxt="LeftArrow  off tooltipstered";
   
       
      fwrite($myfile,$text);
      fclose($myfile); 
  
      }
   



    }

