<div class="modal fade" id="lis_pro_comisiones" tabindex="-1" aria-labelledby="lis_pro_comisionesLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-fullscreen">
    <div class="modal-content">

      <div class="modal-header" style="background-color: #28548C; color:#ffffff;">
        <h4 class="modal-title" id="lis_pro_comisionesLabel">Editar comisiones</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

              <div class="row mb-4" id="fecha_edit_comi">
                
                  <div class="col-md-2">
                      <small>Id</small> 
                      <div class="input-group mb-2">
                          <span class="input-group-text basic_color_input">
                              <i class="fas fa-hand-holding-usd"></i>
                          </span>
                            <input type="text" class="form-control" id="id_vendedor" readonly style="font-weight: bold;">
                      </div>
                      
                      <input type="hidden" name="user_planilla" value="<?php echo $id_usuario;?>" id="user_planilla" class="form-control" readonly>

                      <small>Vendedor</small> 
                      <div class="input-group mb-2">
                          <span class="input-group-text basic_color_input">
                              <i class="fas fa-hand-holding-usd"></i>
                          </span>
                            <input type="text" class="form-control" id="usuario_vende" readonly style="font-weight: bold;">
                      </div>
                  </div>

                  <div class="col-md-4">
                        <small>Fecha inicial</small>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            <input type="datetime-local" class="form-control" placeholder="Fecha inicial" id="fecha_plani1" name="fecha_plani1">
                        </div>
                  </div>

                  <div class="col-md-4">
                      <small>Fecha final</small>
                      <div class="input-group mb-3">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          <input type="datetime-local" class="form-control" placeholder="Fecha final" id="fecha_plani2" name="fecha_plani2">
                      </div>
                  </div>
                  <div class="col-md-2">
                           <button type="button" class="btn btn-success" 
                                style="width: 100%; height: 100%;" id="editar_salario">
                                <img src="static/iconos/edit_salario.ico" alt="Exito" width="59" height="59">
                             &nbsp;&nbsp;&nbsp; Editar
                            </button> 
                  </div>

              </div>

        <div class="alert alert-success container_box" role="alert">

              <div class="table-responsive bordes_margen"> 
                    <table class='table table-bordered table-sm tabla_edit_planilla' id='tabla_edit_planilla' style="width: 100%; background-color: #ffffff;">
                        <thead class="table-secondary">
                        <tr align="center">
                            <th scope="col">Info</th>
                            <th scope="col"><i class="fa fa-key" aria-hidden="true"></i></th>
                            <th scope="col"><i class="fas fa-tags"></i> Neto</th>
                            <th scope="col"><i class="fas fa-tags"></i> Aplicado</th>
                            <th scope="col">Total_Fact</th>
                            <th scope="col">Capital_Vta</th>
                            <th scope="col">Caja</th>
                            <th scope="col">Estado_Vta</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Fecha_Fact</th>

                            <th scope="col">Actiones</th>
                        </tr>
                        </thead>
                        <tbody align="center">

                            <tfoot class="table-secondary">
                                <tr align="center">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                </tr>
                            </tfoot>
                        </tbody>
                    </table>                
              </div>

              <!----------------Datos debajo de la tabla------------------->
              <div class="row">
                        
                        <div class="col-md-3">
                            <!-------------- Input -------------->
                                <small>Utilidad b generada</small> 
                                <div class="input-group mb-2">
                                <span class="input-group-text basic_color_input">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </span>
                                <input type="text" class="form-control" id="ttl_utili_bru" readonly style="font-weight: bold;">
                                </div>
                            
                                <small>% de comisión</small> 
                                <div class="input-group mb-2">
                                <span class="input-group-text basic_color_input">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </span>
                                <select class="form-select select_comisiones" id="select_comisiones" style="font-weight: bold;">
          
                                </select>
                                <button type="button" class="btn btn-primary" id="comision_modal"><i class="fas fa-plus"></i></button>
                                </div>

                        </div>

                        <div class="col-md-3 mb-4">
                              <!-------------- Input -------------->
                                <small>Comisión vendedor</small> 
                                <div class="input-group mb-2">
                                <span class="input-group-text basic_color_input">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </span>
                                <input type="text" class="form-control" id="comi_vendedor" readonly style="font-weight: bold;">
                                </div>

                                <small>Salario</small>
                                <div class="input-group mb-2">
                                <span class="input-group-text basic_color_input">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </span>
                                <select class="form-select select_salario" style="font-weight: bold;">

                                </select>
                                <button type="button" class="btn btn-primary" id="salario_modal"><i class="fas fa-plus"></i></button>
                                </div>

                        </div>

                        <div class="col-md-3">
                              <!-------------- card info -------------->
                        <div class="card text-white bg-primary mb-3" style="max-width: 100%;" align="center">
                            <div class="card-header"><h5>Comisión de vendedor</h5></div>
                                <div class="card-body" style="color:#1D1D1D;">

                                        <h6 class="card-title">Porcentaje <i class="fas fa-sack-dollar"></i></h6>
                                
                                        <h4>
                                        <i class="fas fa-medal"></i>   
                                        <strong id="tota_salcomi"></strong>   
                                        <i class="fas fa-medal"></i>
                                        </h4>          
                                  
                                </div>
                        </div>
                        </div>

                        <div class="col-md-3">
                            <!-------------- card info -------------->
                        <div class="card text-white bg-primary mb-3" style="max-width: 100%;"  align="center">
                            <div class="card-header"><h5>Comisión administrativa</h5></div>
                                <div class="card-body" style="color:#1D1D1D;">

                                        <h6 class="card-title">Porcentaje <i class="fas fa-sack-dollar"></i></h6>

                                        <h4>
                                        <i class="fas fa-medal"></i>   
                                        <strong id="total_admin"></strong>   
                                        <i class="fas fa-medal"></i>
                                        </h4>          

                                </div>
                        </div>
                        </div>

              </div>
              <!----------------------------------------------------------->
        </div>

      </div>

      <div class="modal-footer" style="background-color: #28548C;">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>

    </div>
  </div>
</div>