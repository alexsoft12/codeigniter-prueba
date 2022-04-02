<!doctype html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
		  integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

	<title>Biblioteca</title>
</head>
<body>

<main>

	<div class="container-fluid">
		<header class="row mb-3">
			<div class="col-12">
				<h2>Gestión de Libros</h2>
			</div>
		</header>
		<div class="col-12">
			<div class="card-body">
				<div class="col-12 mb-3">

					<div class="card mb-2">

						<div class="card-body">
							<form class="form-inline" id="aplicarFiltro">

								<div class="form-group mx-sm-3 mb-2">
									<label for="search" class="mr-3">Filtrar por ISBN</label>
									<input type="text" class="form-control" id="search" name="search"
										   placeholder="ISBN">
								</div>
								<button type="submit" class="btn btn-primary mb-2">Aplicar Filtro</button>
							</form>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<button class="btn btn-primary btn-sm mb-3 float-right " id="agregarLibro" type="button">
								Agregar
							</button>

							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
									<tr>
										<th scope="col">SBN</th>
										<th scope="col">Título</th>
										<th scope="col">N° Ejemplares</th>
										<th scope="col">Nombre de Autor</th>
										<th scope="col">Nombre de Editorial</th>
										<th scope="col">Nombre del Tema</th>
										<th scope="col">Acciones</th>
									</tr>
									</thead>
									<tbody>

									<?php foreach ($books as $book) { ?>
										<!--<pre>
							<?php /*var_dump($book); */ ?>
								</pre>-->
										<tr>
											<td><span class="invisible"><?= $book->idLibro ?></span> <?= $book->ISBN ?>
											</td>
											<td><?= $book->Titulo ?></td>
											<td><?= $book->NumeroEjemplares ?></td>
											<td><?= $book->NombreAutor ?></td>
											<td><?= $book->NombreEditorial ?></td>
											<td><?= $book->NombreTema ?></td>
											<td>
												<button class="btn btn-warning btn-sm editar-libro" type="button">Editar
												</button>
												<button class="btn btn-danger btn-sm eliminar-libro" type="button">
													Eliminar
												</button>
											</td>
										</tr>
									<?php } ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer>

		<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			 aria-hidden="true"></div>
	</footer>

</main>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
-->

<script>
	// document ready
	$(document).ready(function () {

		let loc = window.location.href;
		let searchText = loc.split('search=');
		if (searchText.length > 1) {
			$('#search').val(searchText.slice(-1).join('.'))
		}


		$(document).on('submit', 'form#aplicarFiltro', function (e) {
			e.preventDefault()

			let url = new URL('<?= base_url('/books?') ?>');
			let searchValue = $('#search').val()
			let search_params = url.searchParams;
			search_params.set('search', searchValue);
			url.search = search_params.toString();
			let new_url = url.toString();
			if (searchValue) {
				$(location).attr('href', new_url);
			}
		})

		// add book
		$('#agregarLibro').click(function (e) {
			e.preventDefault()
			//var data = $(this).serialize();
			let url = '<?= base_url() ?>books/add';

			$.ajax({
				url: url,
				type: 'GET',
				success: (response) => {
					$('.modal-dialog').remove()
					$('#myModal').append(response).modal('show')
				}
			})

		})
		$(document).on('submit', 'form#guardarLibroForm', function (e) {
			e.preventDefault()

			var data = $(this).serialize();

			$.ajax({
				method: "POST",
				url: $(this).attr("action"),
				dataType: "json",
				data: data,
				success: function (response) {
					if (response.status) {
						$('div#myModal').modal('hide');
						$(location).attr('href', "<?= base_url('/books') ?>");


					}
				}
			});
		})
		// edit book by id
		$('.editar-libro').click(function (e) {
			e.preventDefault()
			let id = $(this).parent().parent().find('td:first').find('span:first').text();
			let url = '<?= base_url() ?>books/edit/' + id;

			$.ajax({
				url: url,
				type: 'GET',
				success: (response) => {
					$('.modal-dialog').remove()
					$('#myModal').append(response).modal('show')
				}
			})
		});

		// save book from form
		$(document).on('submit', 'form#editarLibroForm', function (e) {
			e.preventDefault()
			var data = $(this).serialize();

			$.ajax({
				method: "POST",
				url: $(this).attr("action"),
				dataType: "json",
				data: data,
				success: function (response) {
					if (response.status) {
						//alert(response.message)
						$('div#myModal').modal('hide');
						// redirect to /books
						$(location).attr('href', "<?= base_url('/books') ?>");


					}
				}
			});
		})


		// delete book by id (ajax)
		$('.eliminar-libro').click(function (e) {
			e.preventDefault()
			let id = $(this).parent().parent().find('td:first').find('span:first').text();
			let url = '<?= base_url() ?>books/delete/' + id;
			let row = $(this).parent().parent();


			Swal.fire({
				title: '¿Está seguro?',
				text: "¡No podrás revertir esto!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				confirmButtonText: '¡Sí, bórralo!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: url,
						type: 'POST',
						dataType: 'json',
						success: function (response) {
							if (response.status) {
								row.remove();
							}
						}
					});
				}
			})

		});

	});
</script>
</body>
</html>


