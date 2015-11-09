<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' lang='en' xml:lang='en'>
<head>
<title><?php echo $_GET['title']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="jplayer.blue.monday.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>

<script type="text/javascript" src="jquery.jplayer.min.js"></script>
<script type="text/javascript" src="jquery.jplayer.inspector.js"></script>

<script type="text/javascript">AudioPlayer.setup("Jplayer.swf?ver=2.0.4.1", {width:"290",animation:"yes",encode:"yes",initialvolume:"60",remaining:"no",noinfo:"no",buffer:"5",checkpolicy:"no",rtl:"no",bg:"E5E5E5",text:"333333",leftbg:"CCCCCC",lefticon:"333333",volslider:"666666",voltrack:"FFFFFF",rightbg:"B4B4B4",rightbghover:"999999",righticon:"333333",righticonhover:"FFFFFF",track:"FFFFFF",loader:"009900",border:"CCCCCC",tracker:"DDDDDD",skip:"666666",pagebg:"FFFFFF",transparentpagebg:"yes"});</script>

<script type="text/javascript">

//<![CDATA[

$(document).ready(function(){



	$("#jquery_jplayer_1").jPlayer({

		ready: function (event) {

			$(this).jPlayer("setMedia", {

				mp3:"<?php echo $_GET['mp3']; ?>"

			});

		},

		swfPath: "",

		supplied: "mp3",

		wmode: "window"

	});



	$("#jplayer_inspector").jPlayerInspector({jPlayer:$("#jquery_jplayer_1")});

});

//]]>

</script>

<body style="margin:0px;">
<div id="jquery_jplayer_1" class="jp-jplayer"></div>



		<div id="jp_container_1" class="jp-audio">

			<div class="jp-type-single">

				<div class="jp-gui jp-interface">

					<ul class="jp-controls">

						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>

						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>

						<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>

						<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>

						<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>

						<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>

					</ul>

					<div class="jp-progress">

						<div class="jp-seek-bar">

							<div class="jp-play-bar"></div>

						</div>

					</div>

					<div class="jp-volume-bar">

						<div class="jp-volume-bar-value"></div>

					</div>

					<div class="jp-time-holder">

						<div class="jp-current-time"></div>

						<div class="jp-duration"></div>



						<ul class="jp-toggles">

							<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>

							<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>

						</ul>

					</div>

				</div>

				<div class="jp-title">

					<ul>

						<li><?php echo $_GET['title']; ?></li>

					</ul>

				</div>

				<div class="jp-no-solution">

					<span>Update Required</span>

					To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.

				</div>

			</div>

		</div>



		
			


</body>