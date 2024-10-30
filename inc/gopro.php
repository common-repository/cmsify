<?php if( !$this->isPro(false) || $_GET['test']): 
global $current_user;
 get_currentuserinfo();
$deets[] =  'firstnm='.$current_user->user_firstname;
$deets[] =  'lastnm='.$current_user->user_lastname;
$deets[] =  'email='.$current_user->user_email;
$domain = str_replace("http://", "", get_option("siteurl"));
$subfix = explode('.', $domain);
$t = count($subfix);
$domain = $subfix[$t-2].'.'.$subfix[$t-1];
$deets[] =  'domain='.$domain;
$deets[] = 'product=CMSify%20Pro';
?>
<h3><?php _e('Upgrade to CMSify Pro', 'cmsify');?></h3>
<p><?php _e('We\'ve given you plenty of free CMS options to play with, but there are even more features that can be added, tweaked and disabled!  Upgrade to CMSify Pro for even more control over your WordPress admin!<br><strong>Featuring</strong>:', 'cmsify');?></p>
<ol style="list-style-type:square">
	<li><strong><?php _e('Admin Notifications'); ?></strong> - <?php _e('Notify your Subscribers, Authors and Editors with a custom message on the top of every admin panel.  Once read, users can hide the message easily with a click and it won\'t reappear unless you want it to!', 'cmsify');?></li>
    <li><strong><?php _e('Admin Login Redirection'); ?></strong> - <?php _e('Send your Subscribers straight to the home page when logging in, then send your Authors right to the New Post panel - every role can have there own default landing page!', 'cmsify');?></li>
    <li><strong><?php _e('Media Re-Assign or Detach'); ?></strong> - <?php _e('Quickly set any media attachment to a new Post Parent from within the Media Library and the Upload panel or detach it completely.', 'cmsify');?></li>
    <li><strong><?php _e('Admin Bar Control'); ?></strong> - <?php _e('Complete control over the Admin Bar: Remove it completely, hide menu items, add your own menu items and more!', 'cmsify');?></li>
</ol>
<p><strong>Screenshots:</strong><br>
<?php echo $this->PreviewIMG('admin-pro', __('More Admin Options', 'cmsify'), 'float:left;width:150px;margin-right:10px;', 'pro');?>
<?php echo $this->PreviewIMG('adminbar-pro', __('A whole lot of Admin Bar Options', 'cmsify'), 'float:left;width:150px;margin-right:10px;', 'pro');?>
<?php echo $this->PreviewIMG('media-pro', __('Enable the Re-assign/Detach Media', 'cmsify'), 'float:left;width:150px;margin-right:10px;', 'pro');?>
<?php echo $this->PreviewIMG('attachto', __('The Media Re-assign in your Upload options', 'cmsify'), 'float:left;width:150px;margin-right:10px;', 'pro');?>
<br style="clear:left">
</p>
<p><a href="http://devbits.ca/premium-plugins/purchase-license?<?php echo implode('&amp;',$deets);?>" class="button" target="_blank"><?php _e('Get Your Pro License Now', 'cmsify');?></a></p>

<?php else: ?>
<h3><?php _e('Pro Settings', 'cmsify');?></h3>
<p><?php _e('Thank you for licensing CMSify!', 'cmsify');?></p>
<?php endif; ?>
                    <table class="form-table">
                    <tbody>
                       <tr valign="top">
                            <th scope="row"><label><?php _e('Pro License', 'cmsify');?>:</label></th>
                            <td>
                            	<input type="text" name="cmsify[prokey]" id="customstyle" value="<?php echo $this->options['prokey'];?>" style="width:250px"  /> <?php $this->isPro(1); ?>
                                <br><small><?php _e('Enter the License key that was generated for your domain here. <br>If you have any problems with your license, please <a href="admin.php?page=cmsify&debug=CMSifyPro">click here to debug</a> or <a href="http://devbits.ca/contact/">contact us</a> for help.', 'cmsify');?></small>
                               
                            </td>
                          
                       </tbody>
                     </table>