<script type="text/javascript">
//onload
$(function(){
	// the user can press enter to submit the form
	$(window).keydown(function(event)
	{
		// keycode 13 = ENTER 
		if (event.keyCode == 13) 
		{
			event.preventDefault(); // stop the form from submitting the usual way
			validate_form(); // validate our form
		} 
		else 
		{
			$('#message').removeClass('error_shadow'); // remove the error highlighting on the message area
		}
	})
	
	$('#message').keyup(function(){
		var char_count = $(this).val().length; // get the total character amount in the message box
		if (char_count >= max_chars)
		{
			$('#char_count').text('Zero Characters Remaining!'); // notify the user that they have reached the char limit
		} 
		else
		{
			var chars_remaining = max_chars - char_count; // determine how many chars are available
			$('#char_count').text('Characters Remaining: ' + chars_remaining); // show the countdown of how many chars are available
		}
	});
});

var max_chars = 40; // maximum characters a user can enter into the message field

// form validation
function validate_form()
{
	// make sure the user actually enters a message
	if (!$('#message').val() || $('#message').val() == undefined || $('#message').length == 0)
	{
		$('input#message').addClass('error_shadow'); // highlight the error'd field
	} 
	else 
	{
		$('[name=whisper]').hide(); // hide the whisper button... we don't wanna spam submit :) or do we...
		whisper(); // lets create the whisper!
	}
}

function whisper() 
{
	var message = $('#message').val(); // get the message field text
	var site_url = "<?php echo site_url('create_whisper/create'); ?>"; // get the base path so we can call the create function 
	// ajax call that makes it happen!
	$.ajax({
		type : 'POST',
		dataType: 'json',
		data: {message : message},
		url: site_url,
		success: function(data)
		{
			// generate a link for the user
			$('#url').val("<?php echo site_url(); ?>o/" + data.url);
			$('#url').removeClass('dontshow');
			$('#url').focus();
			$('#message').val('');
		},
		error: function(data)
		{
			alert("An error has occured! " + data);
		}
	});
}
</script>
<div id="content">
	<h3>Welcome to Obvious Whisper</h3>
	<?php echo form_open('welcome/create'); ?>
		<input id="message" type="text" name="message" maxlength="40" placeholder="Type your message here" />
		<br />
		<br />
		<input id="whisper" type="button" name="whisper" value="Whisper!" onclick="validate_form(); return false;" />
	</form>
	<input id="url" type="text" class="dontshow" onclick="this.select();"/>
	<div id="char_count">Characters Remaining: 40</div>
</div>