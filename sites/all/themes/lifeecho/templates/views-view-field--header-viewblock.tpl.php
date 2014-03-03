<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<?php
$youtube_video_url = '';
$video_pieces = '';
$custom_thumbnail_image = '';
$youtube_video_url = file_create_url($row->field_field_video_block[0]['rendered']['#file']->uri);
$video_pieces = explode('=',$youtube_video_url);
$custom_thumbnail_image = file_create_url($row->field_field_custom_youtube_thumbnail[0]['rendered']['#item']['uri']);

?>
<?php /*<div onclick="thevid=document.getElementById('thevideo'); thevid.style.display='block'; this.style.display='none'"><img src="<?php echo $custom_thumbnail_image; ?>" style="cursor:pointer" width="640" height="390" /></div><div id="thevideo" style="display:none">
<iframe height="390" frameborder="0" width="640" allowfullscreen="" src="//www.youtube.com/embed/<?php echo $video_pieces[1]; ?>?rel=0;autoplay=1" class="media-youtube-player"></iframe>
</div>*/ ?>
<iframe height="390" frameborder="0" width="640" allowfullscreen="" src="//www.youtube.com/embed/<?php echo $video_pieces[1]; ?>?rel=0;autoplay=0" class="media-youtube-player"></iframe>
