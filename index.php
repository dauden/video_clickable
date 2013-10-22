<!doctype html>
<html>
  <head>
  <meta charset="UTF-8">
  <title>Untitled Document</title>
  <script src="jquery.min.js"></script>
  <script src="popcorn.js"></script>
  <script src="popcorn.pause.js"></script>
  <script> 
   var output;
   document.addEventListener('DOMContentLoaded', function () {
     var p = Popcorn( '#video' , { pauseOnLinkClicked : true } )
         .play();
    }, false);
  </script>
  <script src="popcorn.show.js"></script>
  <?php
	$string = file_get_contents("script.json");
	$json = json_decode($string,true);
	$objects = $json['nodes'];
	$print_text = array();
	$print_object = array();
	foreach($objects as $object){
		$id = $object['id'];
		$data = $object['data'];
		foreach($data as $item){
			$iid = $id . "_" . $item['id'];
			$ilayout = $item['layout'];
			$itime = $item['time'];
			$itext = $item['text'];
			$istyle = $item['style'];
			$ioption = $item['options'];
			$itime['id'] = $iid ;
			$ilayout['text'] = $itext;
			$ilayout['option'] = $ioption;
			$ilayout['style'] = $istyle;
			$ilayout['id'] = $iid;
			
			array_push($print_object,$itime);
			array_push($print_text,$ilayout);
		}
	}
?>
  <script> 
  	document.addEventListener('DOMContentLoaded', function () {
      var p = Popcorn('#video')
     .play() 
	 <?php 
	 foreach($print_object as $obj){
	 	echo "
      		.show({
        		start: {$obj['start']}, // seconds
        		end: {$obj['end']}, // seconds
        		target: 'show_{$obj['id']}'
      		})
	  "; 
	 }
	  ?>

    }, false);
 	
	function play(src){
		$($('video').children()[0]).attr('src',src);
		var p = Popcorn('#video')
		.load()
    	.play();
	}
	function showme(){
		alert("Yeah! it's my");
	}
  </script>
  <link rel="stylesheet" href="style.css" id="main-style">
  </head>

  <body>
<div id="player">
    <video id="video" controls preload autoplay>
    <source src="z-pilar.mp4"  type='video/mp4'>
  </video>
    <div id="resources">
     <?php 
	 foreach($print_text as $obj){
	  ?>
      <div class="show" id="show_<?php echo $obj['id']; ?>" style="display: none; position: absolute; <?php 
	  	echo "top:". $obj['top'] . ";" . "left:". $obj['left'] . ";". "width:". $obj['width'] . ";". "height:". $obj['height'] . ";" ; 
	  ?>">
        <div style="position: relative; <?php echo $obj['style'] ?>">
        <?php 
			$options = $obj['option'];
			if($options){
				foreach($options as $option){
					$action = $option['action'];
					if('play' == $action)
						echo '<a href="javascript:play(\''.$option['src'].'\')">'.$option['text'].'</a>';
					else if ('stop' == $action)
						echo '<a href="javascript:stop()">'.$option['text'].'</a>';
					else if('url' == $action)
						echo '<a href="'.$option['src'].'">'.$option['text'].'</a>';
					else
						echo '';
					echo "<br/>";
				}
			}
			else
				echo $obj['text'] ; ?>
        </div>
      </div>
	 	<?php 
	 }
	  ?>
  </div>
  </div>
<br clear="all">
</body>
</html>
