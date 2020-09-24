<div id="deleteModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="functions/delete.php" method="post">
        <input type="hidden" name="id" id="id">
        <div class="modal-header">
          <h4 class="modal-title">Borrar Sustancia</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>

        
        <div class="modal-body">
          <div id="txt" name="sustancia" class="font-weight-normal">
          </div>
          <p class="text-danger"><small>Esta accion no se puede deshacer</small></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-danger" value="Borrar">
        </div>
      </form>
    </div>
  </div>
</div>