function saveCarreraEstudiada(){
    if(document.getElementById('form_agregar_carrera_estudiada').reportValidity ()){
        let url = local_api_url + 'info/academica/addCarreraEstudiada';
        makeRequest(url, 'POST', (result) => {
            let tbody = document.getElementById('tbody_carreras_estudiadas');
            let tr = document.createElement('tr');
            tr.id = 'tr_carrera_estudiada_'+result.data.id;
            tr.innerHTML = `
                <td>${result.data.nombre}</td>
                <td>${result.data.nivel_academico}</td>
                <td>${result.data.institucion}</td>
                <td>
                    <form id="form_delete_carrera_estudiada_${result.data.id}" method="post">
                        <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteCarreraEstudiada(${result.data.id})">Eliminar</button>
                    </form>
                </td>
            `;
            tbody.appendChild(tr);
        }, null, 'form_agregar_carrera_estudiada');
    }
    let dialog = document.getElementById('modal_agregar_carrera_estudiada');
    dialog.close();
}
document.getElementById('btn_agregar_carrera_estudiada').addEventListener('click', saveCarreraEstudiada);

function deleteCarreraEstudiada(id){
    let url = local_api_url + 'info/academica/deleteCarreraEstudiada';
    makeRequest(url, 'POST', (result) => {
        let tr = document.getElementById('tr_carrera_estudiada_'+id);
        tr.remove();
    }, null, 'form_delete_carrera_estudiada_'+id);
}