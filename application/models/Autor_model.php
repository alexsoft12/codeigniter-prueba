<?php

class Autor_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function autorForDropdown()
	{
		$sql = "SELECT idAutor, NombreAutor FROM Autor";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
