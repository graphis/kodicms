<?php defined('SYSPATH') or die('No direct access allowed.');

class Controller_System_Backend extends Controller_System_Template
{
	public $auth_required = array('administrator', 'developer', 'editor');
	
	/**
	 *
	 * @var Model_Navigation_Page 
	 */
	public $page;

	public function before()
	{
		$page = strtolower(substr(get_class($this), 11));
		Model_Navigation::add_section('Settings', __('General'),  'setting', array('administrator'), 100);
		Model_Navigation::add_section('Settings', __('Users'),    'user',    array('administrator'), 102);
		Model_Navigation::add_section('Design',   __('Layouts'),  'layout',  array('administrator','developer'), 100);
		Model_Navigation::add_section('Design',   __('Snippets'), 'snippet', array('administrator','developer'), 101);
		Model_Navigation::add_section('Content',  __('Pages'),    'page',    array('administrator','developer','editor'), 100);

		parent::before();
		$navigation = Model_Navigation::get();
		$this->page = Model_Navigation::$current;
		
		if($this->auto_render === TRUE)
		{
			$this->template->set_global(array(
				'page_body_id' => $this->get_path(),
				'page_name' => $page,
				'navigation' => $navigation,
				'page' => $this->page
			));
			
			$this->styles = array(
				ADMIN_RESOURCES . 'libs/jquery-ui/css/custom-theme/jquery-ui-1.8.16.custom.css',
				ADMIN_RESOURCES . 'libs/jgrowl/jquery.jgrowl.css',
				ADMIN_RESOURCES . 'css/common.css',
			);
			
			$this->scripts = array(
				ADMIN_RESOURCES . 'libs/jquery-1.8.0.min.js',
				ADMIN_RESOURCES . 'libs/jquery-ui/js/jquery-ui-1.8.23.custom.min.js',
				ADMIN_RESOURCES . 'libs/bootstrap/js/bootstrap.min.js',
				ADMIN_RESOURCES . 'libs/jgrowl/jquery.jgrowl_minimized.js',
				ADMIN_RESOURCES . 'js/backend.js'
			);
		}
	}
}