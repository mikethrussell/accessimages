<?php

function focusjs($id,$class)         {

  $id = preg_replace("/[^A-Za-z0-9]/", "", $id);
  
  $js  = 		"<script>";
	$js .= 		"function changeClass$id(){";
	$js .= 		"document.getElementById(\"$id\").setAttribute(\"class\", \"".$class."focus\");}";
	$js .= 		"function changeClass1$id(){";
	$js .= 		"document.getElementById(\"$id\").setAttribute(\"class\", \"".$class."\");}";
	$js .= 		"</script>";
  
  echo $js;
	
}

function focus($id){
$id = preg_replace("/[^A-Za-z0-9]/", "", $id);
	echo "
	
	onFocus=\"changeClass$id()\" 
	onBlur=\"changeClass1$id()\"
	onMouseover=\"changeClass$id()\" 
	onMouseout=\"changeClass1$id()\" ";
}


function &getIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


//THE IMAGE SEARCH FUNCTION
function getyt($q, $v){


$ip =&getIP();
  
    // is cURL installed yet?
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
    
  $i=0;
  
  while ($i<12) {
    // OK cool - then let's create a new cURL resource handle
    $ch = curl_init();
 
    // Now set some options (most are optional)
 
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, "http://ajax.googleapis.com/ajax/services/search/images?v=1.0&userip=".$ip."&q=".$q."&start=".$i);
 
    // Set a referer
    curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
 
    // User agent
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
 
    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 
    // Download the given URL, and return output
    $output = curl_exec($ch);
 
    // Close the cURL resource, and free system resources
    curl_close($ch);
 
        $json_output = json_decode($output, true);  
        
        
        //print_r ($json_output);
foreach ($json_output['responseData']['results'] as $result)

{

    $vidid=rand(999, 9999);
    $url=$result['url'];
    $tbUrl=$result['tbUrl'];
    $title = $result['titleNoFormatting'];
     
     //ARGH _DAMN UNDERSCORE! Array index cannot start with a number... apparently.
    
    $index = '_'.$vidid;
        
    
    $array=array('url'=> $url, 'tbUrl' => $tbUrl, 'title' => $title, 'q' => $v , );
 
// put the array in a session variable
$_SESSION[$index]=$array;

        // print record

echo "<div class=\"shadow\"><li><div id=\"$vidid\" class=\"vidlink\">\n";
focusjs($vidid,'vidlink'); 
echo "<a ";
  focus($vidid)  ;
echo	"href=\"/images/play/?img=$vidid\">
        <img src=\"$tbUrl\" alt=\"$title\"/><br>$title</a>\n";
        echo "</div></li></div>\n"; 
 
        

}

$i=$i+4;



                

	
      }
      
      
 
  }


function relatedyt($v,$s)  {

 // generate feed URL
$feedURL = 
"http://gdata.youtube.com/feeds/api/videos/{$v}/related?v=2&max-results=1&format=5&restriction=GB&safesearch=strict&key=AI39si6eDBQPUdjOUTYpOaHUUSyBUCBK0zjHEtNFxtzvuhbQ0EfZfFjeP-U16vgDWMSGWrjLGjVNBxzfhqSnGL1D1onGmgOsJQ";

// read feed into SimpleXML object

$sxml = @simplexml_load_file($feedURL);

if( empty($sxml))
   {
			echo "Youtube is not returning results at the moment - please try again later";
     return false;
   }      
     
// iterate over entries in resultset
// print each entry's details
      foreach ($sxml->entry as $entry) {
        // get nodes in media: namespace for media information
        $media = $entry->children('http://search.yahoo.com/mrss/');
        
        // get video player URL
        $attrs = $media->group->player->attributes();
        $watch = $attrs['url']; 
        
				//sort url out
				
				$watch = str_replace("&feature=youtube_gdata_player", "", $watch);
				$watch = str_replace("http://", "../play?v=http://", $watch);
				$watch = str_replace("http://www.youtube.com/watch?v=", "", $watch);
	
			
        // get video thumbnail
        $attrs = $media->group->thumbnail[0]->attributes();
        $thumbnail = $attrs['url']; 
        
                // get video ID
        $arr = explode('/',$entry->id);
        $id = $arr[count($arr)-1];
             
        // print record
        
 echo "<div class=\"control-shadow\">
     <li>";
     focusjs('next','control-link');
      echo "<div id=\"next\" class=\"control-link\">
        <a";
        focus(next);
        echo "href=\"{$watch}&s={$s}\">
          <img src=\"../img/media_next.png\" alt=\"Next Video: {$media->group->title}\">
          <br>Next Video
        </a>
      </div>
    </li>
  </div>"; 
        

				 
      }
      
      }
      
      
      function getSingleImg($q){


$ip =&getIP();
  
    // is cURL installed yet?
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
    
 

    // OK cool - then let's create a new cURL resource handle
    $ch = curl_init();
 
    // Now set some options (most are optional)
 
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, "http://ajax.googleapis.com/ajax/services/search/images?v=1.0&userip=".$ip."&q=".$q);
 
    // Set a referer
    curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
 
    // User agent
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
 
    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 
    // Download the given URL, and return output
    $output = curl_exec($ch);
 
    // Close the cURL resource, and free system resources
    curl_close($ch);
 
        $json_output = json_decode($output, true);  
        
 $i=0;       
        //print_r ($json_output);
foreach ($json_output['responseData']['results'] as $result)

{

    $url=$result['tbUrl'];
    
 if ($i=='0'){echo '<img src="'.$url.'" alt="'.$q.'"/>';}

$i++;

}


  
      
 
  }




?>