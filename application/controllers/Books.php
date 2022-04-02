<?php

class Books extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
		$this->load->model('autor_model');
		$this->load->model('editorial_model');
		$this->load->model('tema_model');
		$this->load->model('actualizaciones_libro_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$q = $this->input->get('search');
		$data['books'] = $this->book_model->getAllBooks($q);
		$this->load->view('books/index', $data);
	}

	public function add()
	{
		$data['temas'] = $this->tema_model->temaForDropdown();
		$data['autores'] = $this->autor_model->autorForDropdown();
		$data['editoriales'] = $this->editorial_model->editorialForDropdown();

		$this->load->view('books/add', $data);
	}

	public function save()
	{
		$data = array(
			'ISBN' => $this->input->post('ISBN'),
			'Titulo' => $this->input->post('Titulo'),
			'NumeroEjemplares' => $this->input->post('NumeroEjemplares'),
			'idAutor' => $this->input->post('idAutor'),
			'idEditorial' => $this->input->post('idEditorial'),
			'idTema' => $this->input->post('idTema')
		);

		if ($this->book_model->save($data)) {
			$output = array('message' => 'Libro Agregado con éxito', 'status' => true);
		} else {
			$output = array('message' => 'Libro no agregado', 'status' => false);
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));

	}

	public function edit($id)
	{
		$data['temas'] = $this->tema_model->temaForDropdown();
		$data['autores'] = $this->autor_model->autorForDropdown();
		$data['editoriales'] = $this->editorial_model->editorialForDropdown();

		$data['book'] = $this->book_model->getBookByID($id);
		$this->load->view('books/edit', $data);
	}

	public function update($id)
	{

		$data = array(
			'ISBN' => $this->input->post('ISBN'),
			'Titulo' => $this->input->post('Titulo'),
			'NumeroEjemplares' => $this->input->post('NumeroEjemplares'),
			'idAutor' => $this->input->post('idAutor'),
			'idEditorial' => $this->input->post('idEditorial'),
			'idTema' => $this->input->post('idTema')
		);
		$before = $this->book_model->getBookByID($id);

		if ($this->book_model->updateBook($id, $data)) {
			$history = array(
				'idLibro' => $id,
				'ISBNAnterior' => $before->ISBN,
				'TituloAnterior' => $before->Titulo,
				'NumeroEjemplaresAnterior' => $before->NumeroEjemplares,
				'FechaModificacion' => date('Y-m-d H:i:s')
			);

			$this->actualizaciones_libro_model->save($history);
			$output = array('message' => 'Libro Actualizado con éxito', 'status' => true);
		} else {
			$output = array('message' => 'Libro no Actualizado', 'status' => false);
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
	}


	public function delete($id)
	{
		if ($this->book_model->deleteBookById($id)) {
			$output = array('message' => 'Libro eliminado con éxito', 'status' => true);
		} else {
			$output = array('message' => 'Libro no eliminado', 'status' => false);
		}
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
	}

}
