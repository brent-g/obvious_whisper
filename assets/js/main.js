var max_chars = 40; // maximum characters a user can enter into the message field

//onload
$(function(){

	reset_form(); // start off with a fresh form!

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

// form validation
function validate_form()
{
	// make sure the user actually enters a message
	if (!$('#message').val() || $('#message').val() == undefined || $('#message').length == 0)
	{
		$('input#message').addClass('error_shadow').fadeIn('fast'); // highlight the error'd field
	} 
	else 
	{
		$('#whisper').hide(); // hide the whisper button... we don't wanna spam submit :) or do we...
		$('#char_count').hide(); // hide the character counter
		$('#reset').show(); // show the reset button
		whisper(); // lets create the whisper!
	}
}

function reset_form()
{
	$('#url').val(''); // Clear the url input field
	$('#url').hide(); // hide the url display
	$('#reset').hide(); // hide the reset button
	
	$('#whisper').show(); // show the message field
	$('#char_count').show(); // show the character counter
	$('#message').show(); // show the message field
	$('#message').keyup(); // reset the counter field
}

function whisper() 
{
	var message = $('#message').val(); // get the message field text
	var site_url = "create_whisper/create"; // get the base path so we can call the create function 
	// ajax call that makes it happen!
	$.ajax({
		type : 'POST',
		dataType: 'json',
		data: {message : message},
		url: site_url,
		success: function(data)
		{
			// generate a link for the user
			$('#url').val(data.url); // put the generated url into the url text field
			$('#url').show(); // show the url field
			$('#url').select(); // select the newly generated link
			$('#message').val(''); // reset the message field
			$('#message').hide(); // hide the message field
		},
		error: function(data)
		{
			alert("An error has occured! " + data); // let the user know something went wrong
		}
	});
}