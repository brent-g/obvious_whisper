<style>
	#content {
		margin: 0 auto;
		padding-top: 100px;
		width:100%;
		text-align:center;
	}
	input#message, input#url {
		width:300px;
	}
	.dontshow {
		display:none;
	}
	.error_shadow {
		box-shadow:inset 0 0 4px red;
	}
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
			console.log('key down');
		} 
		else 
		{
			console.log('we are typing letters');
			$('#message').removeClass('error_shadow');
		}
	})
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
	<h3>Welcome to obvious whisper</h3>
	<label for="message">Type your message here:</label>
	<? echo form_open('welcome/create'); ?>
		<input id="message" type="text" name="message" />
		<br />
		<br />
		<input type="button" name="whisper" value="Whisper!" onclick="validate_form(); return false;" />
	</form>
	<input id="url" class="dontshow" onclick="this.select();"/>
</div>