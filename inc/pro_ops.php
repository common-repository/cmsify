<?php
if( !class_exists('CMSifyPro') && DBValidateScript('CMSifyPro') ):
include_once('pro_func.php');
class CMSifyPro{
	public function __construct(){ 		
		$this->options = get_option('cmsify');
		$this->proopts = get_option('cmsifypro');
		$this->PluginPath = str_replace('/inc', '', WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
		add_action('init', array($this, 'BlankChecks') );
	}
	public function BlankChecks(){
		if (!$this->proopts["adminbar_items"]) $this->proopts["adminbar_items"] = array();
		if (!$this->proopts["adminbar_new"]) $this->proopts["adminbar_new"]['title'] = array();
		if (!$this->proopts["subscriberadmin"]) $this->proopts["subscriberadmin"] = get_option('siteurl');
		if (!$this->proopts["adminlogin"]) $this->proopts["adminlogin"]["role"] = array();
	}
	
	public function ProAdminOps(){
		?>
                  
                  <tr valign="top">
                        <th scope="row"><label><?php _e('Admin Login Redirection', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                        <td>
                        <?php $login = $this->proopts['adminlogin'];
						foreach( $login['role'] as $k => $d ): ?>
                        <div class="AdminAccessItem">
                                	<label><?php _e('User Role:', 'cmsify');?><select name="cmsifypro[adminlogin][role][]"><?php echo $this->SelectUserRoles($login['role'][$k]);?></select></label> <label><?php _e('Login directly to:', 'cmsify');?> <input type="text" name="cmsifypro[adminlogin][redirect][]" value="<?php echo $login['redirect'][$k]; ?>" /></label>
                            <a href="" class="AdminAccessRemove"><img src="<?php echo $this->PluginPath;?>imgs/remove.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Remove Item', 'cmsify');?>" /></a>
                            	</div>
							
						<?php endforeach; ?>
                        	<div id="AdminAccessRepeat">
                            	<div class="AdminAccessItem">
                                	<label><?php _e('User Role:', 'cmsify');?><select name="cmsifypro[adminlogin][role][]"><?php echo $this->SelectUserRoles();?></select></label> <label><?php _e('Login directly to:', 'cmsify');?> <input type="text" name="cmsifypro[adminlogin][redirect][]" /></label>
                            <a href="" class="AdminAccessRemove"><img src="<?php echo $this->PluginPath;?>imgs/remove.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Remove Item', 'cmsify');?>" /></a>
                            	</div>
                            
                            </div><a href="" id="AdminAccessAdd"><img src="<?php echo $this->PluginPath;?>imgs/add.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Add Item', 'cmsify');?>" /></a>
                        </td>
                	</tr>
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Subscriber Access', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                        <td>
                        <label><input type="checkbox" value="1" name="cmsifypro[subscriberaccess]" <?php if( $this->proopts['subscriberaccess'] ) echo 'checked="checked"'; ?> /> <?php _e('Block Admin Access for Subscribers', 'cmsify');?></label>
                         <label><?php _e(' and redirect them to:', 'cmsify'); ?> <input type="text" name="cmsifypro[subscriberadmin]" value="<?php echo $this->proopts['subscriberadmin'];?>" /></label>
                        </td>
                   </tr>
                   <tr valign="top">
                        <th scope="row"><label><?php _e('Custom Admin Notice Message', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                        <td>
                        <textarea name="cmsifypro[customnoticemsg]" style="width:150px" id="AdminNoticeMessage" class="theEditor"><?php echo $this->proopts['customnoticemsg'];?></textarea>
                        
                        <br><label><input type="checkbox" name="cmsifypro[alladminnotices]" value="1" />
<small><?php _e('Show this new message for all users who previously clicked on the Hide link', 'cmsify');?></small></label>
<br><label><input type="checkbox" name="cmsifypro[disableadminnotices]" <?php if( $this->proopts['disableadminnotices']==1 ) echo 'checked="checked"';?> value="1" /> <small><?php _e('Disable all custom admin notices', 'cmsify');?></small></label>
                        </td>
                	</tr>
       
        <?php	
	}
	
	public function ProEditorOps(){
		
	}
	
	public function ProMediaOps(){
		?>
        <tr valign="top">
                            <th scope="row"><label><?php _e('Re-Assign/Detach Media', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                            <td><label><input type="checkbox" name="cmsifypro[detachmedia]" id="detachmedia" value="1" <?php if( $this->proopts['detachmedia']) echo 'checked="checked"'; ?>  /><br><small><?php _e('Add ability to re-assign or detach Media from their current Post Parent within the Media Library panels', 'cmsify');?></small>
                            
                            </td>
                        </tr>
        <?php	
	}
	
	public function ProAdminBarOps(){
		?>
        <div id="AdminBar" class="tabdiv">
        	<table class="form-table">
                    <tbody>
                    	<tr valign="top">
                            <th scope="row"><label><?php _e('Disable Admin Bar', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                            <td><label><input type="checkbox" name="cmsifypro[hideadminbar]" id="hideadminbar" value="1" <?php if( $this->proopts['hideadminbar']) echo 'checked="checked"'; ?>  /><br><small><?php _e('Completely disabled Admin Bar for all users', 'cmsify');?></small>
                            
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Always OnAdmin Bar', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                            <td><label><input type="checkbox" name="cmsifypro[alwaysadminbar]" id="alwaysadminbar" value="1" <?php if( $this->proopts['alwaysadminbar']) echo 'checked="checked"'; ?>  /><br><small><?php _e('Show admin bar even when logged out (shows Login button and Search)', 'cmsify');?></small>
                            
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Hide Admin Bar Profile Settings', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                            <td><label><input type="checkbox" name="cmsifypro[hidesettingsadminbar]" id="hidesettingsadminbar" value="1" <?php if( $this->proopts['hidesettingsadminbar']) echo 'checked="checked"'; ?>  /><br><small><?php _e('Hides the Admin Bar settings within the users Profile panel', 'cmsify');?></small>
                            
                            </td>
                        </tr>
                        
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Bottom Admin Bar ', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                            <td><label><input type="checkbox" name="cmsifypro[bottomadminbar]" id="bottomadminbar" value="1" <?php if( $this->proopts['bottomadminbar']) echo 'checked="checked"'; ?>  /><br><small><?php _e('Show admin bar at the bottom of the page (Front and Back end)', 'cmsify');?></small>
                            
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Hide Admin Bar Menu Items', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                            <td>
                            <div style="width:30%; margin-right:2%; float:left;">
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[hidesearchadminbar]" value="updates" <?php if( $this->proopts['hidesearchadminbar'] ) echo 'checked="checked"';?> /> <?php _e('Search Box', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="my-account" <?php if( in_array('my-account', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('My Account', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="my-account-with-avatar" <?php if( in_array('my-account-with-avatar', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('My Account (avatars)', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="edit-profile" <?php if( in_array('edit-profile', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('My Account &raquo; Edit Profile', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="logout" <?php if( in_array('logout', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('My Account &raquo; Log Out', 'cmsify');?></label><br>
                             
                              <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="view-site" <?php if( in_array('view-site', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Visit Site', 'cmsify');?></label><br>
                              <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="dashboard" <?php if( in_array('dashboard', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Dashboard', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="my-blogs" <?php if( in_array('my-blogs', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('My Sites', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="edit" <?php if( in_array('edit', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Edit Post/Page', 'cmsify');?></label><br>
                             
                              <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="comments" <?php if( in_array('comments', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Comments', 'cmsify');?></label><br>
                              <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="updates" <?php if( in_array('updates', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Updates', 'cmsify');?></label><br>
                              
                             </div>
                             <div style="width:30%; margin-right:2%; float:left;">
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="new-content" <?php if( in_array('new-content', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Add New', 'cmsify');?></label><br>
                             
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="new-post" <?php if( in_array('new-post', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Add New &raquo; Post', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="new-page" <?php if( in_array('new-page', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Add New &raquo; Page', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="new-media" <?php if( in_array('new-media', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Add New &raquo; Media', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="new-link" <?php if( in_array('new-link', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Add New &raquo; Link', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="new-user" <?php if( in_array('new-user', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Add New &raquo; User', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="new-theme" <?php if( in_array('new-theme', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Add New &raquo; Theme', 'cmsify');?></label><br>
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="new-plugin" <?php if( in_array('new-plugin', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Add New &raquo; Plugin', 'cmsify');?></label><br>
                             
                            
                             <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="appearance" <?php if( in_array('appearance', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Appearance', 'cmsify');?></label><br>
                              <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="themes" <?php if( in_array('themes', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Appearance &raquo; Themes', 'cmsify');?></label><br>
                              <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="widgets" <?php if( in_array('widgets', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Appearance &raquo; Widgets', 'cmsify');?></label><br>
                              <label><input type="checkbox" class="checkbox" name="cmsifypro[adminbar_items][]" value="menus" <?php if( in_array('menus', $this->proopts['adminbar_items']) ) echo 'checked="checked"';?> /> <?php _e('Appearance &raquo; Menus', 'cmsify');?></label><br>
                             
                             
                             
                            
                            </div>
                            <div style="width:30%; margin-right:2%; float:left;"><h4><?php _e('Plugin Menus', 'cmsify');?></h4>
                                <p><?php _e('Plugins that install items into the Admin Bar can be disabled below.  Get the menu items class and remove "wp-admin-bar-" and enter the rest below - comma separated please.', 'cmsify');?></p>
                                <textarea name="cmsifypro[adminbar_items][plugins]" cols=20 rows=3 style="width:95%"><?php echo $this->proopts['adminbar_items']['plugins'];?></textarea>
                                </div>
                            </td>
                        </tr>
                         <tr valign="top">
                            <th scope="row"><label><?php _e('Add Menu Items to Admin Bar ', 'cmsify');?>:</label><br><small style="color:#008A00;margin-top:3px;"><?php _e('PRO', 'cmsify');?></small></th>
                            <td>
                            <?php $new = $this->proopts['adminbar_new']; foreach( $this->proopts['adminbar_new']['title'] as $k => $v ): ?>
                            <div class="adminbarmenuitem"><label><?php _e('Parent', 'cmsify');?><select name="cmsifypro[adminbar_new][parent][]"><?php echo $this->AdminBarParents($new['parent'][$k]);?></select></label> <label><?php _e('Title', 'cmsify');?><input type="text" name="cmsifypro[adminbar_new][title][]" value="<?php echo $new['title'][$k];?>" /></label> <label><?php _e('Link', 'cmsify');?><input type="text" name="cmsifypro[adminbar_new][href][]" value="<?php echo $new['href'][$k];?>" /></label> <a href="" class="AdminBarRemove"><img src="<?php echo $this->PluginPath;?>imgs/remove.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Remove Menu Item', 'cmsify');?>" /></a></div>
                            <?php endforeach; ?>
                            <div id="AdminBarRepeat"><div class="adminbarmenuitem"><label><?php _e('Parent', 'cmsify');?><select name="cmsifypro[adminbar_new][parent][]"><?php echo $this->AdminBarParents();?></select></label> <label><?php _e('Title', 'cmsify');?><input type="text" name="cmsifypro[adminbar_new][title][]" value="" /></label> <label><?php _e('Link', 'cmsify');?><input type="text" name="cmsifypro[adminbar_new][href][]" value="" /></label> <a href="" class="AdminBarRemove"><img src="<?php echo $this->PluginPath;?>imgs/remove.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Remove Menu Item', 'cmsify');?>" /></a></div>
                            </div><a href="" id="AdminBarAdd"><img src="<?php echo $this->PluginPath;?>imgs/add.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Add Menu Item', 'cmsify');?>" /></a>
                            
                            </td>
                        </tr>
                        
                    </tbody>
             </table>
        </div>
        <?php
	}
	public function AdminBarParents($cur=false){
		
		$parents = array('0' => '--No Parent--', 'my-account-with-avatar' => __('My Account (avatar)', 'cmsify'), 'my-account' => __('My Account', 'cmsify'), 'view-site' => __('Visit Site', 'cmsify'), 'dashboard' => __('Dashboard', 'cmsify'), 'my-blogs' => __('My Sites', 'cmsify'),  'edit' => __('Edit Post/Page', 'cmsify'), 'new-content' => __('New Content', 'cmsify'), 'comments' => __('Comments', 'cmsify'),  'appearance' => __('Appearance', 'cmsify'), 'updates' => __('Updates', 'cmsify')  );
		$parents = array_merge($parents, $this->GetNewAdminBarParents() );
		foreach($parents as $v=>$p):
			if( $cur == $v ) $sel = ' selected="selected"'; else $sel = false;
			$output .= "<option value='$v' $sel >$p</option>\n";
		endforeach;
		return $output;
	}
	public function GetNewAdminBarParents(){
		$new = $this->proopts['adminbar_new'];
		$newparent = array();
		foreach( $new['title'] as $k => $v ):
			if( !$new['parent'][$k] ) $newparent[sanitize_title($new['title'][$k])] = $new['title'][$k];
		endforeach;	
		return $newparent;
	}
	public function SelectUserRoles($cur=false){
		global $wpdb;
		$roles = get_option($wpdb->prefix.'user_roles');
		//print_r($roles);
		foreach($roles as $rolekey => $data):
			if( $cur == $rolekey ) $sel = ' selected="selected"'; else $sel = false;
			if( $rolekey != 'administrator' ) $output .= '<option value="'.$rolekey.'"'.$sel.'>'.$data['name'].'</option>'."\n";
		endforeach;
		return $output;
	}
	
}
$proOps = new CMSifyPro;
endif;
?>