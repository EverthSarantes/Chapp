//datos academicos
function saveCarreraEstudiada(){
    if(document.getElementById('form_agregar_carrera_estudiada').reportValidity()){
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
            let dialog = document.getElementById('modal_agregar_carrera_estudiada');
            dialog.close();
        }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_agregar_carrera_estudiada');
    }
}
document.getElementById('btn_agregar_carrera_estudiada').addEventListener('click', saveCarreraEstudiada);

function deleteCarreraEstudiada(id){
    let url = local_api_url + 'info/academica/deleteCarreraEstudiada';
    makeRequest(url, 'POST', (result) => {
        let tr = document.getElementById('tr_carrera_estudiada_'+id);
        tr.remove();
    }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_delete_carrera_estudiada_'+id);
}

function saveCarreraPorEstudiar(){
    if(document.getElementById('form_agregar_carrera_por_estudiar').reportValidity()){
        let url = local_api_url + 'info/academica/addCarreraPorEstudiar';
        makeRequest(url, 'POST', (result) => {
            let tbody = document.getElementById('tbody_carreras_por_estudiar');
            let tr = document.createElement('tr');
            tr.id = 'tr_carrera_por_estudiar_'+result.data.id;
            tr.innerHTML = `
                <td>${result.data.nombre}</td>
                <td>${result.data.nivel_academico}</td>
                <td>${result.data.institucion}</td>
                <td>
                    <form id="form_delete_carrera_por_estudiar_${result.data.id}" method="post">
                        <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteCarreraPorEstudiar(${result.data.id})">Eliminar</button>
                    </form>
                </td>
            `;
            tbody.appendChild(tr);
            let dialog = document.getElementById('modal_agregar_carrera_por_estudiar');
            dialog.close();
        }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_agregar_carrera_por_estudiar');
    }
}

function deleteCarreraPorEstudiar(id){
    let url = local_api_url + 'info/academica/deleteCarreraPorEstudiar';
    makeRequest(url, 'POST', (result) => {
        let tr = document.getElementById('tr_carrera_por_estudiar_'+id);
        tr.remove();
    }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_delete_carrera_por_estudiar_'+id);
}
document.getElementById('btn_agregar_carrera_por_estudiar').addEventListener('click', saveCarreraPorEstudiar);

function saveHabilidad(){
    if(document.getElementById('form_agregar_habilidad').reportValidity()){
        let url = local_api_url + 'info/academica/addHabilidad';
        makeRequest(url, 'POST', (result) => {
            console.log(result);
            let tbody = document.getElementById('tbody_habilidades');
            let tr = document.createElement('tr');
            tr.id = 'tr_habilidad_'+result.data.id;
            tr.innerHTML = `
                <td>${result.data.nombre}</td>
                <td>${result.data.categoria.nombre}</td>
                <td>
                    <form id="form_delete_habilidad_${result.data.id}" method="post">
                        <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteHabilidad(${result.data.id})">Eliminar</button>
                    </form>
                </td>
            `;
            tbody.appendChild(tr);
            let dialog = document.getElementById('modal_agregar_habilidad');
            dialog.close();
        }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_agregar_habilidad');
    }
}

function deleteHabilidad(id){
    let url = local_api_url + 'info/academica/deleteHabilidad';
    makeRequest(url, 'POST', (result) => {
        let tr = document.getElementById('tr_habilidad_'+id);
        tr.remove();
    }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_delete_habilidad_'+id);
}

document.getElementById('btn_agregar_habilidad').addEventListener('click', saveHabilidad);

//datos laborales
function addProfesion(){
    if(document.getElementById('form_agregar_profesion').reportValidity()){
        let url = local_api_url + 'info/laboral/addProfesion';
        makeRequest(url, 'POST', (result) => {
            let tbody = document.getElementById('tbody_profesiones');
            let tr = document.createElement('tr');
            tr.id = 'tr_profesion_'+result.data.id;
            tr.innerHTML = `
                <td>${result.data.nombre}</td>
                <td>${result.data.categoria.nombre}</td>
                <td>
                    <form id="form_delete_profesion_${result.data.id}" method="post">
                        <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteProfesion(${result.data.id})">Eliminar</button>
                    </form>
                </td>
            `;
            tbody.appendChild(tr);
            let dialog = document.getElementById('modal_agregar_profesion');
            dialog.close();
        }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_agregar_profesion');
    }
}
document.getElementById('btn_agregar_profesion').addEventListener('click', addProfesion);

function deleteProfesion(id){
    let url = local_api_url + 'info/laboral/deleteProfesion';
    makeRequest(url, 'POST', (result) => {
        let tr = document.getElementById('tr_profesion_'+id);
        tr.remove();
    }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_delete_profesion_'+id);
}

function addTrabajo(){
    if(document.getElementById('form_agregar_trabajo').reportValidity()){
        let url = local_api_url + 'info/laboral/addTrabajo';
        makeRequest(url, 'POST', (result) => {
            let tbody = document.getElementById('tbody_trabajos');
            let tr = document.createElement('tr');
            tr.id = 'tr_trabajo_'+result.data.id;
            tr.innerHTML = `
                <td>${result.data.nombre}</td>
                <td>${result.data.categoria.nombre}</td>
                <td>${result.data.fecha_inicio}</td>
                <td>${result.data.fecha_fin}</td>
                <td>${result.data.institucion}</td>
                <td>
                    <form id="form_delete_trabajo_${result.data.id}" method="post">
                        <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteTrabajo(${result.data.id})">Eliminar</button>
                    </form>
                </td>
            `;
            tbody.appendChild(tr);
            let dialog = document.getElementById('modal_agregar_trabajo');
            dialog.close();
        }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_agregar_trabajo');
    }
}
document.getElementById('btn_agregar_trabajo').addEventListener('click', addTrabajo);

function deleteTrabajo(id){
    let url = local_api_url + 'info/laboral/deleteTrabajo';
    makeRequest(url, 'POST', (result) => {
        let tr = document.getElementById('tr_trabajo_'+id);
        tr.remove();
    }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_delete_trabajo_'+id);
}

function addProyecto(){
    if(document.getElementById('form_agregar_proyecto').reportValidity()){
        let url = local_api_url + 'info/laboral/addProyecto';
        makeRequest(url, 'POST', (result) => {
            let tbody = document.getElementById('tbody_proyectos');
            let tr = document.createElement('tr');
            tr.id = 'tr_proyecto_'+result.data.id;
            tr.innerHTML = `
                <td>${result.data.nombre}</td>
                <td>${result.data.categoria.nombre}</td>
                <td>${result.data.fecha_inicio}</td>
                <td>${result.data.fecha_fin}</td>
                <td>
                    <form id="form_delete_proyecto_${result.data.id}" method="post">
                        <input type="hidden" name="_token" value="${csrf}" autocomplete="off">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn rojo" onclick="if(confirm('¿Confirma Eliminar?'))deleteProyecto(${result.data.id})">Eliminar</button>
                    </form>
                </td>
            `;
            tbody.appendChild(tr);
            let dialog = document.getElementById('modal_agregar_proyecto');
            dialog.close();
        }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_agregar_proyecto');
    }
}

document.getElementById('btn_agregar_proyecto').addEventListener('click', addProyecto);

function deleteProyecto(id){
    let url = local_api_url + 'info/laboral/deleteProyecto';
    makeRequest(url, 'POST', (result) => {
        let tr = document.getElementById('tr_proyecto_'+id);
        tr.remove();
    }, (error)=>{alert('Ha ocurrido un error, por favor intentelo de nuevo')}, 'form_delete_proyecto_'+id);
}