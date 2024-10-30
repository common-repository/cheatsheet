<?php
/*
Title: Page
Description: The code for the page.
Author: Hans Vedo, hans@cultivate.it
2010-02-25: Created
*/

// Capture a submitted form.
if(isset($_POST['cheatsheet_text'])){
	update_option('cheatsheet_text',$_POST['cheatsheet_text']);
}

// The cheat sheet text.
if(get_option('cheatsheet_text') == ''){
	$cheatsheet_text = 'Your cheat sheet is empty!';
}else{
	$cheatsheet_text = str_replace(Chr(10),'<br />',stripslashes(get_option('cheatsheet_text')));
}

// Build the editor.
ob_start();
	the_editor(stripslashes(get_option('cheatsheet_text')),'cheatsheet_text');
	$editor_html = ob_get_contents();
ob_end_clean();
?>