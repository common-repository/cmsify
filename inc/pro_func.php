<?php
global $BDIETVS;
$cmsifyop = get_option('cmsify');

if( !class_exists('CMSifyProFunc') && $cmsifyop['prokey'] && $BDIETVS->V( $cmsifyop['prokey'], 'CMSifyPro') ):
class CMSifyProFunc{
	public function __construct(){ 
		
		$this->options = get_option('cmsify');
		$this->proopts = get_option('cmsifypro');
		$this->PluginPath = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
		 
		add_action('init', array($this, 'SubscriberAccess') );
		add_action('init', array($this, 'LoginRedirects') );
		if( $this->proopts['detachmedia']):
			add_filter('media_row_actions',  array($this, 'MediaAttachment'), null, 2);
			add_action('attachment_fields_to_edit', array($this, 'MediaForm'), null, 2);
			add_action('attachment_fields_to_save', array($this, 'SaveMedia'), null, 2);
			if( $_REQUEST['detach'] && $_REQUEST['fileID'] )
				add_action('init', array($this, 'DetachMedia'));		
		endif;
		if( $this->proopts['customnoticemsg']):
			add_action('admin_notices', array($this, 'AdminNoticeDisplay') ); 
			add_action('wp_ajax_hide_cmsify_notice', array($this, 'HideNotice') );
			if( $this->proopts['alladminnotices'] )
				add_action('init', array($this, 'ShowNotice') );
		endif;
		if( $this->proopts['hideadminbar']):
			add_filter( 'show_admin_bar', '__return_false' );
		else:
			add_action( 'admin_bar_menu', array($this, 'AdminBarMenu') );
			add_action( 'wp_before_admin_bar_render', array($this, 'AdminBarCustomMenu') );
			add_action( 'wp_before_admin_bar_render', array($this, 'AdminBarAddItems') );
			if( $this->proopts['alwaysadminbar']): 
				add_filter( 'show_admin_bar', '__return_true' , 1000 );
			endif;
			if( $this->proopts['bottomadminbar']):
				add_action( 'admin_footer', array($this, 'AdminBarBottom') );
				add_action( 'wp_footer', array($this, 'AdminBarBottom') );
			endif;
			if( $this->proopts['hidesearchadminbar']):
				add_action( 'admin_footer', array($this, 'AdminBarHideSearch') );
				add_action( 'wp_footer', array($this, 'AdminBarHideSearch') );
			endif;
			if( $this->proopts['hidesettingsadminbar'])
				add_action('admin_print_scripts-profile.php', array($this, 'AdminBarHideSettings') );
			
			
		endif;
		
	}
	
	public function MediaAttachment($actions, $post) {
	if ($post->post_parent):
		$url = admin_url('upload.php?detach=true&fileID=' . $post->ID);
		$actions['detach'] = '<a href="' . esc_url( $url ) . '" title="' . __( "Detach from Post", 'cmsify') . '">' . __( 'Detach', 'cmsify') . '</a>';
	endif;
	
	return $actions;
	}
	
	public function MediaForm($form_fields, $post){
	
		$form_fields['detach'] = array( 
						'label' => __('Attach to', 'cmsify'), 
						'input' => 'html', 
						'html' => "<select name='attachments[{$post->ID}][post_parent]'>
						<option value='0'>".__('--Detach from all Posts--', 'cmsify').'</option>'.$this->PageSelect($post->post_parent).'</select>', 
						);
	
		
		return $form_fields;
	}
	
	public function DetachMedia() {
		global $wpdb;
		if (!empty($_REQUEST['fileID'])) {
			$wpdb->update($wpdb->posts, array('post_parent'=>0), array('id'=>$_REQUEST['fileID'], 'post_type'=>'attachment'));
		}
		if( $_GET['tab'] )
			wp_safe_redirect(admin_url('media-upload.php?post_id='.$_GET['post_id'].'&tab=gallery'));
		else
			wp_safe_redirect(admin_url('upload.php'));
	}
	
	public function SaveMedia($post, $attachment){

		$post['post_parent'] = $attachment['post_parent'];
	    return $post;
	}
	
	public function LoginRedirects(){
		
		if( wp_get_referer() == get_option('siteurl').'/wp-login.php' && $this->proopts['adminlogin']['role'] && $_SERVER['REQUEST_URI'] == '/wp-login.php' ):
			global $wp_roles;
			//echo wp_get_referer();
			$current_user = wp_get_current_user();
			$roles = $current_user->roles;
			$role = array_shift($roles);
			if( in_array( $role, $this->proopts['adminlogin']['role']) ):
				$k = array_search($role, $this->proopts['adminlogin']['role']);
				wp_safe_redirect( $this->proopts['adminlogin']['redirect'][$k] );
			endif;
				
		endif;
	}
	
	public function SubscriberAccess(){
		if( $this->proopts['subscriberaccess'] && is_admin() ):
			global $wp_roles;
			$current_user = wp_get_current_user();
			$roles = $current_user->roles;
			$role = array_shift($roles);
			if( $role == 'subscriber' )
				wp_safe_redirect($this->proopts['subscriberadmin']);
		endif;
	}
	
	public function AdminNoticeDisplay(){
		 $user = wp_get_current_user();
		  $seen_notice = get_option('CMSifyNoticeSeen');
		  $notice = $this->proopts['customnoticemsg'];
		  $disable = $this->proopts['disableadminnotices'];
		  
		  if( !$disable && !isset($seen_notice[$user->ID]) && !$seen_notice[$user->ID] && $notice ){
			  ?>
              <div class="updated fade below-h2">
                <p>
                   <strong><?php _e('Hi ', 'cmsify'); echo $user->display_name; ?>!</strong> <br>
                 
                 <?php echo nl2br($notice);?>
               <br> 
                   <small><a class="hide-this" href="#"><?php _e('Dismiss', 'cmsify');?></a></small>
                </p>
              </div>  
        
              <script type="text/javascript">
               jQuery(document).ready(function($) {
        
                $("a.hide-this").live('click', function(){
                 $$$ = $(this);
                 $.ajax({
                  url: '<?php echo admin_url("admin-ajax.php"); ?>',
                  type: "GET",
                  data: ({
                    action: 'hide_cmsify_notice',
                    _ajax_nonce: '<?php echo wp_create_nonce('hide-cmsify-notice'); ?>'
                  }),
                  success: function(data) { $$$.closest("div").remove(); }    
                 });
                });
               });
              </script>    
          <?php     
          }  
	}
	public function HideNotice(){
		check_ajax_referer("hide-cmsify-notice");
		  $user = wp_get_current_user();
		  $seen_notice = get_option('CMSifyNoticeSeen');
		  $seen_notice[$user->ID] = true;
		  update_option('CMSifyNoticeSeen', $seen_notice);
		  die();
	}
	public function ShowNotice(){
		  update_option('CMSifyNoticeSeen', '');
		  $this->proopts['alladminnotices'] = false;
	}
	
	public function PageSelect($cur){
		global $wpdb;
		if( !is_array($cur) ) $cur = array($cur);
		$pages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_parent = '' ORDER BY menu_order ASC");
		foreach($pages as $P):
			$subpages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_parent = '".$P->ID."' ORDER BY menu_order ASC");
			$output .= '<option value="'.$P->ID.'"';
			if( $P->ID == $cur || in_array($P->ID, $cur) ) $output .= ' selected="selected"';
			$output .= '>'.$P->post_title.'</option>'."\n";
			foreach($subpages as $S):
				$subsubpages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_parent = '".$S->ID."' ORDER BY menu_order ASC");
				$output .= '<option value="'.$S->ID.'"';
				if( $S->ID == $cur  || in_array($S->ID, $cur)) $output .= ' selected="selected"';
				$output .= '>&mdash; '.$S->post_title.'</option>'."\n";
				foreach($subsubpages as $SS):
					$output .= '<option value="'.$SS->ID.'"';
					if( $SS->ID == $cur  || in_array($SS->ID, $cur)) $output .= ' selected="selected"';
					$output .= '>&mdash; '.$SS->post_title.'</option>'."\n";
				endforeach;
			endforeach;
		endforeach;
		return $output;
	}
	
	public function AdminBarMenu( $wp_admin_bar ){
		if ( !is_user_logged_in() )
		 	$wp_admin_bar->add_menu( array( 'title' => __( 'Log In', 'cmsify' ), 'href' => wp_login_url() ) );
		
	}
	public function AdminBarBottom() { ?>
	<style type="text/css">
		html { margin-top: 0px !important; }
		* html body { margin-top: 0px !important; }
		body.admin-bar #wphead, body.admin-bar #adminmenu {
			padding-top: 0;
		}
		body.admin-bar #footer, body.admin-bar #adminmenu  {
			padding-bottom: 28px;
		}
		#wpadminbar {
			top: auto !important;
			bottom: 0;
		}
		#wpadminbar .quicklinks .menupop ul {
			bottom: 28px;
		}
	</style>
	<?php 
	}
	public function AdminBarHideSettings() { ?>
		<style type="text/css">.show-admin-bar { display: none; }</style>
    <?php }
	public function AdminBarHideSearch() { ?>
		<style type="text/css">#adminbarsearch-wrap { display: none; }</style>
    <?php }
	
        
	function AdminBarCustomMenu() {
		global $wp_admin_bar;
		$menuhide = $this->proopts['adminbar_items'];
		foreach( $menuhide as $mh ):
			$wp_admin_bar->remove_menu($mh);
		endforeach;
		$plugins = explode(",", $this->proopts['adminbar_items']['plugins']);
		foreach( $plugins as $k => $mh ):
			$wp_admin_bar->remove_menu($mh);
		endforeach;
		
	}
	public function AdminBarAddItems() {
		global $wp_admin_bar;
		$new = $this->proopts['adminbar_new'];
		foreach( $new['title'] as $k=>$v ):
			if( $v ):
			$wp_admin_bar->add_menu( array(
				'parent' => $new['parent'][$k], // use 'false' for a root menu, or pass the ID of the parent menu
				//'id' => 'new_media', // link ID, defaults to a sanitized title value
				'title' => $new['title'][$k], // link title
				'href' => $new['href'][$k], //admin_url( 'media-new.php'), // name of file
				'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
			));
			endif;
		endforeach;
	}

	
	
	
}
$proFunc = new CMSifyProFunc;
endif;
?>