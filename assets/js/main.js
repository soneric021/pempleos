//variables globales
trabajos = document.querySelector('#trabajos');
btnbuscar = document.getElementById("buscar");

//funciones globales
function post(url){
     options = {
        method: 'POST', // or 'PUT'
        body: JSON.stringify(data), // data can be `string` or {object}!
        headers:{
          'Content-Type': 'application/json'
        }
    }
}
//funcion para ir a un empleo en especifico
function irA(id, url, tipo,nombre){
    fetch(url + id)
    .then(res => res.json())
    .then(data=>{
    if(tipo=="empleo"){
        trabajos.innerHTML = `<div class="row">
        <div class="col-lg-8">
            <div id="contenido1">
                <h1> ${data.compañia}</h1>
                <h4> ${data.ubicacion}</h4>
                <hr>
                ${data.posicion} - ${data.tipo}
                <hr>
                <p>${data.descripcion}</p>
                <strong> Como aplicar?</strong>
                <p>Envia un correo a ${data.email}</p>
            </div>
        </div>
        <div class="col-lg=2">
        <div id="contenido2">
                ${data.foto}
                </div>
        </div>
    </div>`;
    console.log("empleo");
    }else if(tipo=="categoria"){
        trabajos.innerHTML = "Categorias: " + nombre;
        console.log(trabajos);
        genera_tabla(data, trabajos);
      
    }
   trabajos.innerHTML += "<a href=''>volver atras.. </a>";
    }).catch(err=>console.log(err));
}

// buscador
function buscar(){
    console.log(buscador.value);
    buscador = document.getElementById("buscador");
    fetch("empleo/buscar/" + buscador.value)
    .then(res => res.json())
    .then(data=>{
        trabajos.innerHTML = "<h1>Resultados de la busqueda... </h1>"
        if(data.length == 0){
            trabajos.innerHTML += "no hay resultados para tu busqueda..."
        }else{
            genera_tabla(data,trabajos);
        }
        trabajos.innerHTML += "<a href=''>volver atras.. </a>"
    }).catch(err=>console.log(err));
}
//generador de tablas automaticas
function genera_tabla(data = [], ap) {

    var body = document.getElementsByTagName("body")[0];
   

    var tabla   = document.createElement("table");
    var tblBody = document.createElement("tbody");
    var tblhead = document.createElement("thead");
    var hilerah = document.createElement("tr");
   
    heads = ["UBICACION", "POSICION", "COMPAÑIA"];

    //genera las cabeceras
    for(let i = 0; i< heads.length; i++){
        txtc = document.createTextNode(heads[i]);
        celd = document.createElement("th");
        celd.setAttribute("scope", "col");
        celd.appendChild(txtc);
        hilerah.appendChild(celd);
        tblhead.appendChild(hilerah);
    }
    //genera el body de la tabla
    for(let i = 0; i< data.length ; i++){
        var hilera = document.createElement("tr");
       hilera.setAttribute("onclick", `irA(${data[i].id_empleo},"empleo/listarid/", "empleo")`)
    for (var j = 0; j <= 2  ; j++) {
        //console.log(j);
        var celda = document.createElement("td");
        
        if(j == 0){
        var textoCelda = document.createTextNode(data[i].ubicacion);
        }else if(j == 1){
            var textoCelda = document.createTextNode(data[i].posicion);
        }else{
            var textoCelda = document.createTextNode(data[i].compañia);
        }
        celda.appendChild(textoCelda);
        hilera.appendChild(celda);
        
      }
      tblBody.appendChild(hilera);
    }
 
      

   
    tabla.appendChild(tblhead);
    tabla.appendChild(tblBody);
  
    ap.appendChild(tabla);
    
    tabla.setAttribute("border", "2");
    tabla.setAttribute("class", "table table-hover");
  }

//EVENTOS
window.addEventListener("load", function(){
    categorias = document.getElementById("categorias");
     fetch('categoria/listar')
    .then((res) => res.json())
    .then((data) => {
        for (var i = data.length - 1; i >= 0; i--) {
            
            obtenerEmpleos(data[i].id_categoria, data[i].nombre);
            categorias.innerHTML += `<option value="${data[i].id_categoria}" selected name="id_categoria">${data[i].nombre}</option>`;
            
        }
        
    });

    function obtenerEmpleos(idCategoria, nombre){
        fetch('empleo/listarc/' + idCategoria)
    .then((res) => res.json())
    .then((data) => {
        trabajos.innerHTML += `
        <a  onclick="irA(${idCategoria}, 'empleo/listarc/', 'categoria','${nombre}')"> ${nombre.toUpperCase()} </a><br> 
     
        `;
       
                genera_tabla(data, trabajos);
        
    });
    }
});
btnbuscar.addEventListener("click", function(){
    buscar();
});