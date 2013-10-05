<?php
/*
Plugin Name: No Posts User Delete
Plugin URI: http://mcwebdesign.ro/2013/10/wordpress-delete-users-with-no-posts-plugin/
Description: Removes all users (subscribers, administrators, editors, authors, contributors, link authors and no role users) that have no posts. After activating, you can find the plugin under "Users" menu.
Author: MC Web Design
Version: 1.0
Author URI: http://www.mcwebdesign.ro/
*/


$npud_version = '1.0';

function npud_add_options_pages() {
	if (function_exists('add_users_page')) {
		add_users_page("No Posts User Delete", 'No Posts User Delete ', 'remove_users', __FILE__, 'npud_options_page');
	}		
}

function npud_options_page() {

	global $wpdb, $npud_version;
	$tp = $wpdb->prefix;


	$result = "";

	if (isset($_POST['info_update'])) {

		?><div id="message" class="updated fade"><p><strong><?php 

		echo "Operation Executed - View Results Below";

	    ?></strong></p></div><?php


		$result = '';

		$npud1_confirm = (bool)$_POST['npud1_confirm'];



		if ($npud1_confirm) {
			
			
			// list of users with no posts
			$userlist = (array)$wpdb->get_results("
				SELECT u.ID FROM {$tp}users u
				LEFT JOIN {$tp}posts p ON u.ID = p.post_author
				WHERE p.ID IS NULL;	
			");

			$result = 'Users deleted: ' . count($userlist);
			
			// delete users (and their meta info) with no posts
			//$wpdb->show_errors();
			$sql = $wpdb->prepare("DELETE FROM {$tp}usermeta WHERE user_id NOT IN (SELECT DISTINCT post_author FROM {$tp}posts);");
			$wpdb->query($sql);
			//$wpdb->show_errors();
			$sql = $wpdb->prepare("DELETE FROM {$tp}users WHERE ID NOT IN (SELECT DISTINCT post_author FROM {$tp}posts);");
			$wpdb->query($sql);  	

		} else {

			$result = 'No option selected';
			
		}

	} ?>

	<div class=wrap>

	<h2>No Posts User Delete Plugin  v<?php echo $npud_version; ?></h2>
	
	<div style="float:right;margin:20px;">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
			">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	</div>

	<p>Visit the <a href="http://mcwebdesign.ro/2013/10/wordpress-delete-users-with-no-posts-plugin/">plugin's homepage</a> for further details. If you find a bug or have a fantastic idea for this plugin, <a href="http://mcwebdesign.ro/contact/">ask me</a>!</p>

	<?php 

	if ($result != "") { 
		echo '<div style="color:#fff; background: #6F9348; border:0px; padding:8px 20px; font-size:10pt; width:650px;">';
		echo '<strong>Results</strong>:<br /> ' . trim($result) . '</div>';
	} 

	?>


	<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>"  >
	<input type="hidden" name="info_update" id="info_update" value="true" />


	<div style="padding: 0 0 15px 12px;">

		<?php print $formatinfo; ?>
		<h3>Options</h3>
		<input type="checkbox" name="npud1_confirm" id="npud1_confirm" /> 
		Delete all users (subscribers, administrators, editors, authors, contributors, link authors and no role users) with no posts
        <br/><br/>
      <b>Note: <span style="color:red;">Caution!<span></b> This plugin removes all the users who have no posts and their meta info from your database.<br/>
	  <b>Info:</b> If a user has posts in the Trash, then that user will not be deleted.
	</div>


	<div class="submit">
		<input type="submit" name="info_update" value="Submit" />
	</div>
	</form>
	</div><?php
}


add_action('admin_menu', 'npud_add_options_pages');

?>