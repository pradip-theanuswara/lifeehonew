<?php
/*
* Template file for youtube record functionality.
*/
?>
<style>
#MPOuter {
margin: auto;
width: 400px;
text-align: center;
}

#MPOuterMost {
    margin: 0px;
    width: 0%;
}

.header {
    background-color: #FFFFFF;
    height: 50px;
    margin-left: 5px;
    text-align: center;
    width: 400px;
}

#menu {
  
    background-repeat: no-repeat;
    float: left;
    height: 59px;
    width: 408px;
}


.bottomcontentdiv {
    background-color: #FFFFFF;
    clear: both;
    height: 200px;
    margin-bottom: 10px;
    margin-left: 5px;
    text-align: center;
    width: 400px;
}


</style>

<div id="MPOuterMost">
<div id="MPOuter">
<div class="header"></div>
<div id="menu">

<?php global $base_url;
$beta =  "/sites/all/themes/lifeecho/beta.png";
?>
 <?php if ($logo): ?>

      <a href="#" title="beta" rel="home" id="logo">
        <img src="<?php echo $beta; ?>" width="50px" height="60px" alt="beta version"/>
      </a>
    <?php endif; ?>

<div class="logo"> <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    <?php endif; ?></div>  
</ul>
</div>
<div class="bottomcontentdiv">
        <div id="widget"></div>
    <div style="text-align:center;" id="player"></div>
    <input title=close this page type=button onclick=winclose(); value=Close />     
</div>
</div>
</div>
</body>
 <script>
      // 2. Asynchronously load the Upload Widget and Player API code.
      var tag = document.createElement('script');
      tag.src = "//www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. Define global variables for the widget and the player.
      //    The function loads the widget after the JavaScript code
      //    has downloaded and defines event handlers for callback
      //    notifications related to the widget.
      var widget;
      var player;
      function onYouTubeIframeAPIReady() {
        widget = new YT.UploadWidget('widget', {
          width: 400,
          events: {
            'onUploadSuccess': onUploadSuccess,
            'onProcessingComplete': onProcessingComplete
          }
        });
      }

      // 4. This function is called when a video has been successfully uploaded.
      function onUploadSuccess(event) {
        alert('Video ID ' + event.data.videoId + ' was uploaded to youtube sucessfully.');
		document.getElementById('youtubercvd').value=event.data.videoId;
		
      }

      // 5. This function is called when a video has been successfully
      //    processed.
      function onProcessingComplete(event) {
document.getElementById('sucess').value = event.data.videoId;

     //   player = new YT.Player('player', {
     //    height: 390,
      //   width: 640,
      //  videoId: event.data.videoId,
      //   events: {}
     //  });
      }

    </script>

 <input type="hidden" id='youtubercvd' value='0' /> <!-- store hidden value from youtube recorded  -first step -->
<script>
window.onbeforeunload = function() { 
window.opener.document.getElementById('edit-field-youtube-record-response-und-0-value').value = document.getElementById('youtubercvd').value;
return ; 
}

function winclose() {
window.opener.document.getElementById('edit-field-youtube-record-response-und-0-value').value = document.getElementById('youtubercvd').value;
window.close();	
}
</script>
