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
		  $(this).delay(i*250).fadeIn(500,'swing',function(){$('#reply').delay(300).fadeIn('slow')});
		});
		$el.find("span").promise().done(function(){
		    $el.text(function(i, text){
		       return $.trim(text, fi);
		    });            
		});
	});
</script>
<style>
.centered{
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
<div class="centered">

<div id="message"><?php echo(htmlspecialchars($message));?></div>
<input id="reply" type="button" name="reply" value="reply" onclick="self.location='<?php echo site_url(); ?>'" style="display:none;"/>
</div>