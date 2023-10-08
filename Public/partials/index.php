<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/realsmartnose
 * @since      1.0.0
 *
 * @package    Gpsnose
 * @subpackage Gpsnose/Public/partials
 */
?>

<?php
if (isset($attributes) && isset($attributes['type'])) {
	switch ($attributes['type']) {
		case 'members':
			require 'Member/index.php';
			break;
	}
}
?>

<p><?= $partial ?></p>
<p><?= json_encode($attributes) ?></p>
