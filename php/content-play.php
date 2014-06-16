<style>
html,body {
	margin:0;
	padding:0;
	height:100%; /* needed for page min-height */
}

#page{
  max-width: 1140px;
  position:relative; /* needed for footer positioning*/
	margin:0 auto; /* center, not in IE5 */ 
	height:auto !important; /* real browsers */
	height:100%; /* IE6: treated as min-height*/
	min-height:100%; /* real browsers */
}

#page-container {
position: absolute;
left: 0px;
right: 0px;
top: 0px;
bottom: 4px;  
background: #dde url(/img/center-highlight-opacity.png) no-repeat center -400px fixed;
border:1px #ccc solid; 
}

@media only screen and (min-width: 1200px) {
#page-container {
position: absolute;
left: 0px;
right: 0px;
top: 20px;
bottom: 20px;   }
}
</style>

<?php 

  
$img = $_GET["img"];
$img = '_'.$img;

$tbUrl = $_SESSION[$img]['tbUrl'];
$url = $_SESSION[$img]['url'];
$title = $_SESSION[$img]['title'];
$q = $_SESSION[$img]['q'];


?>

<div id="main-container">
	<div id="main" class="wrapper clearfix"> 
	
			
<div id="controlheader">		
    
  <fieldset class="search"> 
      <form method="post" name="search" action="../php/db.php">
      <?php focusjs('search','search')?>
        <input <?php focus(search)?>  autocomplete="off" type="text" title="type here" id="<?php echo $big;?>search" class="<?php echo $big;?>search" label="type here" name="v" placeholder="type here..." />
        <input type="hidden" name="db" value="submit">
        <?php focusjs('btn','btn')?>
        <input <?php focus(btn)?> type="submit" id="<?php echo $big;?>btn" class="<?php echo $big;?>btn" value="search" />  
      </form>
  </fieldset>

<ul class="controls">  
  <div class="control-shadow">
    <li>
    <?php focusjs('play','control-link')?>
      <div id="play" class="control-link">
        <a href="../php/dl.php?path=<?php echo $url;?>" <?php focus(play)?>> 
          <img src="../img/media_save.png" alt="Save image">
          </br>Save
        </a>
      </div>
    </li>
  </div>
  
  <div class="control-shadow">
    <li>
    <?php focusjs('repeat','control-link')?>
      <div id="repeat" class="control-link">
       <a href="#" id="print" <?php focus(repeat)?>>
        <img src="../img/media_print.png" alt="Print image">
        </br>Print
        </a>
      </div>
    </li>
  </div> 


  <div class="control-shadow">
    <li>
    <?php focusjs('back','control-link')?>
      <div id="back" class="control-link">
        <a <?php focus(back)?> href="../<?php echo"$q"; ?>">
          <img src="../img/media_previous.png" alt="Back to choices">
          </br>Back
        </a>
      </div>
    </li>
  </div> 
   
 
  
  
</ul>

 </div>


  <div id=vidwrap>      
 	
    <div id="videoDiv">
    <?php

echo '<h3>'.$q.' | '.$title.'</h3>';
     
     ?>
    
    
    <div id="printme"><img 
    src="<?php echo $url;?>"
    onError="this.onerror=null;this.src='<?php echo $tbUrl;?>';"
    />  </div>
    </div>

  </div>

			
		</div> <!--  #main -->
	</div><!--  #main-container -->  
  
