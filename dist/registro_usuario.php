<?php require_once "plantilla/parte_superior.html"?>
<!-------------------------------------------------------->
<link rel="stylesheet" type="text/css" href='static/css/estilo_registro_user.css'>
<br>
<!--------------------------------------------->
<div class="container-fluid animated fadeIn my-2">

<div class="row justify-content-center">
<div class="col-md-10"> <!----------Columna---------->
    <div class="card card1">
    <div class="card-header cardheader text-center">
    <h4> Registro de usuario </h4>
    </div>
    <div class="card-body cardbody">

            <form id="form_user" method="POST" name="form_user" enctype="multipart/form-data" autocomplete="off">

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!----------------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                            <i class="fas fa-user-plus"></i>&nbsp;Nombres</label>
                            <input type="text" value="" id="nombre_user" name="nombre_user" class="long form-control" placeholder="Nombre de Usuario" required>
                        </div>
                        <input type="hidden" value="<?php echo $usuario;?>" id="user_registro" name="user_registro" readonly>
                        <input type="hidden" value="add_user" id="opc_user" name="opc_user" readonly> 
                        <!-----------------------------------------------------> 
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                            <i class="fas fa-user-plus"></i>&nbsp;Apellidos</label>
                            <input type="text" value="" id="apellido_user" name="apellido_user" class="long form-control" placeholder="Apellido Usuario" required>
                        </div>
                        <!----------------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                            <i class="fas fa-user-plus"></i>&nbsp;Cedula</label>
                            <input type="text" value="" id="cedula_user" name="cedula_user" class="long form-control" placeholder="Apellido Usuario" required>
                        </div>
                        <!----------------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                            <i class="fas fa-user-plus"></i>&nbsp;Sexo</label>
                            <select class="tipo_user custom-select" id="sexo_user" name="sexo_user" required>
                            <option value="">Elige Sexo</opcion>
                            <option value="Femenino">Femenino</opcion>
                            <option value="Masculino">Masculino</opcion>   
                        </select>
                        </div>
                        <!----------------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                            <i class="fas fa-user-plus"></i>&nbsp;Direccion</label>
                            <input type="text" value="" id="direc_user" name="direc_user" class="long form-control" placeholder="Apellido Usuario" required>
                        </div>
                        <!----------------------------------------------------->
                    </div>

                    <div class="col-md-6">
                        <!----------------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                            <i class="fas fa-at"></i>&nbsp;Ingresa tu Email </label>
                            <input type="email" value="" id="correo_user" name="correo_user" class="long form-control" placeholder="email@example.com" required>
                        </div>
                        <!----------------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"><i class="fas fa-user"></i>&nbsp;Usuario de sesión</label>
                            <input type="text" value="" id="user" name="user" class="long form-control" placeholder="Usuario de inicio de sesión" required> 
                        

                        <!----------------------Foto fer perfil------------------------------->
                            <div class="input-group my-2">
                                <label class="input-group-text" for="foto_perfil"><i class="fas fa-cloud-upload fa-lg"></i></label>
                                <input type="file" class="form-control" name="foto_perfil" id="foto_perfil" required>
                            </div>
                        </div>
                        <!----------------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"><i class="fas fa-user-shield"></i>&nbsp;Permisos de Acceso</label>
                            <select class="tipo_user custom-select" id="tipo_user" name="tipo_user" required>
                                <option value="">Elige permiso de User</opcion>  
                                <option value="Admin">Administrador</opcion>
                                <option value="User">Usuario</opcion>
                           </select>
                        </div>
                        <!--------------------------------------------->
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"><i class="fas fa-key"></i></i>&nbsp;Contraseña</label>

                            <div class="input-group">
                            <input type="password" value="" id="cantraseña" name="cantraseña" class="long form-control" placeholder="Contraseña" required>
                            <div class="input-group-append">
                                <button id="show_password" class="btn btn-primary show_password" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash fa-lg icon"></span> </button>
                            </div>
                            </div>

                        </div>
                        <!-----------------------------------------------------> 
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label"><i class="fas fa-key"></i>&nbsp;Repite Contraseña </label>

                            <div class="input-group">
                            <input type="password" value="" id="repiter_con" name="repiter_con" class="long form-control" placeholder="Repite Contraseña" required>
                            <div class="input-group-append">
                                <button id="show_password" class="btn btn-primary show_password" type="button" onclick="mostrarPassword_repite()"> <span class="fa fa-eye-slash fa-lg rep_ico"></span> </button>
                            </div>
                            </div>

                        </div>
                                <!---------------Container----------------------------->
                    </div>
                </div>
            </div>
    </div>

    <div class="card-footer cardfooter text-muted" align="right">
                <div class="boton_center">
                <button type="submit" class="btn btn-primary show_password" id="btn_user">Guardar <i class="fas fa-save"></i></button>
                </div>
    </div>
            </form>

    </div>
</div> <!-----Fin-----Columna---------->
</div>

<div class="row justify-content-center">
<div class="col-md-10 my-5"> <!----------Columna---------->
<div class="alert alert-primary" role="alert">
    <div class="table-responsive">  
    <table id="tabla_gestion_user" class="table table-bordered table-condensed table-sm" style="width:100%; background-color: white;">
    
        <thead class="text-center">
            <tr class="he_table" align="center">
                    <th style="width: 25p;"></th>
                    <th scope="col">Id</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo_Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody align="center" class="animated fadeIn">

        </tbody>

    </table>
    </div>
</div><!-----Fin-----Columna---------->
</div>
</div>

</div>

<!-------------------------------------------------------->
<?php require_once "plantilla/parte_inferior.html"?>
<script src="static/js/registrar_user.js"></script>
<?php require_once "modales/modal_editaruser.php"?>
<?php require_once "modales/modal_reset_pass.php"?>
