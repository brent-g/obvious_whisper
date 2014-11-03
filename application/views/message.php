<script>
	var msg = new SpeechSynthesisUtterance('<?php echo($message);?>');
	var voices = speechSynthesis.getVoices();
   	window.speechSynthesis.speak(msg);
   	console.log('voices', voices);
</script>
<style>
#message{
	width:300px;
    height:auto;
    position:absolute;
    left:50%;
    top:50%;
    margin:-100px 0 0 -150px;
    text-align: center;
}

</style>
    <div id="message"><?php echo($message);?></div>
