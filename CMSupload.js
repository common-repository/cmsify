jQuery(document).ready(function($) {
var InputLoc = false;
$('#HeaderIconButton').click(function() {
 fieldID = '#HeaderIcon';
 formfield = jQuery(fieldID).attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&InputLoc=HeaderIcon');
 return false;
});
$('#LoginLogoButton').click(function() {
 fieldID = '#LoginLogo';
 heightID = '#LoginLogoHeight';
 formfield = jQuery(fieldID).attr('name');
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&InputLoc=LoginLogo');
 return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 imgheight = jQuery('img', html).attr('height');
 $(fieldID).val(imgurl);
 if( heightID ) $(heightID).val(imgheight);
 tb_remove();
}

});