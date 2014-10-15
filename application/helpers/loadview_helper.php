<?php

// ga dipake krn page-nya refresh [kecuali unt welcome page]
function call_view($main_content, $data=null) {
	$CI =& get_instance();
	
	$data['header_menus'] = 'menus/header_menus'; 
	$data['main_content'] = $main_content;
	return $CI->load->view('includes/template', $data);
}


// 
function call_view_login($main_content, $data=null) {
	$CI =& get_instance();
		
	$data['main_content'] = $main_content;
	return $CI->load->view('includes/template_login', $data);
}