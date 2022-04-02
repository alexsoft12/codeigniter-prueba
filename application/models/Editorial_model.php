<?php

class Editorial_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function editorialForDropdown()
	{
		$sql = "SELECT idEditorial, NombreEditorial FROM Editorial";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
