<?php 

require_once("header.php"); 

$section_url = get_admin_url(false, "admin.php?page=cutegigs-settings"); 

if($_POST['submit_cutegig'] == "Y") { 
	$cutegigs_thumb_w = $_POST['cutegigs_thumb_w'];
	update_option('cutegigs_thumb_w', $cutegigs_thumb_w);
	
	$cutegigs_thumb_h = $_POST['cutegigs_thumb_h'];
	update_option('cutegigs_thumb_h', $cutegigs_thumb_h);
	
	$cutegigs_side_w = $_POST['cutegigs_side_w'];
	update_option('cutegigs_side_w', $cutegigs_side_w);
	
	$cutegigs_side_h = $_POST['cutegigs_side_h'];
	update_option('cutegigs_side_h', $cutegigs_side_h);
	
	$cutegigs_cont_css = $_POST['cutegigs_cont_css'];
	update_option('cutegigs_cont_css', $cutegigs_cont_css);
	
	$cutegigs_but_css = $_POST['cutegigs_but_css'];
	update_option('cutegigs_but_css', $cutegigs_but_css);

	$cutegigs_but_css_h = $_POST['cutegigs_but_css_h'];
	update_option('cutegigs_but_css_h', $cutegigs_but_css_h);
} else { 
	$cutegigs_thumb_w = cutegigs_THUMB_WIDTH;

	$cutegigs_thumb_h = cutegigs_THUMB_HEIGHT;

	$cutegigs_side_w = cutegigs_SIDE_WIDTH;

	$cutegigs_side_h = cutegigs_SIDE_HEIGHT;

	$cutegigs_cont_css = cutegigs_CONT_CSS;
	
	$cutegigs_but_css = cutegigs_BUT_CSS;

	$cutegigs_but_css_h = cutegigs_BUT_CSS_H;
}

?>

<div class="wrap">

<div id="icon-options-general" class="icon32"><br></div>

		<h2><?php echo  __( 'Cute Gigs' ); ?> - 
		<?php echo __( 'Settings' ); ?>
		</h2>
		<form name="cutegigs_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">	
		<input type="hidden" name="submit_cutegig" value="Y">
		
			<h3><?php echo __('Image sizes'); ?></h3>

			<table class="form-table">
				<tbody>
				<tr>
					<th scope="row"><?php echo __('Poster Thumbnail size'); ?></th>
					<td>
					<label for="cutegigs_thumb_w"><?php echo __('Width'); ?></label>
					<input name="cutegigs_thumb_w" id="cutegigs_thumb_w" class="small-text" value="<?php echo esc_attr($cutegigs_thumb_w); ?>" type="text">
					<label for="cutegigs_thumb_h"><?php echo __('Height'); ?></label>
					<input name="cutegigs_thumb_h" id="cutegigs_thumb_h" class="small-text" value="<?php echo esc_attr($cutegigs_thumb_h); ?>" type="text">
					</td>
				</tr>
				<tr>
					<th scope="row"><?php echo __('Widget Poster size'); ?></th>
					<td>
					<label for="cutegigs_side_w"><?php echo __('Width'); ?></label>
					<input name="cutegigs_side_w" id="cutegigs_side_w" class="small-text" value="<?php echo esc_attr($cutegigs_side_w); ?>" type="text">
					<label for="cutegigs_side_h"><?php echo __('Height'); ?></label>
					<input name="cutegigs_side_h" id="cutegigs_side_h" class="small-text" value="<?php echo esc_attr($cutegigs_side_h); ?>" type="text">
					</td>
				</tr>
				</tbody>
			</table>
			
			<h3><?php echo __('Style settings'); ?></h3>
			
			<table class="form-table">
				<tbody>
				<tr>
					<th scope="row"><label for="cutegigs_cont_css"><?php echo __('Container style'); ?></label></th>
					<td><input name="cutegigs_cont_css" id="cutegigs_cont_css" size="100" value="<?php echo esc_attr($cutegigs_cont_css); ?>" type="text"><p class="description"><?php echo __('In CSS format. Example: width: 400px; background: #000; color: #fff;'); ?></p></td>
				</tr>
				<tr>
					<th scope="row"><?php echo __('Button style'); ?></th>
					<td>
					<label for="cutegigs_but_css"><?php echo __('Normal State'); ?></label>
					<input name="cutegigs_but_css" id="cutegigs_but_css" size="100" value="<?php echo esc_attr($cutegigs_but_css); ?>" type="text">
					</td>
				</tr>
				<tr>
					<th scope="row">&nbsp;</th>
					<td>
					<label for="cutegigs_but_css_h"><?php echo __('Mouse Over'); ?></label>
					<input name="cutegigs_but_css_h" id="cutegigs_but_css_h" size="100" value="<?php echo esc_attr($cutegigs_but_css_h); ?>" type="text">
					</td>
				</tr>
				</tbody>
			</table>

			<p class="submit">
			<input name="save" class="button-primary" id="publish" accesskey="p" value="<?php echo __('Save Changes'); ?>" type="submit">
			</p>
			
		</form>

</div>