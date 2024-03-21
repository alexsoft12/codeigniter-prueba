<?php

class Actualizaciones_libro_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function save($data)
	{
		return $this->db->insert('Actualizaciones_Libro', $data);
	}
}


