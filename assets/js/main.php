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