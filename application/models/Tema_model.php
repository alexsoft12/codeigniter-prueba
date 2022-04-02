<?php

class Tema_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function temaForDropdown()
	{
		$sql = "SELECT idTema, NombreTema FROM Tema";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
