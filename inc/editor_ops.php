
<h3><?php _e('Editor Options', 'cmsify');?></h3>
                        <p><?php _e('CMSify recommends the <a href="http://wordpress.org/extend/plugins/tinymce-advanced/" target="_blank">TinyMCE Advanced</a> plugin for additional post/page editor functionality.', 'cmsify');?></p>
                       
                        <table class="form-table">
                    <tbody>
                    
                    <?php if( class_exists('CMSifyPro') ) echo $proOps->ProEditorOps(); ?>
                    	
                    	<tr valign="top">
                            <th scope="row"><label><?php _e('Custom Editor Stylesheet', 'cmsify');?>:</label></th>
                            <td><?php echo get_stylesheet_directory_uri();?>/<input type="text" name="cmsify[customstyle]" id="customstyle" value="<?php echo $this->options['customstyle'];?>"  /><br><small><?php _e('Create and upload a custom stylesheet with all style rules prefixed with <code>.mceContentBody</code> to your themes directory and enter the filename.', 'cmsify');?></small>
                            
                            </td>
                        </tr>
                        
                       <tr valign="top">
                            <th scope="row"><label><?php _e('TinyMCE Block Format Selections', 'cmsify');?>:</label></th>
                            <td><?php  if( !is_array($this->options['formats'] ) ){ $this->options['formats'] = array(''); }
                            ?>
                                <div style="width:30%; margin-right:2%; float:left;"><label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="p" <?php if( in_array('p', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Paragraph', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="h1" <?php if( in_array('h1', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Heading 1', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="h2" <?php if( in_array('h2', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Heading 2', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="h3" <?php if( in_array('h3', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Heading 3', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="h4" <?php if( in_array('h4', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Heading 4', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="h5" <?php if( in_array('h5', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Heading 5', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="h6" <?php if( in_array('h6', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Heading 6', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="address" <?php if( in_array('address', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Address', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="pre" <?php if( in_array('pre', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Preformatted', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="div" <?php if( in_array('div', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Div', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="blockquote" <?php if( in_array('blockquote', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Blockquote', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="dt" <?php if( in_array('dt', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Definition Term', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="dd" <?php if( in_array('dd', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Definition Description', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="code" <?php if( in_array('code', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Code', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[formats][]" value="samp" <?php if( in_array('samp', $this->options['formats']) ) echo 'checked="checked"';?> /> <?php _e('Code Sample', 'cmsify');?></label>
                                </div>
                            </td>
                         </tr>
                          <tr valign="top">
                            <th scope="row"><label><?php _e('TinyMCE Custom Font Sizes', 'cmsify');?>:</label></th>
                            <td>
                            
                                
                            
                            <?php if($this->options['fontsizes']['label']): foreach($this->options['fontsizes']['label'] as $k=>$l):?>
                            <div style="margin-bottom:2px;">
                            <label><?php _e('Label:', 'cmsify');?> <input type="text" name="cmsify[fontsizes][label][<?php echo $k;?>]" style="width:150px"  value="<?php echo $this->options["fontsizes"]["label"][$k];?>" /></label>  &nbsp;&nbsp; 
                             <label><?php _e('Value:', 'cmsify');?> <input type="text" name="cmsify[fontsizes][value][<?php echo $k;?>]" style="width:50px"  value="<?php echo $this->options["fontsizes"]["value"][$k];?>" /> <?php _e('(examples: 5px, 5em, small, .large)', 'cmsify');?></label>  
                             <a href="" title="<?php _e('Remove Font Size', 'cmsify');?>" class="FontSizeRemove"><img src="<?php echo $this->PluginPath;?>imgs/remove.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Remove Font Size', 'cmsify');?>" /></a>
                             
                             
                            </div>
                            <?php endforeach; endif; ?>
                            <div id="FontSizeRepeat">
                            <div style="margin-bottom:2px;" class="fontsizeitem">
                            <label><?php _e('Label:', 'cmsify');?> <input type="text" name="cmsify[fontsizes][label][1]" style="width:150px"  /></label> &nbsp;&nbsp; 
                             <label><?php _e('Value:', 'cmsify');?> <input type="text" name="cmsify[fontsizes][value][1]" style="width:50px"  /> <?php _e('(examples: 5px, 5em, small, .large)', 'cmsify');?></label> 
                             <a href="" title="<?php _e('Remove Font Size', 'cmsify');?>" class="FontSizeRemove"><img src="<?php echo $this->PluginPath;?>imgs/remove.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Remove Font Size', 'cmsify');?>" /></a>
                             
                                </div>

                            </div>
                             <a href="" id="FontSizeAdd" title="<?php _e('Add Another Size', 'cmsify');?>"><img src="<?php echo $this->PluginPath;?>imgs/add.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Add Another Size', 'cmsify');?>" /></a>
                            </td>
                          </tr>
                       </tbody>
                     </table>