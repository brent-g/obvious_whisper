<script>
	var msg = new SpeechSynthesisUtterance('<?php echo($message);?>');
   	window.speechSynthesis.speak(msg);
</script>
<center><?php echo($message);?></center>
