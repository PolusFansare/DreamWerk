<?php
$video=$this->mysql->get_row('dw_videos',array('video_id'=>$video_id));

?>
<article>
	<canvas id="canvas"></canvas>
	<video id="video" controls autoplay="true" muted="muted" onclick="this.paused ? this.play() : this.pause();">
		<source src="<?= base_url($video['video_url']); ?>" type="video/mp4">
		<source src="movie.ogg" type="video/ogg">
		Your browser does not support the video tag.
	</video>
</article>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var vidDOM = $('article').children('video');
    var vid2 = document.getElementById('video');
	vid2.currentTime=vid2.currentTime + 1;
    var vid = vidDOM.get(2);
    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');	
	// vid2.pause();

	/*$("#video").on("loadstart", function(){
		$('#video').get(0).pause();
	});*/
    vid2.onpause =function() {
        vid2.width = canvas.width = vid2.offsetWidth;
        vid2.height = canvas.height = vid2.offsetHeight;
        var $this = this; 
        ctx.drawImage($this, 0, 0, vid2.width, vid2.height);
        uploadbase64();
    }
    vidDOM.bind({
        'paused':function () {
            alert('started');
            vid.width = canvas.width = vid.offsetWidth;
            vid.height = canvas.height = vid.offsetHeight;
            var $this = this; 
            ctx.drawImage($this, 0, 0, vid2.width, vid2.height);
            uploadbase64();
        }
    })

    function uploadbase64(){
        canvasData = canvas.toDataURL("image/jpeg"); 
        var ajax = new XMLHttpRequest();
        ajax.open("POST", '<?= base_url('welcome/saveVideoThumbanail/'.$video_id);?>',false);
        ajax.setRequestHeader('Content-Type', 'application/upload');
        ajax.send(canvasData);
    }
    setTimeout(function(){
    	$("#video").click();
    },1000);
</script>