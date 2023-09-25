<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/realsmartnose
 * @since      1.0.0
 *
 * @package    Gpsnose
 * @subpackage Gpsnose/admin/partials
 */
?>

<div class="wrap">

	<h2><?php echo esc_html(get_admin_page_title()); ?></h2>

	<p>Go to <a href="http://www.gpsnose.com/Developer/MashupAdmin" target="_new">GpsNose mashup-admin</a>, create your mashup and make sure to copy the needed informations to the related fields.</p>

	<form method="post" name="gpsnose_options" action="options.php">

		<?php
		$options = get_option($this->plugin_name);
		$appKey = (isset($options['app-key']) ? $options['app-key'] : '');
		$mashup = (isset($options['mashup']) ? $options['mashup'] : '');

		$checkBoxes = array();
		$checkBoxes['load-css-bootstrap'] = (isset($options['load-css-bootstrap']) ? $options['load-css-bootstrap'] : '1');
		$checkBoxes['load-css-gpsnose'] = (isset($options['load-css-gpsnose']) ? $options['load-css-gpsnose'] : '1');

		$checkBoxes['load-js-jquery'] = (isset($options['load-js-jquery']) ? $options['load-js-jquery'] : '0');
		$checkBoxes['load-js-bootstrap'] = (isset($options['load-js-bootstrap']) ? $options['load-js-bootstrap'] : '1');
		$checkBoxes['load-js-language'] = (isset($options['load-js-language']) ? $options['load-js-language'] : '1');
		$checkBoxes['load-js-bignumber'] = (isset($options['load-js-bignumber']) ? $options['load-js-bignumber'] : '1');
		$checkBoxes['load-js-moment'] = (isset($options['load-js-moment']) ? $options['load-js-moment'] : '1');
		$checkBoxes['load-js-numeral'] = (isset($options['load-js-numeral']) ? $options['load-js-numeral'] : '1');
		$checkBoxes['load-js-imagesloaded'] = (isset($options['load-js-imagesloaded']) ? $options['load-js-imagesloaded'] : '1');
		$checkBoxes['load-js-masonry'] = (isset($options['load-js-masonry']) ? $options['load-js-masonry'] : '1');
		$checkBoxes['load-js-knockout'] = (isset($options['load-js-knockout']) ? $options['load-js-knockout'] : '1');
		$checkBoxes['load-js-maframework'] = (isset($options['load-js-maframework']) ? $options['load-js-maframework'] : '1');
		$checkBoxes['load-js-gpsnose-ko'] = (isset($options['load-js-gpsnose-ko']) ? $options['load-js-gpsnose-ko'] : '1');

		list($protocol, $mashupExample) = explode('://', home_url());

		settings_fields($this->plugin_name);
		do_settings_sections($this->plugin_name);
		?>

		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('Validation-Key (optional)', $this->plugin_name); ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-validation-key"><?php _e('Validation-Key (optional)', $this->plugin_name); ?></label><br>
			<input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-validation-key" name="<?php echo $this->plugin_name; ?>[validation-key]" value="<?php echo $appKey ?>" />
		</fieldset>

		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('App-Key', $this->plugin_name); ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-app-key"><?php _e('App-Key', $this->plugin_name); ?></label><br>
			<input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-app-key" name="<?php echo $this->plugin_name; ?>[app-key]" value="<?php echo $appKey ?>" />
		</fieldset>

		<fieldset>
			<legend class="screen-reader-text"><span><?php echo str_replace("%mashup%", $mashupExample, __('Mashup-Name (e.g. %%mashup%)', $this->plugin_name)) ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-mashup"><?php echo str_replace("%mashup%", $mashupExample, __('Mashup-Name (e.g. %%mashup%)', $this->plugin_name)) ?></label><br>
			<input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-mashup" name="<?php echo $this->plugin_name; ?>[mashup]" value="<?php echo $mashup ?>" />
		</fieldset>

		<h3><?php _e("CSS", $this->plugin_name) ?></h3>
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e("CSS", $this->plugin_name) ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-load-css-bootstrap">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-css-bootstrap" name="<?php echo $this->plugin_name; ?>[load-css-bootstrap]" value="1" <?php checked($checkBoxes['load-css-bootstrap']) ?> />
				<span><?php esc_attr_e('Load Bootstrap CSS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-css-gpsnose">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-css-gpsnose" name="<?php echo $this->plugin_name; ?>[load-css-gpsnose]" value="1" <?php checked($checkBoxes['load-css-gpsnose']) ?> />
				<span><?php esc_attr_e('Load GpsNose CSS', $this->plugin_name); ?></span>
			</label>
		</fieldset>

		<h3><?php _e("JavaScript", $this->plugin_name) ?></h3>
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e("jQuery", $this->plugin_name) ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-load-js-jquery">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-jquery" name="<?php echo $this->plugin_name; ?>[load-js-jquery]" value="1" <?php checked($checkBoxes['load-js-jquery']) ?> />
				<span><?php esc_attr_e('Load jQuery', $this->plugin_name); ?></span>
			</label>
			<br>
			<legend class="screen-reader-text"><span><?php _e("GpsNose JS", $this->plugin_name) ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-load-js-bootstrap">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-bootstrap" name="<?php echo $this->plugin_name; ?>[load-js-bootstrap]" value="1" <?php checked($checkBoxes['load-js-bootstrap']) ?> />
				<span><?php esc_attr_e('Load Bootstrap JS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-language">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-language" name="<?php echo $this->plugin_name; ?>[load-js-language]" value="1" <?php checked($checkBoxes['load-js-language']) ?> />
				<span><?php esc_attr_e('Load GpsNose Language', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-bignumber">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-bignumber" name="<?php echo $this->plugin_name; ?>[load-js-bignumber]" value="1" <?php checked($checkBoxes['load-js-bignumber']) ?> />
				<span><?php esc_attr_e('Load bignumber JS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-moment">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-moment" name="<?php echo $this->plugin_name; ?>[load-js-moment]" value="1" <?php checked($checkBoxes['load-js-moment']) ?> />
				<span><?php esc_attr_e('Load moment JS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-numeral">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-numeral" name="<?php echo $this->plugin_name; ?>[load-js-numeral]" value="1" <?php checked($checkBoxes['load-js-numeral']) ?> />
				<span><?php esc_attr_e('Load numeral JS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-imagesloaded">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-imagesloaded" name="<?php echo $this->plugin_name; ?>[load-js-imagesloaded]" value="1" <?php checked($checkBoxes['load-js-imagesloaded']) ?> />
				<span><?php esc_attr_e('Load imagesloaded JS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-masonry">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-masonry" name="<?php echo $this->plugin_name; ?>[load-js-masonry]" value="1" <?php checked($checkBoxes['load-js-masonry']) ?> />
				<span><?php esc_attr_e('Load masonry JS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-knockout">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-knockout" name="<?php echo $this->plugin_name; ?>[load-js-knockout]" value="1" <?php checked($checkBoxes['load-js-knockout']) ?> />
				<span><?php esc_attr_e('Load knockout JS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-maframework">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-maframework" name="<?php echo $this->plugin_name; ?>[load-js-maframework]" value="1" <?php checked($checkBoxes['load-js-maframework']) ?> />
				<span><?php esc_attr_e('Load maframework JS', $this->plugin_name); ?></span>
			</label>
			<br>
			<label for="<?php echo $this->plugin_name; ?>-load-js-gpsnose-ko">
				<input type="checkbox" id="<?php echo $this->plugin_name; ?>-load-js-gpsnose-ko" name="<?php echo $this->plugin_name; ?>[load-js-gpsnose-ko]" value="1" <?php checked($checkBoxes['load-js-gpsnose-ko']) ?> />
				<span><?php esc_attr_e('Load gpsnose-knockout JS', $this->plugin_name); ?></span>
			</label>
			<br>
		</fieldset>

		<h3><?php _e("Development", $this->plugin_name) ?></h3>
		<p><?php _e("Override the GpsNose URL (Only change this, if you know what you are doing!)", $this->plugin_name) ?></p>
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('API-URL', $this->plugin_name); ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-api-url"><?php _e('API-URL', $this->plugin_name); ?></label><br>
			<input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-api-url" name="<?php echo $this->plugin_name; ?>[api-url]" value="<?php echo $appKey ?>" />
		</fieldset>
		<fieldset>
			<legend class="screen-reader-text"><span><?php _e('DATA-URL', $this->plugin_name); ?></span></legend>
			<label for="<?php echo $this->plugin_name; ?>-data-url"><?php _e('DATA-URL', $this->plugin_name); ?></label><br>
			<input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-data-url" name="<?php echo $this->plugin_name; ?>[data-url]" value="<?php echo $appKey ?>" />
		</fieldset>

		<?php submit_button('Save all changes', 'primary', 'submit', TRUE); ?>

	</form>

</div>
