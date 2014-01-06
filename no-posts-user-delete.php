<?php
/*
Plugin Name: No Posts User Delete
Plugin URI: http://mcwebdesign.ro/2013/10/wordpress-delete-users-with-no-posts-plugin/
Description: Removes users that have no posts, based on their role. After activating, you can find the plugin under "Users" menu.
Author: MC Web Design
Version: 2.0
Author URI: http://www.mcwebdesign.ro/
*/


$npud_version = '2.0';

function npud_add_options_pages() {
	if (function_exists('add_users_page')) {
		add_users_page("No Posts User Delete", 'No Posts User Delete ', 'remove_users', __FILE__, 'npud_options_page');
	}		
}

function npud_options_page() {
	global $wpdb, $npud_version, $user_ID;
	$tp = $wpdb->prefix;
	
?>
	
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
	<p>Check the option <em>User has no posts</em>, choose the user's role you want to find and press the <em>Search</em> button.</p>

	<form enctype="multipart/form-data" method="POST" action="" id="no-posts-user-delete-form">
	<input type="hidden" name="op" value="search_users" />
		<table>
			<tr><td align="center"><input id="flag_no_recs" type="checkbox" name="no_recs" value="yes" <?php echo empty($_POST['no_recs']) ? '' : 'checked' ?> /></td><td><label for="flag_no_recs"><?php echo __('User has no posts')?></label></td></tr>
			<tr><td colspan="2">
			<label for="user_role"><?php echo __('User role: &nbsp;')?></label>
			<select name="user_role_eq">
			<?php
			$columns = array('subscriber', 'administrator', 'contributor', 'author', 'editor');
			foreach($columns as $r) {
			print '<option value="' . $r . '" ' . ($_POST['user_role_eq'] == $r ? 'selected' : '') . '>' . $r . '</option>';
			}
			?>
			</select></td></tr>
			<tr><td colspan="2"><input type="submit" size="4" value="<?php echo __('Search')?>" /></td></tr>
		</table>

<?php 

    if (!isset($_POST['op'])) $_POST['op'] = 'stand_by';

    switch ($_POST['op']) {
    case 'stand_by':
        break;
    case 'finally_delete':
    case 'delete':
        //delete all selected users
        echo '<hr />';
        if (empty($_POST['f_users'])) {
			echo '<div style="color:#fff; background: #0074A2; border:0px; padding:8px 20px; font-size:10pt; width:650px;">';
			echo '<strong>You didn\'t select any user</strong></div>';
        } else {
            if ( !current_user_can('delete_users') ) __('You don&#8217;t have rights to delete users.');
            else 
            if ($_POST['op'] == 'finally_delete') {
            
                echo "Deleting...<br />";
                $cnt_deleted = 0;
                foreach($_POST['f_users'] as $user_id_to_delete) {
    
                    if ($user_id_to_delete == $user_ID) {
                        echo 'You can\'t delete your profile ! <br />';
                        continue; //don't delete current-user
                    }
					
                    wp_delete_user($user_id_to_delete);
                    $cnt_deleted ++;
                }
                if ($cnt_deleted == 1) echo '<div style="color:#fff; background: #0074A2; border:0px; padding:8px 20px; font-size:10pt; width:650px; font-weight:bold;">'.$cnt_deleted . ' ' . __('user was deleted').'</div>';
                else echo '<div style="color:#fff; background: #0074A2; border:0px; padding:8px 20px; font-size:10pt; width:650px; font-weight:bold;">'.$cnt_deleted . ' ' . __('users were deleted').'</div>';
                
            } else {
                if (!is_array($_POST['f_users'])) $_POST['f_users'] = array($_POST['f_users']);
                echo '<span style="background-color: red; padding: 5px; color: white; font-weight:bold;">Caution !</span><br /><br />
                    <strong>Please be careful, you will delete: <span style="color: red;"> ' . count($_POST['f_users']) . ' user(s) </span>. Data will be erased permanently.<br />Proceed?</strong> 
                    <input type="button" value="Yes" onclick="this.form.op.value=\'finally_delete\'; this.form.submit();"/>&nbsp;
                    <input type="button" value="No, don\'t do it" onclick="this.form.submit();"/><br /><br />';
            }
        }
    case 'search_users':
	
		$condition = array();
		
		switch ($_POST['user_role_eq']) {
		case 'administrator':
			$condition[] = "(WUM.meta_value >= 8) AND (WUM.meta_value <= 10)";
			break;
		case 'subscriber':
			$condition[] = "(WUM.meta_value <= 0) OR (WUM.meta_value > 10)";		
			break;
		case 'contributor':
			$condition[] = "(WUM.meta_value = 1)";			
			break;
		case 'author':
			$condition[] = "(WUM.meta_value = 2)";
			break;
		case 'editor':
			$condition[] = "(WUM.meta_value >= 3) AND (WUM.meta_value <= 7)";
			break;
		default:
			$condition[] = "(WUM.meta_value <= 0) OR (WUM.meta_value > 10)";
		}
		
		$query = "SELECT 
					WU.ID, WU.user_login as login, WU.user_url as url, 
					WU.display_name as name
				FROM {$tp}users WU 
				LEFT JOIN {$tp}usermeta WUM ON WUM.user_id = WU.ID AND WUM.meta_key = '{$tp}user_level'
				WHERE " . implode(' AND ' , $condition) . "
				GROUP BY WU.ID, WU.user_login, WU.user_url, WU.display_name ";

        $rows = $wpdb->get_results($query, ARRAY_A);

        $user_list = array();
		
		if (!empty($rows)) 
            foreach($rows as $k => $UR) {
                $UR['recs'] = 0;
                $user_list[$UR['ID']] = $UR; 
            }
        
		//find users with no posts & count published posts
        $query = "SELECT 
					COUNT(WP.ID) as recs, WU.ID
				FROM {$tp}users WU 
				LEFT JOIN {$tp}posts WP ON WP.post_author = WU.ID AND NOT WP.post_type in ('attachment', 'revision') AND post_status = 'publish' GROUP BY WU.ID";			

        $rows = $wpdb->get_results($query, ARRAY_A);
        
        if (!empty($rows)) 
            foreach($rows as $k => $UR) {
                $id = $UR['ID'];
                if (isset($user_list[$id])) $user_list[$id]['recs'] = $UR['recs'];
                if (!empty($_POST['no_recs']) && $UR['recs']) unset($user_list[$id]);
            }

		//generate users list
        if (empty($user_list)) {
            echo __('<div style="color:#fff; background: #A3B745; border:0px; padding:8px 20px; font-size:10pt; width:650px; font-weight:bold;">No users were found.</div>');
        } else {
		
			if (count($user_list) == 1) echo '<div style="color:#fff; background: #A3B745; border:0px; padding:8px 20px; font-size:10pt; width:650px; font-weight:bold;">' . count($user_list) . ' ' . __('user was found') . '</div>';
            else echo '<div style="color:#fff; background: #A3B745; border:0px; padding:8px 20px; font-size:10pt; width:650px; font-weight:bold;">' . count($user_list) . ' ' . __('users were found') . '</div>';
				
            echo '<hr><input type="button" value="' . __('Check all') . '" onclick="
                var f_elm = this.form[\'f_users[]\'];
                if (f_elm.length > 0) {
                    for(i=0; i<f_elm.length; i++)
                        f_elm[i].checked = true;
                } else f_elm.checked = true;
            " /> <input type="button" value="' . __('Uncheck all') . '"  onclick="
                f_elm = this.form[\'f_users[]\'];
                if (f_elm.length > 0) {
                    for(i=0; i<f_elm.length; i++)
                        f_elm[i].checked = false;
                } else f_elm.checked = false;
            " /> ' . __('&nbsp;&nbsp;Proceed') . ' : <input type="button" value="' . __('Delete all selected users') . '" onclick="
                    this.form.op.value=\'delete\';
                    this.form.submit();
            "/>
            <table cellpadding="3"><tr>
				<th>' . __('') . '</th>
				<th width="50" align="left">' . __('ID') . '</th>
				<th width="200" align="left">' . __('Username') . '</th>
				<th width="200" align="left">' . __('Name') . '</th>
				<th width="50" align="left">' . __('Posts') . '</th></tr>';
            
            $i = 0;
            foreach($user_list as $UR) {
                $i++;
                $color = $i % 2 ? '#DDE9F7' : '#E5E5E5';
                echo "<tr align=\"center\" style=\"background-color:$color\" ><td>";
				if ($UR['ID'] == $user_ID ) {
					echo "-";
				} else {
					echo "<input type=\"checkbox\" name=\"f_users[]\" value=\"$UR[ID]\"/ " 
                . (isset($_POST['f_users']) && in_array($UR['ID'], $_POST['f_users']) ? 'checked' : '') 
                . ">";
				}
				echo "
					</td><td align=\"left\">"
					. ($UR['ID'] ? $UR['ID'] : '0') . "</td><td align=\"left\">"
                    . (empty($UR['url']) ? $UR['login'] : "<a href=\"$UR[url]\" target=\"_blank\">$UR[login]</a>")
                    . "</td><td align=\"left\">$UR[name]</td><td align=\"left\">"
					. ($UR['recs'] ? $UR['recs'] : "<span style=\"color:red;\">0</span>") 
					. "</td></tr>\n";
				
            }
            ?></table><?php
           
        }
        
        break;
    }

?>
</form>	

<?php }

add_action('admin_menu', 'npud_add_options_pages');

?>