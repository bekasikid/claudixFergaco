<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		/* Standard Libraries */
		$this->load->database();
		/* ------------------ */
		
		$this->load->helper('url'); //Just for the examples, this is not required thought for the library
		
		$this->load->library('image_CRUD');
	}
	
	function _home_output($output = null)
	{
		$this->load->view('home.php',$output);	
	}
	
	function index()
	{
		$this->_home_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}	
/*	
	function example1()
	{
		$image_crud = new image_CRUD();
		
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('url');
		$image_crud->set_table('example_1')
			->set_image_path('assets/uploads');
			
		$output = $image_crud->render();
		
		$this->_home_output($output);
	}
*/
	function img_tokoh()
	{
		$crud = new image_CRUD();
/*		
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('url');
		$image_crud->set_table('upload')
*/
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id_tokoh');
		$image_crud->set_url_field('url');
		$image_crud->set_title_field('title_url');
		$image_crud->set_table('tbl_tokohx')
		->set_ordering_field('priority_url')
		->set_image_path('assets/uploads');
		

			
		$output = $image_crud->render();
	
		$this->_home_output($output);
	}
	

}