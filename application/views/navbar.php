
<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
		</button> -->
		<h5 class="modal-title">Registro/Login</h5>
      </div>
      <div class="modal-body">
        <form action="usuario/registro" method="post" id="datos">
		
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Portal de Empleos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <form class="form-inline my-2 my-lg-0">
      <input id="buscador"  class="form-control mr-sm-2" type="search" placeholder="Buscar un trabajo" aria-label="Search">
      <button id="buscar"class="btn btn-outline-success my-2 my-sm-0" type="button">Buscar</button>
    </form>
    </ul>
    <ul>
   <?php
      if($this->session->userdata('login') == true){
        if($this->session->userdata('tipo') == 'user'){
          //barra de navegacion para usuario que te permite postularte para un trabajo
        }else if($this->session->userdata('tipo') == 'poster'){
          //barra de navegacion que te permita postear un trabajo
        }elseif ($this->session->userdata('tipo') == 'admin') {
            //barra de navegacion que te permita hacer DETO
        }
      }else{
        //la aplicacion en funcionamiento, los trabajos y demas
    
   ?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">
  login/registro
</button>
<?php   }?>

    </ul>
  </div>
</nav>