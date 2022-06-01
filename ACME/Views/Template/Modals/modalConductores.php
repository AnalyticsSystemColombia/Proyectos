<!-- Modal -->
<div class="modal fade" id="modalFormConductor" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Conductor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="tile">
            <div class="tile-body">
              <form id="formConductor" name="formConductor">
                <input type="hidden" id="id" name="id" value="">
                <p class="text-primary">Todos los campos son obligatorios.</p>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Cèdula</label>
                        <input class="form-control valid validNumber" id="txtcedula" name="txtcedula" type="text" placeholder="Documento de identidad" required="">
                    </div>
                </div>

                <div class="form-row">
                     <div class="form-group col-md-6">
                        <label class="control-label">Nombres</label>
                        <input class="form-control valid validText" id="txtnombres" name="txtnombres" type="text" placeholder="Nombres" required="">
                    </div>
                      <div class="form-group col-md-6">
                        <label class="control-label">Apellidos</label>
                        <input class="form-control valid validText" id="txtapellido" name="txtapellido" type="text" placeholder="Apellidos" required="">
                      </div>
               </div>

               <div class="form-row">
                    <div class="form-group col-md-6">
                      <label class="control-label">Direcciòn</label>
                      <input class="form-control" id="txtdireccion" name="txtdireccion" type="text" placeholder="Direcciòn" required="">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="control-label">Telèfono</label>
                      <input class="form-control valid validNumber" id="txttelefono" name="txttelefono" type="text" placeholder="Telèfono" required="">
                    </div>
               </div>

                <div class="form-row">
                <div class="form-group col-md-6">
                      <label class="control-label">Ciudad</label>
                      <input class="form-control valid validText" id="txtciudad" name="txtciudad" type="text" placeholder="Ciudad" required="">
                    </div>
                      <div class="form-group col-md-6">
                          <label for="exampleSelect1">Estado</label>
                          <select class="form-control" id="listStatus" name="listStatus" required="">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                          </select>
                      </div>
                </div>
                <div class="tile-footer">
                  <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

