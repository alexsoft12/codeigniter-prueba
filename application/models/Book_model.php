<?php

class Book_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function getAllBooks($q)
	{
		$this->db->select("idLibro, ISBN, Titulo, NumeroEjemplares, A.NombreAutor, E.NombreEditorial, T.NombreTema")
			->from("Libro")
			->join('Autor A ', 'A.idAutor = Libro.idAutor')
			->join('Editorial E ', 'E.idEditorial = Libro.idEditorial')
			->join('Tema T ', 'T.idTema = Libro.idTema')
			->like('ISBN', $q)
			->order_by('Libro.idLibro', 'desc');

		$query = $this->db->get();

		return $query->result();
	}

	public function deleteBookById($idLibro)
	{
		$sql = "delete from Libro where idLibro = ?";
		return $this->db->query($sql, array($idLibro));

	}

	public function save($data)
	{
		return $this->db->insert('Libro', $data);

	}

	public function getBookByID($idLibro)
	{
		$sql = "select * from Libro where idLibro = ?";

		$query = $this->db->query($sql, array($idLibro));
		return $query->row();
	}

	public function updateBook($id, $data)
	{
		$this->db->where('idLibro', $id);
		return $this->db->update('Libro', $data);
	}
}
