<h3><?php _e('Administration Options', 'cmsify');?></h3>
                    <table class="form-table">
                    <tbody>
                    <?php if( class_exists('CMSifyPro') ) echo $proOps->ProAdminOps(); ?>
                       <tr valign="top">
                       <th scope="row"><label><?php _e('Upgrade Notifications', 'cmsify');?>:</label><br /><small><?php _e('Remove upgrade notifications for non-administrators', 'cmsify');?></small>
                       </th>
                            <td><label><input type="checkbox" value="1" name="cmsify[upgradenotice]" <?php if( $this->options['upgradenotice'] ) echo 'checked="checked"'; ?> /> <?php _e('Disable Upgrade Notice for Non-Admins', 'cmsify');?></label></td>
                        </tr>
                        
                       <tr valign="top">
                       <th scope="row"><label><?php _e('Dashboard Widgets', 'cmsify');?>:</label><br /><small><?php _e('Remove dashboard widgets from all users view', 'cmsify');?></small><br><?php echo $this->PreviewIMG('DashboardWidgets', __('Dashboard Widgets', 'cmsify'));?>
                       </th>
                            <td>
                                <div style="width:30%; margin-right:2%; float:left;"><h4><?php _e('Main Column', 'cmsify');?></h4><label><input type="checkbox" class="checkbox" name="cmsify[dashboard_widgets][normal][]" value="dashboard_right_now" <?php if( in_array('dashboard_right_now', $this->options['dashboard_widgets']['normal']) ) echo 'checked="checked"';?> /> <?php _e('Right Now', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[dashboard_widgets][normal][]" value="dashboard_recent_comments" <?php if( in_array('dashboard_recent_comments', $this->options['dashboard_widgets']['normal']) ) echo 'checked="checked"';?> /> <?php _e('Recent Comments', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[dashboard_widgets][normal][]" value="dashboard_incoming_links" <?php if( in_array('dashboard_incoming_links', $this->options['dashboard_widgets']['normal']) ) echo 'checked="checked"';?> /> <?php _e('Incoming Links', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[dashboard_widgets][normal][]" value="dashboard_plugins" <?php if( in_array('dashboard_plugins', $this->options['dashboard_widgets']['normal']) ) echo 'checked="checked"';?> /> <?php _e('Plugins', 'cmsify');?></label><br>
                                </div>
                                
                                <div style="width:30%; margin-right:2%; float:left;"><h4><?php _e('Side Column', 'cmsify');?></h4><label><input type="checkbox" class="checkbox" name="cmsify[dashboard_widgets][side][]" value="dashboard_quick_press" <?php if( in_array('dashboard_quick_press', $this->options['dashboard_widgets']['side']) ) echo 'checked="checked"';?> /> <?php _e('Quick Press', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[dashboard_widgets][side][]" value="dashboard_recent_drafts" <?php if( in_array('dashboard_recent_drafts', $this->options['dashboard_widgets']['side']) ) echo 'checked="checked"';?> /> <?php _e('Recent Drafts', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[dashboard_widgets][side][]" value="dashboard_primary" <?php if( in_array('dashboard_primary', $this->options['dashboard_widgets']['side']) ) echo 'checked="checked"';?> /> <?php _e('Primary Feed', 'cmsify');?></label><br>
                                 <label><input type="checkbox" class="checkbox" name="cmsify[dashboard_widgets][side][]" value="dashboard_secondary" <?php if( in_array('dashboard_secondary', $this->options['dashboard_widgets']['side']) ) echo 'checked="checked"';?> /> <?php _e('Secondary Feed', 'cmsify');?></label><br>
                                </div>
                                <div style="width:30%; margin-right:2%; float:left;"><h4><?php _e('Plugin Widgets', 'cmsify');?></h4>
                                <p><?php _e('Plugins that install dashboard widgets can be disabled below.  Get the value from the Dashboards Screen Options checkbox and enter them below - comma separated please.', 'cmsify');?></p>
                                <textarea name="cmsify[dashboard_widgets][plugins]" cols=20 rows=3 style="width:95%"><?php echo $this->options['dashboard_widgets']['plugins'];?></textarea>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- WIDGETS -->
                        
                        <tr valign="top">
                       <th scope="row"><label><?php _e('Widgets', 'cmsify');?>:</label><br /><small><?php _e('Remove widgets from users view', 'cmsify');?></small><br><?php echo $this->PreviewIMG('Widgets', __('Widgets', 'cmsify'));?></th>
                            <td>
                                <div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Archives" <?php if( in_array('WP_Widget_Archives', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Archives', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Calendar" <?php if( in_array('WP_Widget_Calendar', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Calendar', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Categories" <?php if( in_array('WP_Widget_Categories', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Categories', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Links" <?php if( in_array('WP_Widget_Links', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Links', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Meta" <?php if( in_array('WP_Widget_Meta', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Meta', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Pages" <?php if( in_array('WP_Widget_Pages', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Pages', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Recent_Comments" <?php if( in_array('WP_Widget_Recent_Comments', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Recent Comments', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Recent_Posts" <?php if( in_array('WP_Widget_Recent_Posts', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Recent Posts', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_RSS" <?php if( in_array('WP_Widget_RSS', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('RSS', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Search" <?php if( in_array('WP_Widget_Search', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Search', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Tag_Cloud" <?php if( in_array('WP_Widget_Tag_Cloud', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Tag Cloud', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Widget_Text" <?php if( in_array('WP_Widget_Text', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Text', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[widgets][]" value="WP_Nav_Menu_Widget" <?php if( in_array('WP_Nav_Menu_Widget', $this->options['widgets']) ) echo 'checked="checked"';?> /> <?php _e('Custom Menu', 'cmsify');?></label><br>
                             
                             </div>
                              <div style="clear:left;"><h4><?php _e('Plugin Widgets', 'cmsify');?></h4>
                                <p><?php _e('Plugins that install widgets can be disabled below.  Get the name of the class the plugin uses to extend WP_Widget and enter them below - comma separated please. (NOTE: This is not always reliable, as it works for some and not others)', 'cmsify');?></p>
                                <textarea name="cmsify[widgets][plugins]" cols=20 rows=3 style="width:95%"><?php echo $this->options['widgets']['plugins'];?></textarea>
                                </div>
                             </td>
                         </tr>
                         
                        
                        
                        <!-- POST COLUMNS -->
                        
                        <tr valign="top">
                       <th scope="row"><label><?php _e('Post Columns', 'cmsify');?>:</label><br /><small><?php _e('Remove post columns from the View All Posts panel for all users', 'cmsify');?></small><br><?php echo $this->PreviewIMG('PostColumns', __('Post Columns', 'cmsify'));?></th>
                            <td>
                                <div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_columns][]" value="author" <?php if( in_array('author', $this->options['post_columns']) ) echo 'checked="checked"';?> /> <?php _e('Author', 'cmsify');?></label><br>
                               <label><input type="checkbox" class="checkbox" name="cmsify[post_columns][]" value="categories" <?php if( in_array('categories', $this->options['post_columns']) ) echo 'checked="checked"';?> /> <?php _e('Categories', 'cmsify');?></label><br>
                               </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_columns][]" value="comments" <?php if( in_array('comments', $this->options['post_columns']) ) echo 'checked="checked"';?> /> <?php _e('Comments', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_columns][]" value="tags" <?php if( in_array('tags', $this->options['post_columns']) ) echo 'checked="checked"';?> /> <?php _e('Tags', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                 <label><input type="checkbox" class="checkbox" name="cmsify[post_columns][]" value="date" <?php if( in_array('date', $this->options['post_columns']) ) echo 'checked="checked"';?> /> <?php _e('Date', 'cmsify');?></label><br>
                        </div>
                        <!--<div style="width:30%; margin-right:2%; float:left;">
                                <p>Plugins that install additional columns can be disabled to the right.  Get the value from the View All Posts Screen Options checkbox and enter them below - comma separated please.</p></div>
                                <div style="width:30%; margin-right:2%; float:left;">
                                <textarea name="cmsify[post_columns_plugins]" cols=20 rows=3 style="width:95%"><?php echo $this->options['post_columns_plugins'];?></textarea>
                                </div>-->
                        
                        </td>
                        </tr>
                        
                         <!-- PAGE COLUMNS -->
                        
                        <tr valign="top">
                       <th scope="row"><label><?php _e('Page Columns', 'cmsify');?>:</label><br /><small><?php _e('Remove page columns from the View All Pages panel for all users', 'cmsify');?></small><br><?php echo $this->PreviewIMG('PageColumns', __('Page Columns', 'cmsify'));?></th></th>
                            <td>
                                <div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_columns][]" value="author" <?php if( in_array('author', $this->options['page_columns']) ) echo 'checked="checked"';?> /> <?php _e('Author', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_columns][]" value="comments" <?php if( in_array('comments', $this->options['page_columns']) ) echo 'checked="checked"';?> /> <?php _e('Comments', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_columns][]" value="date" <?php if( in_array('date', $this->options['page_columns']) ) echo 'checked="checked"';?> /> <?php _e('Date', 'cmsify');?></label><br>
                                
                        </div>
                        <!--<div style="width:30%; margin-right:2%; float:left;">
                                <p>Plugins that install additional columns can be disabled to the right.  Get the value from the View All Pages Screen Options checkbox and enter them below - comma separated please.</p></div>
                                <div style="width:30%; margin-right:2%; float:left;">
                                <textarea name="cmsify[page_columns_plugins]" cols=20 rows=3 style="width:95%"><?php echo $this->options['page_columns_plugins'];?></textarea>
                                </div> -->
                        
                        </td>
                        </tr>
                        
                        <!-- POST META -->
                        <tr valign="top">
                       <th scope="row"><label><?php _e('Post Meta Boxes', 'cmsify');?>:</label><br /><small><?php _e('Remove post meta boxes from the Edit Posts panel for all users', 'cmsify');?></small><br><?php echo $this->PreviewIMG('PostMetaBoxes', __('Post Meta Boxes', 'cmsify'));?></th></th>
                            <td>
                                <div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="postexcerpt" <?php if( in_array('postexcerpt', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Excerpt', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="trackbacksdiv" <?php if( in_array('trackbacksdiv', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Send Trackbacks', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="postcustom" <?php if( in_array('postcustom', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Custom Fields', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="commentstatusdiv" <?php if( in_array('commentstatusdiv', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Discussions', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="commentsdiv" <?php if( in_array('commentsdiv', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Comments', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="slugdiv" <?php if( in_array('slugdiv', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Slug', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="authordiv" <?php if( in_array('authordiv', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Author', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="revisionsdiv" <?php if( in_array('revisionsdiv', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Revisions', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="categorydiv" <?php if( in_array('categorydiv', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Categories', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[post_meta][]" value="tagsdiv-post_tag" <?php if( in_array('tagsdiv-post_tag', $this->options['post_meta']) ) echo 'checked="checked"';?> /> <?php _e('Post Tags', 'cmsify');?></label><br>
                                
                              </div><div style="width:30%; margin-right:2%; float:left;">
                                <p><?php _e('Plugins that install additional meta boxes can be disabled below.  Get the value from the Edit Posts Screen Options checkbox and enter them below - comma separated please.', 'cmsify');?></p>
                                
                                <textarea name="cmsify[post_meta_plugins]" cols=20 rows=3 style="width:95%"><?php echo $this->options['post_meta_plugins'];?></textarea>
                                </div>
                              </td>
                        </tr>
                        
                        <!-- PAGE META -->
                        <tr valign="top">
                       <th scope="row"><label><?php _e('Page Meta Boxes', 'cmsify');?>:</label><br /><small><?php _e('Remove page meta boxes from the Edit Page panel for all users', 'cmsify');?></small><br><?php echo $this->PreviewIMG('PageMetaBoxes', __('Page Meta Boxes', 'cmsify'));?></th></th>
                            <td>
                                <div style="width:30%; margin-right:2%; float:left;">
                                
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_meta][]" value="postcustom" <?php if( in_array('postcustom', $this->options['page_meta']) ) echo 'checked="checked"';?> /> <?php _e('Custom Fields', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_meta][]" value="commentstatusdiv" <?php if( in_array('commentstatusdiv', $this->options['page_meta']) ) echo 'checked="checked"';?> /> <?php _e('Discussions', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_meta][]" value="commentsdiv" <?php if( in_array('commentsdiv', $this->options['page_meta']) ) echo 'checked="checked"';?> /> <?php _e('Comments', 'cmsify');?></label><br>
                                
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_meta][]" value="slugdiv" <?php if( in_array('slugdiv', $this->options['page_meta']) ) echo 'checked="checked"';?> /> <?php _e('Slug', 'cmsify');?></label><br>
                                </div><div style="width:30%; margin-right:2%; float:left;">
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_meta][]" value="authordiv" <?php if( in_array('authordiv', $this->options['page_meta']) ) echo 'checked="checked"';?> /> <?php _e('Author', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_meta][]" value="revisionsdiv" <?php if( in_array('revisionsdiv', $this->options['page_meta']) ) echo 'checked="checked"';?> /> <?php _e('Revisions', 'cmsify');?></label><br>
                                <label><input type="checkbox" class="checkbox" name="cmsify[page_meta][]" value="pageparentdiv" <?php if( in_array('pageparentdiv', $this->options['page_meta']) ) echo 'checked="checked"';?> /> <?php _e('Page Attributes', 'cmsify');?></label><br>
                               
                                
                              </div><div style="width:30%; margin-right:2%; float:left;">
                                <p><?php _e('Plugins that install additional meta boxes can be disabled below.  Get the value from the Edit Page Screen Options checkbox and enter them below - comma separated please.', 'cmsify');?></p>
                                
                                <textarea name="cmsify[page_meta_plugins]" cols=20 rows=3 style="width:95%"><?php echo $this->options['page_meta_plugins'];?></textarea>
                                </div>
                        
                              </td>
                        </tr>
                        
    
                    </tbody>
                    </table>