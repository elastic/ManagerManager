<?php

//---------------------------------------------------------------------------------
// mm_widget_template
// A template for creating new widgets
//--------------------------------------------------------------------------------- 
function mm_widget_template($fields, $other_param='defaultValue', $roles='', $templates='') {
	
	global $modx, $content, $mm_fields, $mm_url;
	$e = &$modx->Event;
	
	if (useThisRule($roles, $templates)) {
		
		// Your output should be stored in a string, which is outputted at the end
		// It will be inserted as a Javascript block (with jQuery), which is executed on document ready
		$output = '';		
		
		// if we've been supplied with a string, convert it into an array 
		$fields = makeArray($fields);
		
		// You might want to check whether the current page's template uses the TVs that have been
		// supplied, to save processing page which don't contain them
		
		// Which template is this page using?
		if (isset($content['template'])) {
			$page_template = $content['template'];
		} else {
			// If no content is set, it's likely we're adding a new page at top level. 
			// So use the site default template. This may need some work as it might interfere with a default template set by MM?
			$page_template = $modx->config['default_template']; 
		}
		
		$count = tplUseTvs($content['template'], $fields);
		if ($count == false) {
			return;
		}		
		
		
		
		// We always put a JS comment, which makes debugging much easier
		$output .= "//  -------------- Widget name ------------- \n";
		
		// We have functions to include JS or CSS external files you might need
		// The standard ModX API methods don't work here
		$output .= includeJs($mm_url . 'widgets/template/javascript.js');
		$output .= includeCss($mm_url . 'widgets/template/styles.css');
		
				
		// Do something for each of the fields supplied
		foreach ($fields as $targetTv) {
		
			// If it's a TV, we may need to map the field name, to what it's ID is.
			// This can be obtained from the mm_fields array
			$tv_id = $mm_fields[$targetTv]['fieldname'];
		
		}
		
	
	} // end if
	
	$e->output($output . "\n");	// Send the output to the browser
	
}

?>