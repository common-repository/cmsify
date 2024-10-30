<?php
/*
Plugin Name: CMSify
Plugin URI: http://www.devbits.ca/
Description: CMSify your WordPress!  Additional options for extended features or hiding unneeded widgets, column and more!
Author: M. Fitzpatrick
Version: 1.22
Author URI: http://www.devbits.ca/

 Copyright 2011 Devbits  (email : m@devbits.ca)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
include_once('inc/dc.php');
$pchk = get_option('cmsify');
if( $pchk['prokey'] )
	include_once('inc/pro_ops.php');

class CMSIFY{
	public $default_settings = Array();
	public function __construct(){	
		if ( is_admin() ){ // admin actions
		  //PLUGIN
		  add_action( 'admin_menu',  array($this, 'Add2Menu') );
		  if( $_GET['page'] == 'cmsify'):
			  add_action('admin_print_scripts', array($this, 'AdminScripts') );
			  add_action('admin_print_styles', array($this, 'AdminStyles') );
			  add_action( 'admin_head',  array($this, 'AdminHead') );
		  endif;
		  add_action( 'admin_head', array($this, 'MenuIcon') );
		  add_action( 'admin_init', array($this, 'RegisterSettings') );
		  add_action( 'init', array($this, 'Defaults') );
		  add_action('init', array($this, 'BlankChecks') );
		 
		  load_plugin_textdomain('cmsify', false, basename( dirname( __FILE__ ) ) . '/languages' );
		  
		  //ADMIN OPTIONS
		  add_action('wp_dashboard_setup', array($this, 'RemoveDashboardWidgets') );
		  add_action('widgets_init', array($this, 'RemoveWidgets'), 1);
		  add_filter('manage_posts_columns', array($this, 'RemovePostColumns') );
		  add_filter('manage_pages_columns', array($this, 'RemovePageColumns') );
		  add_action('admin_init',array($this, 'RemoveMetaBoxes') );
		  add_action('admin_init', array($this, 'DisableNotice') );
		  add_action('admin_head', array($this, 'AdminHeaderIcon') );
		  add_filter('admin_footer_text', array($this, 'AdminFooterCredits') );
		  
		  
		  //MEDIA
		  add_filter('wp_generate_attachment_metadata',array($this, 'MaxFullSize'));
		  add_action( 'wp_ajax_CMSifyReBuild', 'CMSifyReBuild' );
		  add_action( 'init', array($this, 'ImageSizes') );
		  
		  //EDITOR
		  add_filter( 'mce_css', array($this, 'CustomEditorStylesheet') );
		  add_filter('tiny_mce_before_init', array( $this, 'customformatTinyMCE') );
		  
		  register_deactivation_hook( __FILE__, array($this, 'onDeactivate') );
		  
		} 
		add_action('login_head', array($this, 'LoginLogo') );
		
		$this->options = get_option('cmsify');
		$this->proopts = get_option('cmsifypro');
		$this->PluginPath = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	}
	public function BlankChecks(){
		if (!$this->options["formats"]) $this->options["formats"] = array();
		if (!$this->options["dashboard_widgets"]['normal']) $this->options['dashboard_widgets']['normal'] = array();
		if (!$this->options["dashboard_widgets"]['side'])	$this->options['dashboard_widgets']['side'] = array();
		if (!$this->options["widgets"])		$this->options['widgets'] = array();
		if (!$this->options["post_columns"])	$this->options['post_columns'] = array();
		if (!$this->options["page_columns"])	$this->options['page_columns'] = array();	
		if (!$this->options['post_meta']) 		$this->options['post_meta']  = array();
		if (!$this->options['page_meta']) 		$this->options['page_meta']  = array();
	}
	public function Defaults(){
		
		if( !isset($this->options["formats"]) ) $this->options["formats"] = array('p','h1','h2','h3','h4','h5','h6','pre','address');
		if( !isset($this->options["footercredits"]) ) $this->options["footercredits"]  = '<span id="footer-thankyou">Thank you for creating with <a href="http://wordpress.org/">WordPress</a>.</span> • <a href="http://codex.wordpress.org/">Documentation</a> • <a href="http://devbits.ca/wp-admin/freedoms.php">Freedoms</a> • <a href="http://wordpress.org/support/forum/4">Feedback</a> • <a href="http://devbits.ca/wp-admin/credits.php">Credits</a>';
		
		update_option('cmsify', $this->options);
		
	}
	public function Add2Menu(){
		add_menu_page(__('CMSify', 'cmsify'), __('CMSify', 'cmsify'), 'edit_plugins', 'cmsify', array($this, 'SettingsPage'), 'div');	
		add_submenu_page('cmsify', __('CMSify', 'cmsify'), __('CMSify', 'cmsify'), 'edit_plugins', 'cmsify', array($this, 'SettingsPage'));	
	}
	public function MenuIcon(){
	
		echo '<style type="text/css">
			#toplevel_page_cmsify div.wp-menu-image {
			  background:transparent url("'.$this->PluginPath.'cmsify16.png") no-repeat center -32px;
			} 
			#toplevel_page_cmsify:hover div.wp-menu-image, #toplevel_page_cmsify.current div.wp-menu-image, #toplevel_page_cmsify.wp-has-current-submenu div.wp-menu-image {
			  background:transparent url("'.$this->PluginPath.'cmsify16.png") no-repeat center 0px;
			}
			#icon-cmsify {
				background: url("'.$this->PluginPath.'cmsify32.png") no-repeat scroll transparent;
			}
			</style>';
		
	}
	public function AdminScripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('CMSupload', $this->PluginPath .'CMSupload.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('CMSupload');
	}
		
	public function AdminStyles() {
		wp_enqueue_style('thickbox');
	}
	
	public function AdminHead(){
		
		if( $_GET['page'] == 'cmsify'):
		?>
        <script type='text/javascript' src='<?php echo $this->PluginPath;?>jquery-ui-personalized-1.5.2.packed.js'></script>
        <script type="text/javascript" src='<?php echo $this->PluginPath;?>colorbox/jquery.colorbox-min.js'></script>
		<script type="text/javascript" src='<?php echo $this->PluginPath;?>cmsify-behaviors.js'></script>
        <link href="<?php echo $this->PluginPath;?>colorbox/colorbox.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $this->PluginPath;?>cmsify-style.css" rel="stylesheet" type="text/css">
        
        <?php	endif;
	}
	public function RegisterSettings(){
		register_setting( 'cmsify-group', 'cmsify' );
		if( $this->isPro(0) ) register_setting( 'cmsify-group', 'cmsifypro' );
	}
	
	public function SettingsPage(){
		global $proOps, $CMSP;
		if( $_GET['reimg'] ): $this->ImageRebuildPanel();
		else:
		if (function_exists('wp_tiny_mce')) {
		
		  add_filter('teeny_mce_before_init', create_function('$a', '
			$a["theme"] = "advanced";
			$a["skin"] = "wp_theme";
			$a["height"] = "300";
			$a["width"] = "400";
			$a["onpageload"] = "";
			$a["mode"] = "exact";
			$a["elements"] = "AdminNoticeMessage";
			$a["editor_selector"] = "mceEditor";
			$a["plugins"] = "safari,inlinepopups,spellchecker";
		
			$a["forced_root_block"] = false;
			$a["force_br_newlines"] = true;
			$a["force_p_newlines"] = false;
			$a["convert_newlines_to_brs"] = true;
			$a["theme_advanced_buttons1"] = "bold,italic,link";
			
			return $a;'));
		
		 wp_tiny_mce(true);
		}
		?>       
       
        <div class="wrap">
        	<div id="icon-cmsify" class="icon32"><br></div>
        	<h2><?php _e('CMSify Settings', 'cmsify');?></h2>

            <form action="options.php" method="post">
            	<?php 
				settings_fields( 'cmsify-group' );
	
				?>
            	<input type="hidden" name="cp_action" value="save" />            
				
                <div id="tabvanilla" class="widget">
                  <ul class="tabnav">
                    <li><a href="#AdminOpts"><?php _e('Admin', 'cmsify');?></a></li>
                    <?php if( class_exists('CMSifyPro') ) echo '<li><a href="#AdminBar">'.__('Admin Bar', 'cmsify').'</a></li>'; ?>
                    <li><a href="#Media"><?php _e('Media', 'cmsify');?></a></li>
                    <li><a href="#Editor"><?php _e('Editor', 'cmsify');?></a></li>
                    <li><a href="#Branding"><?php _e('Branding', 'cmsify');?></a></li>
                    <li><a href="#Recommendations"><?php _e('Recommendations', 'cmsify');?></a></li>
                    <?php if( !$this->isPro(0) ): ?> <li><a href="#Pro"><?php _e('Go Pro!', 'cmsify');?></a></li>
                    <?php else: ?>  <li><a href="#Pro"><?php _e('Pro Settings', 'cmsify');?></a></li> <?php endif; ?>
                 </ul>
                     <div id="AdminOpts" class="tabdiv">
                      <?php include_once('inc/admin_ops.php');?>
                    </div>                                  
                    <?php if( class_exists('CMSifyPro') )  $proOps->ProAdminBarOps(); ?> 
                    <div id="Media" class="tabdiv">
                    	<?php include_once('inc/media_ops.php'); ?>
                    </div>                         
                    <div id="Editor" class="tabdiv">
                        <?php include_once('inc/editor_ops.php');?>
                    </div>
                    <div id="Branding" class="tabdiv">
                        <?php include_once('inc/branding_ops.php');?>
                    </div>
                    
                    <div id="Recommendations" class="tabdiv">
                    	<?php include_once('inc/recommendations.php');?>
                    </div>   
                    <div id="Pro" class="tabdiv">
                    	<?php include_once('inc/gopro.php');?>
                    </div>
             
                                    
                </div>
                <p class="submit">
                <input name="Submit" class="button-primary" value="<?php _e('Save Changes', 'cmsify');?>" type="submit">
                </p>

            </form>
        </div>
        <?php
		endif;
	}
	
	/* IMAGE SIZE FUNCTIONS */
	public function ImageRebuildPanel(){
		
		?>
        <div id="message" class="updated fade" style="display:none;"></div>
		<script type="text/javascript">
		// <![CDATA[

		function ShowMessage(m) {
			jQuery("#message").html(m);
			jQuery("#message").show();
		}
		function setMessage(m){
			jQuery("#message").append(m);	
		}

		function Rebuild() {
			jQuery("#RebuildImages").attr("disabled", true);
			ShowMessage("<p>Loading Images&hellip;</p>");

			inputs = jQuery( 'input:checked' );
			var sizes = '';
			if( inputs.length != jQuery( 'input[type=checkbox]' ).length ){
				inputs.each( function(){
					sizes += '&sizes[]='+jQuery(this).val();
					
				} );
			}

			jQuery.ajax({
				url: "<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php", 
				type: "POST",
				data: "action=CMSifyReBuild&do=getlist",
				success: function(result) {
					var list = eval(result);
					var curr = 0;

					function regenItem() {
						if (curr >= list.length) {
							jQuery("#RebuildImages").removeAttr("disabled");
							setMessage("<?php _e('All Images Rebuilt.', 'cmsify');?>");
							return;
						}
						setMessage("<?php _e('Rebuilding', 'cmsify');?> " + (curr+1) + " of " + list.length + " (" + list[curr].title + ")...");

						jQuery.ajax({
							url: "<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",
							type: "POST",
							data: "action=CMSifyReBuild&do=regen&id=" + list[curr].id + sizes,
							success: function(result) {
								jQuery("#LastDone").show();
								jQuery("#Done").attr("src",result);

								curr = curr + 1;
								regenItem();
							}
						});
					}

					regenItem();
				},
				error: function(request, status, error) {
					setMessage("<?php _e('Rebuild Error', 'cmsify');?> " + request.status);
				}
			});
		}

		// ]]>
		</script>
        <div class="wrap">
        	<div id="icon-options-general" class="icon32"><br></div>
        	<h2><a href="?page=cmsify"><?php _e('CMSify', 'cmsify');?></a> &raquo; <?php _e('Rebuild Image Sizes', 'cmsify');?></h2>
            
            
            <form method="post" action="">
            <p><?php _e('Rebuild your current uploaded images to new image sizes.', 'cmsify');?></p>
            <table class="form-table">
                <tbody>
                   <tr valign="top">
                        <th scope="row"><label><?php _e('Select Image Sizes to Rebuild', 'cmsify');?>:</label></th>
                        <td>
            <?php
			global $_wp_additional_image_sizes;

			foreach ( get_intermediate_image_sizes() as $s ):

				if ( isset( $_wp_additional_image_sizes[$s]['width'] ) ) // For theme-added sizes
					$width = intval( $_wp_additional_image_sizes[$s]['width'] );
				else                                                     // For default sizes set in options
					$width = get_option( "{$s}_size_w" );

				if ( isset( $_wp_additional_image_sizes[$s]['height'] ) ) // For theme-added sizes
					$height = intval( $_wp_additional_image_sizes[$s]['height'] );
				else                                                      // For default sizes set in options
					$height = get_option( "{$s}_size_h" );

				if ( isset( $_wp_additional_image_sizes[$s]['crop'] ) )   // For theme-added sizes
					$crop = intval( $_wp_additional_image_sizes[$s]['crop'] );
				else                                                      // For default sizes set in options
					$crop = get_option( "{$s}_crop" );
			?>
            <label><input type="checkbox" name="sizes[]"  value="<?php echo $s ?>" />
				
					<strong style="text-transform:capitalize"><?php echo $s ?></strong> <?php echo $width ?>x<?php echo $height ?><?php echo ($crop == 1?' <em>'.__('cropped', 'cmsify').'</em>':'') ?>
				</label>
				<br/>
			<?php endforeach;?>
            </td>
            <td><p id="LastDone" style="display:none;"><strong><?php _e('Last Rebuilt', 'cmsify');?></strong> <small><?php _e('(showing thumbnail size only):', 'cmsify');?></small><br><img id="Done" /></p></td>
            </tr>
            </tbody>
            </table>
            <p class="submit">
                <input name="RebuildImages" id="RebuildImages" class="button-primary" value="<?php _e('Rebuild Selected Image Sizes', 'cmsify');?>" type="button" onClick="javascript:Rebuild();">
              </p>
            </form>
            
        </div>
        <?php	
	}
	public function ImageRebuild(){
		global $wpdb;
		$action = $_POST["do"];
		$thumbnails = isset( $_POST['sizes'] )? $_POST['sizes'] : NULL;
	
		if ($action == "getlist") {
	
				$attachments =& get_children( array(
					'post_type' => 'attachment',
					'post_mime_type' => 'image',
					'numberposts' => -1,
					'post_status' => null,
					'post_parent' => null, // any parent
					'output' => 'object',
				) );
			
	
			foreach ( $attachments as $attachment ) {
				$res[] = array('id' => $attachment->ID, 'title' => $attachment->post_title);
			}
			die( json_encode($res) );
		} else if ($action == "regen") {
			$id = $_POST["id"];
	
			$fullsizepath = get_attached_file( $id );
	
			if ( FALSE !== $fullsizepath && @file_exists($fullsizepath) ) {
				set_time_limit( 30 );
				wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $fullsizepath ) );
			}
	
			die( wp_get_attachment_thumb_url( $id ));
		}
	}
	
	public function ImageSizes(){
		$s = $this->options['sizes'];
		if($s):
		foreach($s['label'] as $k=>$l):
			if( function_exists( 'add_image_size' ) ) {	 
				add_image_size( $s['label'][$k], $s['height'][$k], $s['width'][$k], $s['crop'][$k] );
			}	
		endforeach;
		endif;
		$maxh = $this->options['maxheight'];
		$maxw = $this->options['maxwidth'];
		if( $maxh && $maxw ) add_image_size( 'MaxFull', $maxh, $maxw, false );
	}
	/* END IMAGE SIZE FUNCTIONS */
	
	
	
	/*TinyMCE Functions*/
	public function customformatTinyMCE($init) {
		$formats = implode(',',$this->options['formats']);
		// Add block format elements you want to show in dropdown
		$init['theme_advanced_blockformats'] = $formats;
		
		foreach( $this->options['fontsizes']['label'] as $k =>$l ):
			$sizes[] = $l.'='.$this->options['fontsizes']['value'][$k];
		endforeach;
		$init['theme_advanced_font_sizes'] = implode(';', $sizes);
		return $init;
	}
	//Add custom styles to editor
	public function CustomEditorStylesheet($url){ 
		if( $this->options['customstyle'] ):
			$url = get_stylesheet_directory_uri() . '/' . $this->options['customstyle'];
			return $url;
		endif;
	}
	
	//Remove Dashboard Widgets
	public function RemoveDashboardWidgets(){
		foreach( $this->options['dashboard_widgets']['normal'] as $k => $widget ):
			remove_meta_box( $widget, 'dashboard', 'normal' );
		endforeach;
		foreach( $this->options['dashboard_widgets']['side'] as $k => $widget ):
			remove_meta_box( $widget, 'dashboard', 'side' );
		endforeach;
		$plugins = explode(",", $this->options['dashboard_widgets']['plugins']);
		foreach( $plugins as $k => $widget ):
			remove_meta_box( $widget, 'dashboard', 'normal' );
			remove_meta_box( $widget, 'dashboard', 'side' );
		endforeach;
	}
	public function RemoveWidgets(){
	  	$widgets = $this->options['widgets'];
		if( $widgets) :
		foreach( $widgets as $k => $widget ):
		  unregister_widget($widget);
	  	endforeach;
		$plugins = explode(",", $this->options['widgets']['plugins']);

		foreach( $plugins as $k => $widget ):
			unregister_widget($widget);
		endforeach;
		endif;
	}
	
	
	
	//Remove Post Columns
	public function RemovePostColumns($defaults) {
	  //print_r($defaults);
	  foreach( $this->options['post_columns'] as $k =>$colname ):
		  unset($defaults[$colname]);
	  endforeach; 
	  $plugged = explode(",", $this->options['post_columns_plugins']);
	  foreach( $plugged as $k =>$colname ):
		  unset($defaults[$colname]);
	  endforeach;  
	  return $defaults;
	}
	
	//Remove Page Columns
	public function RemovePageColumns($defaults) {
	  foreach( $this->options['page_columns'] as $k =>$colname ):
		  unset($defaults[$colname]);
	  endforeach;  
	  $plugged = explode(",", $this->options['page_columns_plugins']);
	  foreach( $plugged as $k =>$colname ):
		  unset($defaults[$colname]);
	  endforeach;  
	  return $defaults;
	}
	
	//Remove Meta Boxes
	public function RemoveMetaBoxes(){
		foreach( $this->options['post_meta'] as $k => $meta ):
			remove_meta_box($meta,'post','normal');
		endforeach;
		$plugged = explode(",", $this->options['post_meta_plugins']);
	  foreach( $plugged as $k =>$meta ):
		  remove_meta_box($meta,'post','normal');
	  endforeach; 
	  
	  foreach( $this->options['page_meta'] as $k => $meta ):
			remove_meta_box($meta,'page','normal');
		endforeach;
		$plugged = explode(",", $this->options['page_meta_plugins']);
	  foreach( $plugged as $k =>$meta ):
		  remove_meta_box($meta,'page','normal');
	  endforeach; 
	}
	
	public function MaxFullSize($image_data) {	
		if (!isset($image_data['sizes']['MaxFull'])) return $image_data;
		//define the new Full location/file
		$upload_dir = wp_upload_dir();
		$uploaded_image_location = $upload_dir['basedir'] . '/' .$image_data['file'];
		$large_image_location = $upload_dir['path'] . '/'.$image_data['sizes']['MaxFull']['file'];
		// delete the original uploaded image
		unlink($uploaded_image_location);
		// rename the MaxFull image
		rename($large_image_location,$uploaded_image_location);
		// update image metadata
		$image_data['width'] = $image_data['sizes']['MaxFull']['width'];
		$image_data['height'] = $image_data['sizes']['MaxFull']['height'];
		//remove MaxFull size as it is now the full size
		unset($image_data['sizes']['MaxFull']);
		return $image_data;
	}
	
	public function DisableNotice(){
		if( !current_user_can('administrator') && $this->options['upgradenotice'] )
			add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );	
	}
	
	public function PreviewIMG($imgnm, $title=false, $style=false, $rel=false){
		return '<a href="'.$this->PluginPath.'imgs/'.$imgnm.'.png" class="colorbox" rel="'.$rel.'" title="'.$title.'" style="'.$style.'"><img src="'.$this->PluginPath.'imgs/'.$imgnm.'.png" width="95%" alt="" /></a>';	
	}
	public function AdminHeaderIcon() {
	  if( $this->options['headericon'] ):
	  	echo '<style type="text/css">
		#header-logo { background-image: url('.$this->options['headericon'].') !important; }
		</style>';
	  endif;
}
	public function AdminFooterCredits () {
	  echo $this->options['footercredits'];
	}
	public function LoginLogo() {
	  	if( $this->options['loginlogo'] ):
			if( $this->options['loginlogoheight'] > 67 ) $height =  ' height:'.$this->options['loginlogoheight'].'px';
		  echo '<style type="text/css">
			h1 a { background-image:url('.$this->options['loginlogo'].') !important; '.$height.'}
			</style>';
		endif;
	}
	
	
	public function onDeactivate(){
		$ops = get_option('cmsify');
		$ops['prokey'] = '';
		update_option($ops);
	}
	

	public function isPro($indicators=false){
		$isV = DBValidateScript('CMSifyPro');
		if( $indicators ):
			if( $this->options['prokey'] ) $err = ' INVALID LICENSE';
			if( $isV ) echo '<span style="color:#008A00;font-size:larger">&#x2713;</span>'; else echo '<span style="color:red;font-size:larger">x'.$err.'</span>';	
		else:
			return $isV;
		endif;
	}
	public function MyKey($domain, $scriptID){
		global $BDIETVS;
		return $BDIETVS->CL($domain, $scriptID);
	}
	
	
}
$cmsify = new CMSIFY;

function CMSifyReBuild(){
	global $cmsify;
	$cmsify->ImageRebuild();	
}
?>