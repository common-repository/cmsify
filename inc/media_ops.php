<h3><?php _e('Media Options', 'cmsify');?></h3>
                    <table class="form-table">
                    <tbody>
                    	<?php if( class_exists('CMSifyPro') ) echo $proOps->ProMediaOps(); ?>
                       <tr valign="top">
                            <th scope="row"><label><?php _e('Maximum Full Size', 'cmsify');?>:</label><br><small><?php _e('Set the maximum size your Media should save, this will replace your Full Size image.', 'cmsify');?></small></th>
                            
                            <td><label><?php _e('Height:', 'cmsify');?> <input type="text" name="cmsify[maxheight]" style="width:45px"  value="<?php echo $this->options["maxheight"];?>" /></label> <?php _e('px', 'cmsify');?>  &nbsp;
                             <label><?php _e('Width:', 'cmsify');?> <input type="text" name="cmsify[maxwidth]" style="width:45px"  value="<?php echo $this->options["maxwidth"];?>" /></label> <?php _e('px', 'cmsify');?> 
                            </td>
                            </tr>
                            <tr valign="top">
                            <th scope="row"><label><?php _e('Image Sizes', 'cmsify');?>:</label></th>
                            
                            <td>
                            
                                
                            
                            <?php if($this->options['sizes']['label']): foreach($this->options['sizes']['label'] as $k=>$l):?>
                            <div style="margin-bottom:2px;">
                            <label><?php _e('Label:', 'cmsify');?> <input type="text" name="cmsify[sizes][label][<?php echo $k;?>]" style="width:150px"  value="<?php echo $this->options["sizes"]["label"][$k];?>" /> <small><?php _e('(no spaces/special characters)', 'cmsify');?></small></label>  &nbsp;&nbsp; 
                             <label><?php _e('Height:', 'cmsify');?> <input type="text" name="cmsify[sizes][height][<?php echo $k;?>]" style="width:45px"  value="<?php echo $this->options["sizes"]["height"][$k];?>" /></label> <?php _e('px', 'cmsify');?>  &nbsp;
                             <label><?php _e('Width:', 'cmsify');?> <input type="text" name="cmsify[sizes][width][<?php echo $k;?>]" style="width:45px"  value="<?php echo $this->options["sizes"]["width"][$k];?>" /></label> <?php _e('px', 'cmsify');?>  &nbsp;
                             <label><input type="checkbox" class="checkbox" name="cmsify[sizes][crop][<?php echo $k;?>]" value="1" <?php if( $this->options["sizes"]["crop"][$k] == 1) echo 'checked="checked"';?> /> <?php _e('Crop', 'cmsify');?></label>  <a href="#Remove" title="<?php _e('Remove Image Size', 'cmsify');?>" class="ImageSizeRemove"><img src="<?php echo $this->PluginPath;?>imgs/remove.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Remove Image Size', 'cmsify');?>" /></a>
                            </div>
                            <?php endforeach; endif; ?>
                            <div id="ImageSizeRepeat">
                            <div style="margin-bottom:2px;" class="imagesizeitem">
                            <label><?php _e('Label:', 'cmsify');?> <input type="text" name="cmsify[sizes][label][1]" style="width:150px"  /> <small><?php _e('(no spaces/special characters)', 'cmsify');?></small></label> &nbsp;&nbsp; 
                             <label><?php _e('Height:', 'cmsify');?> <input type="text" name="cmsify[sizes][height][1]" style="width:45px"  /></label> <?php _e('px', 'cmsify');?>  &nbsp; 
                             <label><?php _e('Width:', 'cmsify');?> <input type="text" name="cmsify[sizes][width][1]" style="width:45px"  /></label> <?php _e('px', 'cmsify');?>  &nbsp; 
                             <label><input type="checkbox" class="checkbox" name="cmsify[sizes][crop][1]"  value="1" /> <?php _e('Crop', 'cmsify');?></label> <a href="" title="<?php _e('Remove Image Size', 'cmsify');?>" class="ImageSizeRemove"><img src="<?php echo $this->PluginPath;?>imgs/remove.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Remove Image Size', 'cmsify');?>" /></a>
                                </div>
                             </div>   
                            
                             <a href="" id="ImageSizeAdd" title="<?php _e('Add Another Size', 'cmsify');?>"><img src="<?php echo $this->PluginPath;?>imgs/add.png" style="height:16px;width:16px;vertical-align:middle" alt="<?php _e('Add Another Size', 'cmsify');?>" /></a>
                         
                            
                            <p><?php _e('New uploaded images will also be created with these sizes in addition to the usual, thumbnail, medium &amp; large.  You can use access these new images using the function <code>&lt;?php <a href="http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src" target="_blank">wp_get_attachment_image_src( $attachment_id, $size, $icon );</a> ?&gt; </code> where $size is the label you entered above.', 'cmsify');?></p>
                            <p><strong><a href="?page=cmsify&reimg=1" class="button"><?php _e('REBUILD ALL UPLOADED IMAGES', 'cmsify');?></a></strong></p>
                            </td>
                            </tr>
                       </tbody>
                     </table>