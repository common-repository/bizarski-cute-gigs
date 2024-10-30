<?php 

require_once("header.php"); 
$section_url = get_admin_url(false, "admin.php?page=cutegigs-admin"); 

$uploads = wp_upload_dir();
$baseurl = $uploads['baseurl'];

if($_POST['submit_cutegig'] == "Y") { 
	global $wpdb;
	$oldfile = $wpdb->get_var("SELECT poster FROM ".$wpdb->prefix."cutegigs WHERE id='".$id."'");
	$filename = $oldfile ? $oldfile : 'na.jpg';
	if(is_uploaded_file($_FILES['cutegigs_poster']['tmp_name'])) { 
		require_once("class.image.php");
		require_once("upload_image.php");
		$success = upload_image("cutegigs_poster");
		if(is_array($success)) { 
			$filename = $success[0];
			if($oldfile && $oldfile != "na.jpg") { 
			
				$upload_base = $uploads['basedir'];
			
				$path = $upload_base.CUTEGIGS_DIRS."posters".CUTEGIGS_DIRS.$oldfile;
				if(file_exists($path)){ 
					unlink($path);
				}
				$path = $upload_base.CUTEGIGS_DIRS."posters".CUTEGIGS_DIRS."thumbs".CUTEGIGS_DIRS.$oldfile;
				if(file_exists($path)){ 
					unlink($path);
				}
				$path = $upload_base.CUTEGIGS_DIRS."posters".CUTEGIGS_DIRS."sides".CUTEGIGS_DIRS.$oldfile;
				if(file_exists($path)){ 
					unlink($path);
				}
			}
		}
	}

	$data = array(
		'date' => $_POST['cutegigs_date'],
		'place' => $_POST['cutegigs_place'],
		'starttime' => $_POST['cutegigs_starttime'],
		'price' => $_POST['cutegigs_price'],
		'otherbands' => $_POST['cutegigs_otherbands'], 
		'poster' => $filename, 
		'button1_label' => $_POST['cutegigs_button1_label'], 
		'button1_url' => $_POST['cutegigs_button1_url'], 
		'button1_target' => $_POST['cutegigs_button1_target'], 
		'button2_label' => $_POST['cutegigs_button2_label'], 
		'button2_url' => $_POST['cutegigs_button2_url'], 
		'button2_target' => $_POST['cutegigs_button2_target'], 
		'button3_label' => $_POST['cutegigs_button3_label'], 
		'button3_url' => $_POST['cutegigs_button3_url'], 
		'button3_target' => $_POST['cutegigs_button3_target'], 
	);

	if($action == "edit") { 
		global $wpdb; 
		$wpdb->update($wpdb->prefix."cutegigs", $data, array("id"=>$id)); 		
		?>
		<div class="updated"><p><strong><?php _e('Successfully updated gig!'); ?></strong></p></div>
		<?php
	} else { 
		global $wpdb; 
		$wpdb->insert($wpdb->prefix."cutegigs", $data); 
		$newid = $wpdb->insert_id;
		$action = "";  ?>
		<div class="updated"><p><strong><?php _e('Successfully created new gig!'); ?></strong></p></div>
		<?php
	}

}

if($action == "trash") { 
	global $wpdb; 
	$oldfile = $wpdb->get_var("SELECT poster FROM ".$wpdb->prefix."cutegigs WHERE id='".$id."'");
	if($oldfile && $oldfile != "na.jpg") { 
		$upload_base = $uploads['basedir'];
	
		$path = $upload_base.CUTEGIGS_DIRS."posters".CUTEGIGS_DIRS.$oldfile;
		if(file_exists($path)){ 
			unlink($path);
		}
		$path = $upload_base.CUTEGIGS_DIRS."posters".CUTEGIGS_DIRS."thumbs".CUTEGIGS_DIRS.$oldfile;
		if(file_exists($path)){ 
			unlink($path);
		}
		$path = $upload_base.CUTEGIGS_DIRS."posters".CUTEGIGS_DIRS."sides".CUTEGIGS_DIRS.$oldfile;
		if(file_exists($path)){ 
			unlink($path);
		}
	}
	$wpdb->query("DELETE FROM ".$wpdb->prefix."cutegigs WHERE id='".$id."'"); 
	?>
	<div class="updated"><p><strong><?php _e('Successfully deleted gig!'); ?></strong></p></div>
	<?php
}

?>

<div class="wrap">

<div id="icon-link-manager" class="icon32"><br></div>

<?php 

switch($action) { 
	
	case("new") : 
	case("edit") : ?>
		<h2><?php echo  __( 'Cute Gigs' ); ?> - 
		<?php 
		
		global $wpdb;
		$row = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."cutegigs WHERE id='".$id."'");
		echo $action == "edit" ? __( 'Edit Gig' ) : __( 'New Gig' ); 
		 ?>
		</h2>
		<form name="cutegigs_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">	
		<input type="hidden" name="submit_cutegig" value="Y">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div class="stuffbox">
						<h3><?php echo  __( 'Gig Details' ); ?></h3>
						<div class="inside">
							<table class="links-table" cellpadding="0">
								<tbody>
								<tr>
									<th scope="row"><label for="cutegigs_date">* <?php echo __('Date'); ?></label></th>
									<td><input name="cutegigs_date" id="cutegigs_date" class="datepicker" size="100" value="<?php echo $row ? esc_attr(stripslashes($row->date)) : '' ?>" type="text"></td>
								</tr>
								<tr>
									<th scope="row"><label for="cutegigs_place">* <?php echo __('Location'); ?></label></th>
									<td><input name="cutegigs_place" id="cutegigs_place" size="100" value="<?php echo $row ? esc_attr(stripslashes($row->place)) : '' ?>" type="text"></td>
								</tr>
								<tr>
									<th scope="row"><label for="cutegigs_starttime">* <?php echo __('Start Time'); ?></label></th>
									<td><input name="cutegigs_starttime" id="cutegigs_starttime" size="100" value="<?php echo $row ? esc_attr(stripslashes($row->starttime)) : '' ?>" type="text"></td>
								</tr>
								<tr>
									<th scope="row"><label for="cutegigs_price">* <?php echo __('Price'); ?></label></th>
									<td><input name="cutegigs_price" id="cutegigs_price" size="100" value="<?php echo $row ? esc_attr(stripslashes($row->price)) : '' ?>" type="text"></td>
								</tr>
								<tr>
									<th scope="row"><label for="cutegigs_otherbands"><?php echo __('With'); ?></label></th>
									<td><textarea cols="40" rows="5" name="cutegigs_otherbands" id="cutegigs_otherbands"><?php echo $row ? stripslashes($row->otherbands) : '' ?></textarea></td>
								</tr>
								<tr>
									<th scope="row"><label for="cutegigs_poster"><?php echo __('Poster'); ?></label></th>
									<td>
									<input id="cutegigs_poster" type="file" name="cutegigs_poster"><br>
									<?php if($row) { if($row->poster) { ?><img alt="" style="float: right" src="<?php echo $baseurl.'/posters/thumbs/'.$row->poster; ?>"><?php } } ?>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="stuffbox">
						<h3><?php echo  __( 'Buttons (optional)'); ?></h3>
						<div class="inside">
							<table class="links-table" cellpadding="0">
								<tbody>
								<tr>
									<th scope="row"><label><?php echo __('Button 1'); ?></label></th>
									<td><label for="cutegigs_button1_label"><?php echo __('Text'); ?></label>
									<input name="cutegigs_button1_label" id="cutegigs_button1_label" size="64" value="<?php echo $row ? esc_attr(stripslashes($row->button1_label)) : '' ?>" type="text" style="width: 30%"> 
									&nbsp;<label for="cutegigs_button1_url"><?php echo __('URL'); ?></label>
									<input name="cutegigs_button1_url" id="cutegigs_button1_url" size="256" value="<?php echo $row ? esc_attr(stripslashes($row->button1_url)) : '' ?>" type="text" style="width: 40%">
									</td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>
									<input name="cutegigs_button1_target" id="cutegigs_button1_target" type="checkbox" value="1"<?php echo $row && $row->button1_target ? ' checked="checked"' : ''; ?>>&nbsp;
									<label for="cutegigs_button1_target"><?php echo __('Open link in new window'); ?></label>
									</td>
								</tr>
								<tr>
									<th scope="row"><label><?php echo __('Button 2'); ?></label></th>
									<td><label for="cutegigs_button2_label"><?php echo __('Text'); ?></label>
									<input name="cutegigs_button2_label" id="cutegigs_button2_label" size="64" value="<?php echo $row ? esc_attr(stripslashes($row->button2_label)) : '' ?>" type="text" style="width: 30%">
									&nbsp;<label for="cutegigs_button2_url"><?php echo __('URL'); ?></label>
									<input name="cutegigs_button2_url" id="cutegigs_button2_url" size="256" value="<?php echo $row ? esc_attr(stripslashes($row->button2_url)) : '' ?>" type="text" style="width: 40%"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>
									<input name="cutegigs_button2_target" id="cutegigs_button2_target" type="checkbox" value="1"<?php echo $row && $row->button2_target ? ' checked="checked"' : ''; ?>>&nbsp;
									<label for="cutegigs_button2_target"><?php echo __('Open link in new window'); ?></label>
									</td>
								</tr>
								<tr>
									<th scope="row"><label><?php echo __('Button 3'); ?></label></th>
									<td><label for="cutegigs_button3_label"><?php echo __('Text'); ?></label>
									<input name="cutegigs_button3_label" id="cutegigs_button3_label" size="64" value="<?php echo $row ? esc_attr(stripslashes($row->button3_label)) : '' ?>" type="text" style="width: 30%">
									&nbsp;<label for="cutegigs_button3_url"><?php echo __('URL'); ?></label>
									<input name="cutegigs_button3_url" id="cutegigs_button3_url" size="256" value="<?php echo $row ? esc_attr(stripslashes($row->button3_url)) : '' ?>" type="text" style="width: 40%"></td>
								</tr>
								<tr>
									<th scope="row">&nbsp;</th>
									<td>
									<input name="cutegigs_button3_target" id="cutegigs_button3_target" type="checkbox" value="1"<?php echo $row && $row->button3_target ? ' checked="checked"' : ''; ?>>&nbsp;
									<label for="cutegigs_button3_target"><?php echo __('Open link in new window'); ?></label>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
					
				</div>
					
				<div id="postbox-container-1" class="postbox-container">
					<div id="side-sortables" class="meta-box-sortables">
						<div id="linksubmitdiv" class="postbox">
							<div class="handlediv" title="Click to toggle"><br></div>
							<input type="hidden" name="submit_cute_agg" value="Y">
							<h3 class="hndle"><span>Save</span></h3>
							<div class="inside">
								<div class="submitbox" id="submitlink">

									<div id="major-publishing-actions">
										<?php if($action == "edit") { ?>
										<div id="delete-action">
											<?php $delete_params = array('action' => "trash", 'id' => $id); ?>
											<a class="submitdelete deletion" href="<?php echo add_query_arg($delete_params, $section_url); ?>"><?php echo __("Trash"); ?></a>
										</div>
										<?php } ?>

										<div id="publishing-action">
											<input name="save" class="button-primary" id="publish" accesskey="p" value="<?php echo __('Save'); ?>" type="submit">
										<div class="clear"></div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
					
			</div>

		</div>
		</form>
		<?php
		break; 
	default : ?>
	
		<h2>
		<?php echo  __( 'Cute Gigs' ); ?> - <?php echo  __( 'All Gigs' ); ?>
		<a class="add-new-h2" href="<?php echo add_query_arg($new_params, $section_url) ?>"><?php echo __('New Gig'); ?></a> 
		</h2>
				
		<br class="clear">

		<table class="wp-list-table widefat fixed posts" cellspacing="0">
			<thead>
			<tr>
				<th><?php echo __('Location'); ?></th>
				<th><?php echo __('Date'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php 
			global $wpdb;
			$res = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."cutegigs ORDER BY date DESC");
			foreach($res as $row) { 
				$edit_params = array('action' => "edit", 'id' => $row->id);
				$delete_params = array('action' => "trash", 'id' => $row->id);
				?>
				<tr>
					<td>
						<strong><?php echo stripslashes($row->place); ?></strong>
						<div class="row-actions">
							<span class="edit"><a href="<?php echo add_query_arg($edit_params, $section_url); ?>">Edit</a> | </span>
							<span class="trash"><a class="submitdelete" href="<?php echo add_query_arg($delete_params, $section_url); ?>">Trash</a></span>
						</div>
					</td>
					<td>
						<?php echo date("d F Y", strtotime($row->date)); ?>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	
		<?php 
		break; 
}

?>

</div>