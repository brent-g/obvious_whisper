<!-- <div class="fullscreen background" style="background-image:url('http://i.imgur.com/kMWKv24.jpg');" data-img-width="1345" data-img-height="896"> -->
	<div id="content">
		<h3>Welcome to <img src="<?php echo site_url('assets/images/logo_black_no_icon.png'); ?>" alt="Inline Logo"></h3>
			<?php echo form_open('welcome/create'); ?>
			<p>
				<input id="message" type="text" name="message" maxlength="40" placeholder="Type your message here" />
			</p>
			<p>
				<input id="whisper" type="button" name="whisper" value="Whisper!" onclick="validate_form(); return false;" />
				<input id="url" type="text" onclick="this.select();"/>
			</p>
			<input id="reset" name="reset" value="Reset!" onclick="reset_form();" type="button" />
		</form>
		<p id="char_count">Characters Remaining: 40</p>
	</div>
<!-- </div> -->