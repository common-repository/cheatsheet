// On page load.
jQuery(document).ready(function(){
	// Click to edit.
	jQuery("a#click_to_edit").click(function(){
		jQuery("#cheatsheet_page").css("display","none");
		jQuery("#cheatsheet_form").css("display","");
		
		// Crank the height of the text field.
		jQuery("#cheatsheet_text_ifr").css("height","300px");
	});
	
	// Cancel
	jQuery("a#cancel_click_to_edit").click(function(){
		jQuery("#cheatsheet_page").css("display","");
		jQuery("#cheatsheet_form").css("display","none");
	});
})