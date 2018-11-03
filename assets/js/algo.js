trabajos = document.querySelector('#trabajos');

fetch('categoria/listar')
.then((res) => res.json())
.then((data) => {
	for (var i = data.length - 1; i >= 0; i--) {
		
		obtenerEmpleos(data[i].id_categoria, data[i].nombre);
		
	}
	
});

function obtenerEmpleos(idCategoria, nombre){
	fetch('empleo/listarc/' + idCategoria)
.then((res) => res.json())
.then((data) => {
	trabajos.innerHTML += `
	<a href=''> ${nombre} </a><br> 
 
	`;


	for (var i = data.length - 1; i >= 0; i--) {
	trabajos.innerHTML += `
<table class="table"> 
  <thead>
    <tr>
      <th scope="col">Ubicacion</th>
      <th scope="col">Posicion</th>
      <th scope="col">Compañia</th>
    </tr>
  </thead> 
   <tbody>
    <tr>
      <td>${data[i].ubicacion}</td>
      <td>${data[i].posicion}</td>
      <td>${data[i].compañia}</td>
    </tr>
     </tbody>
</table>
`;
	}
});
}