<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends MY_Model
{
	public $table_name = 'base';
	
	public function __construct()
	{
		parent::__construct();
	}
	
}

/* file end */