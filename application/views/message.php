<script>
	var msg = new SpeechSynthesisUtterance('<?php echo($message);?>');
   	window.speechSynthesis.speak(msg);
</script>
<?php echo($message);?>
