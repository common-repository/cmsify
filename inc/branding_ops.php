<h3><?php _e('Branding Options', 'cmsify');?></h3>
                    <table class="form-table">
                    <tbody>
                       
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Header Icon', 'cmsify');?>:</label></th>
                            <td><?php if($this->options['headericon']){ echo '<img src="'.$this->options['headericon'].'" alt="" width="16" height="16" />'; }?>	<input id="HeaderIcon" type="text" size="36" name="cmsify[headericon]" value="<?php echo $this->options['headericon'];?>" />	<input id="HeaderIconButton" type="button" value="Select/Upload New Icon" /> <br><small><?php _e('Upload or Select a 16x16 image to display instead of the WordPress icon in the Header area. (You can also type in a direct URL)', 'cmsify');?></small>
                            
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Footer Credits', 'cmsify');?>:</label></th>
                            <td><textarea  name="cmsify[footercredits]" id="footercredits" style="width:90%;height:100px;"><?php echo $this->options['footercredits'];?></textarea><br><small><?php _e('Enter any HTML text to display at the bottom of all admin panels.', 'cmsify');?></small>
                            
                            </td>
                        </tr>
                        
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Login Logo', 'cmsify');?>:</label></th>
                            <td><?php if($this->options['loginlogo']){ echo '<br><img src="'.$this->options['loginlogo'].'" alt="" /><br />'; }?><input id="LoginLogo" type="text" size="36" name="cmsify[loginlogo]" value="<?php echo $this->options['loginlogo'];?>" />	<input id="LoginLogoButton" type="button" value="Select/Upload New Logo" /> <input type="hidden" name="cmsify[loginlogoheight]" id="LoginLogoHeight" value="<?php echo $this->options['loginlogoheight'];?>"> <br><small><?php _e('Upload or Select an image to display instead of the WordPress logo in the wp-login.php page. (You can also type in a direct URL)', 'cmsify');?></small>
                            
                            </td>
                        </tr>
    
                    </tbody>
                    </table>