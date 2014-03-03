<?php 
//print '<pre>';
//print_r($form); 
//print '</pre>';
print render($form['name']);
print render($form['pass']);
print render($form['actions']['submit']); ?>
<div style="display:none"><?php print drupal_render_children($form); ?></div>

