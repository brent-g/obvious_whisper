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
			 border: inset solid 1px red;
  box-shadow: inset 0 0 5px 1px red;
	}
	body {
		font-family: 'Titillium Web', sans-serif;
		background-color:#2B2B2B;
		color:#F6F6F6;
	}
	input[type="text"] {
		padding: 10px;
	    border: solid 1px #dcdcdc;
	    transition: box-shadow 0.3s, border 0.3s;
	    text-align:center;
	}
	input[type="button"] {
		-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
		-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
		box-shadow:inset 0px 1px 0px 0px #ffffff;
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9));
		background:-moz-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
		background:-webkit-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
		background:-o-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
		background:-ms-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
		background:linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9',GradientType=0);
		background-color:#f9f9f9;
		-moz-border-radius:3px;
		-webkit-border-radius:3px;
		border-radius:3px;
		border:1px solid #dcdcdc;
		display:inline-block;
		cursor:pointer;
		color:#666666;
		font-family:arial;
		font-size:15px;
		font-weight:bold;
		padding:6px 24px;
		text-decoration:none;
		text-shadow:0px 1px 0px #ffffff;
	}
	input[type="button"]:hover {
		background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9));
		background:-moz-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
		background:-webkit-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
		background:-o-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
		background:-ms-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
		background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9',GradientType=0);
		background-color:#e9e9e9;
	}
	input[type="button"]:active {
		position:relative;
		top:1px;
	}

/*.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f6f6f6), color-stop(1, #ffffff));
	background:-moz-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-webkit-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-o-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-ms-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:linear-gradient(to bottom, #f6f6f6 5%, #ffffff 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6f6f6', endColorstr='#ffffff',GradientType=0);
	background-color:#f6f6f6;
}
.myButton:active {
	position:relative;
	top:1px;
}*/

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
	<h3>Welcome to Obvious Whisper</h3>
	<? echo form_open('welcome/create'); ?>
		<input id="message" type="text" name="message" placeholder="Type your message here" />
		<br />
		<br />
		<input id="whisper" type="button" name="whisper" value="Whisper!" onclick="validate_form(); return false;" />
	</form>
	<input id="url" type="text" class="dontshow" onclick="this.select();"/>
</div>