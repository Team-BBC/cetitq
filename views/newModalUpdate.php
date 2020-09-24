<div class="modal fade" id="actualizarModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="functions/update.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="per" id="per">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Actualizar Hoja de Seguridad</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
				</div>

				<div class="modal-body">
					<label for="sustancia">Nombre de la Sustancia</label>
					<input type="text" name="sustancia", id="sustancia" class="form-control form-control-sm"><br>
					<br>
					<div class="custom-file">
						<label for="fichero">PDF</label>
						<input type="file" name="fichero" id="fichero" class="custom-file-input" accept=".PDF">
						<label class="custom-file-label" data-browse="Seleccionar">Escojer PDF nuevo</label> 
					</div>
					
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-warning" value="Actualizar">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
				</div>
			</form>
		</div>
	</div>
</div>
