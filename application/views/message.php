<script>
	var msg = new SpeechSynthesisUtterance('<?php echo($message);?>');
	//var voices = speechSynthesis.getVoices();
   	window.speechSynthesis.speak(msg);

   	$(function(){
	   	var $el = $("#message:first");
	   	var text = $.trim($el.text());
	    // split the words by spaces
	    var words = text.split(" "), html = "";

		for (var i = 0; i < words.length; i++) {
		    html += "<span>" + words[i] + ((i+1) === words.length ? "" : " ") + "</span>";
		};
		$el.html(html).children().hide().each(function(i){
		  $(this).delay(i*200).fadeIn(900);
		});
		$el.find("span").promise().done(function(){
		    $el.text(function(i, text){
		       return $.trim(text);
		    });            
		});
	});
</script>
<style>
#message{
	width:400px;
    height:auto;
    position:absolute;
    left:50%;
    top:50%;
    margin:-100px 0 0 -150px;
    text-align: center;
    font-size: 28px;
}
</style>

<div id="message"><?php echo($message);?></div>
