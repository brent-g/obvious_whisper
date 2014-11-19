<script type="text/javascript">
   	$(function(){
	   	var $el = $("#message:first");
	   	var text = $.trim($el.text());
	    // split the words by spaces
	    var words = text.split(" "), html = "";

	    // get the total word count
		for (var i = 0; i < words.length; i++) {
		    html += "<span>" + words[i] + ((i+1) === words.length ? "" : " ") + "</span>"; // wrap each word in span tags and stuff it into the html var
		};
		// hide all of the words
		$el.html(html).children().hide().each(function(i){
			// slowly start to fade them in individually
			$(this).delay(i*250).fadeIn(500,'swing',function(){
		  		$('#reply').delay(300).fadeIn('slow'); // fade in the reply button after all text has been displayed
		  	});
		});

		$el.find("span").promise().done(function(){
		    $el.text(function(i, text){
		       return $.trim(text, i);
		    });            
		});
		


	});

	// speak the words!
	if (window.SpeechSynthesisUtterance === undefined) {
    	// Browser Not supported
	} else {
		var msg = new SpeechSynthesisUtterance('<?php echo($message);?>'); // initialize the built in speech functionality in chrome and safari -- send it out message
		window.speechSynthesis.speak(msg); // speech the message!
	}
</script>
<div id="wrapper" style="display:block;">
	<div id="content">
		<div id="message"><?php echo(htmlspecialchars($message));?></div>
		<input id="reply" type="button" name="reply" value="reply" onclick="self.location='<?php echo site_url(); ?>'" style="display:none;"/>
	</div>
</div>