<style>
	

</style>
<script type="text/javascript">

//onload
$(function(){
	// the user can press enter to submit the form
	$(window).keydown(function(event)
	{
		// keycode 13 = ENTER 
		if (event.keyCode == 13) {
			// stop the form from submitting the usual way
			event.preventDefault();
			// validate our form
			validate_form();
		} 
		else 
		{
			$('#message').removeClass('error_shadow');
		}
	})

	var max_chars = 40;
	$('#message').keyup(function(){
		var char_count = $(this).val().length;
		if (char_count >= max_chars)
		{
			$('#char_count').text('Zero Characters Remaining!');
		} 
		else
		{
			var chars_remaining = max_chars - char_count;
			$('#char_count').text('Characters Remaining: ' + chars_remaining);
		}
	});
});

function validate_form()
{
	// make sure the user actually enters a message
	if (!$('#message').val() || $('#message').val() == undefined)
	{
		$('input#message').addClass('error_shadow'); // highlight the error'd field
	} 
	else 
	{
		$('[name=whisper]').hide(); // hide the whisper button... we don't wanna spam submit :) or do we...
		whisper(); // lets create the whisper!
	}
}

function reset_fields()
{

}

function whisper() 
{
	var message = $('#message').val();
	// how did you get here ?????!
	if (!$('#message').val() || $('#message').length == 0)
	{
		alert('You shouldn\'t be here!');
		return false;
	}
	// get the base path so we can call the create function 
	site_url = "<?php echo site_url('create_whisper/create'); ?>";
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
	<? echo form_open('welcome/create'); ?>
		<input id="message" type="text" name="message" placeholder="Type your message here" />
		<br />
		<br />
		<input id="whisper" type="button" name="whisper" value="Whisper!" onclick="validate_form(); return false;" />
	</form>
	<input id="url" type="text" class="dontshow" onclick="this.select();"/>
	<div id="char_count">Characters Remaining: 40</div>
</div>