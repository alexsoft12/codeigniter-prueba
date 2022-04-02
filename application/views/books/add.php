<!-- Modal -->
<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<form action="<?php echo base_url('books/save') ?>" method="POST" id="guardarLibroForm">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar Libro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="ISBN">ISBN</label>
							<input type="text" class="form-control" id="ISBN" name="ISBN">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="Titulo">Titulo</label>
							<input type="text" class="form-control" id="Titulo" name="Titulo">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="NumeroEjemplares">N° Ejemplares</label>
							<input type="number" class="form-control" id="NumeroEjemplares" name="NumeroEjemplares">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="idAutor">Autor</label>
							<select class="form-control" id="idAutor" name="idAutor">
								<option>Seleccione un autor</option>
								<?php foreach ($autores as $autor) : ?>
									<option value="<?php echo $autor['idAutor'] ?>"><?php echo $autor['NombreAutor'] ?></option>
								<?php endforeach; ?>

							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="idEditorial">Editorial</label>
							<select class="form-control" id="idEditorial" name="idEditorial">
								<option>Seleccione una editorial</option>
								<?php foreach ($editoriales as $editorial) : ?>
									<option value="<?php echo $editorial['idEditorial'] ?>"><?php echo $editorial['NombreEditorial'] ?></option>
								<?php endforeach; ?>

							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="idTema">Temas</label>
							<select class="form-control" id="idTema" name="idTema">
								<option>Seleccione una editorial</option>
								<?php foreach ($temas as $tema) : ?>
									<option value="<?php echo $tema['idTema'] ?>"><?php echo $tema['NombreTema'] ?></option>
								<?php endforeach; ?>

							</select>
						</div>
					</div>


				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar Cambios</button>
			</div>
		</form>
	</div>
</div>

