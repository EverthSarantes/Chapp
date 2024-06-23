const table_selector = document.getElementById('table-selector');
const div_columns_selectors = document.getElementById('columns-selectors');
const condition_column_selector = document.getElementById('condition-column-selector');
const order_column_selector = document.getElementById('order-column-selector');
const order_selector = document.getElementById('order-selector');
const conditions_selector = document.getElementById('conditions-selector');
const conditions_container = document.getElementById('conditions-container');
const conditions_container_1 = document.getElementById('conditions-container-1');
const add_condition_button = document.getElementById('add-condition-button');
const submit_button = document.getElementById('submit-button');
const operator_column_selector = document.getElementById('operation-column-selector');
const operator_selector = document.getElementById('operation-selector');

const table_head = document.getElementById('table-head');
const table_head_buttons = document.getElementById('table-head-buttons');
const table_body = document.getElementById('table-body');

function setConditionsContainer(){
    if(conditions_selector.value == 0){
        conditions_container.classList.add('d-none');
        conditions_container.classList.remove('d-flex');
    }
    else{
        conditions_container.classList.remove('d-none');
        conditions_container.classList.add('d-flex');
    }
}
setConditionsContainer();
conditions_selector.addEventListener('change', setConditionsContainer);

function setOrderColumnSelector(){
    if(order_selector.value != ""){
        order_column_selector.disabled = false;
    }
    else{
        order_column_selector.disabled = true;
    }
}
setOrderColumnSelector();
order_selector.addEventListener('change', setOrderColumnSelector);

function addCondition(){
    let newCondition = conditions_container_1.cloneNode(true);
    let div = document.createElement('div');
    div.setAttribute('class', 'col-md-6 d-flex gap-1 align-items-center');
    let button = document.createElement('button');
    button.type = 'button';
    button.setAttribute('class', 'btn btn-secondary');
    button.innerHTML = 'Eliminar condición';
    button.addEventListener('click', () => {
        newCondition.remove();
    });
    div.appendChild(button);
    newCondition.appendChild(div);
    conditions_container.appendChild(newCondition);
}
add_condition_button.addEventListener('click', addCondition);

function setOperatorColumnSelector(){
    if(operator_selector.value != 'get' && operator_selector.value != 'first' && operator_selector.value != 'last' && operator_selector.value != 'sql'){
        operator_column_selector.disabled = false;
    }
    else{
        operator_column_selector.disabled = true;
    }
}
setOperatorColumnSelector();
operator_selector.addEventListener('change', setOperatorColumnSelector);

function setTablesNames(data){
    let tables = Object.values(data.data);
    for (let i = 0; i < tables.length; i++){
        let option = document.createElement('option');
        option.value = tables[i].name;
        option.innerHTML = tables[i].name;
        table_selector.appendChild(option);
    }
}

function getTablesNames(){
    makeRequest(api_url+'tables/names', 'GET', setTablesNames);
}
getTablesNames();

function setColumnsNames(data){
    div_columns_selectors.innerHTML = '';
    condition_column_selector.innerHTML = '';
    order_column_selector.innerHTML = '';
    operator_column_selector.innerHTML = '';
    document.querySelectorAll('.condition-column-selectors').forEach(input => {
        input.innerHTML = '';
    });
    let columns = Object.values(data.data);

    for (let i = 0; i < columns.length; i++){

        let div = document.createElement('div');
        div.setAttribute('class', 'col-md-3');

        let label = document.createElement('label');
        label.setAttribute('class', 'form-label d-flex gap-1 align-items-center');

        let input = document.createElement('input');
        input.type = 'checkbox';
        input.name = 'columns|'+columns[i].name;
        
        label.appendChild(input);

        let span = document.createElement('span');
        span.innerHTML = columns[i].name;
        label.appendChild(span);

        div.appendChild(label);
        div_columns_selectors.appendChild(div);

        let option = document.createElement('option');
        option.value = columns[i].name;
        option.innerHTML = columns[i].name;
        

        document.querySelectorAll('.condition-column-selectors').forEach(input => {
            let o = option.cloneNode(true);
            input.appendChild(o);
        });
        
        
        let option2 = option.cloneNode(true);
        order_column_selector.appendChild(option2); 

        let option3 = option.cloneNode(true);
        operator_column_selector.appendChild(option3);
    }
}

function getColumnsNames(){
    let table_name = table_selector.value;
    makeRequest(api_url+'tables/fields/'+table_name, 'GET', setColumnsNames);
}

table_selector.addEventListener('change', getColumnsNames);

function search(){
    document.getElementById('search-form').checkValidity();
    makeRequest(api_url+'search', 'post', showData, errorShowData, 'search-form', false);
}

function errorShowData(error){
    table_body.innerHTML = '';
    table_head.innerHTML = error;
}

function showData(data){
    try{
        let results = data.data;
        let columns = Object.keys(results[0]);
        let info = Object.values(results);
        table_head.innerHTML = '';
        table_body.innerHTML = '';
        table_head_buttons.innerHTML = '';

        let th2 = document.createElement('th');
        th2.innerHTML = 'Operaciones';
        table_head_buttons.appendChild(th2);

        let th1 = document.createElement('th');
        th1.innerHTML = '#';
        table_head.appendChild(th1);
        
        columns.forEach(column => {
            let th = document.createElement('th');
            th.innerHTML = column;
            table_head.appendChild(th);

            let th_button = document.createElement('th');
            let button = document.createElement('button');
            button.type = 'button';
            button.setAttribute('data-column', column);
            button.setAttribute('class', 'btn btn-primary btn-save-data');
            button.setAttribute('onclick', 'loadModalSaveDatos("'+column+'")');
            button.innerHTML = 'Guardar';
            th_button.appendChild(button);
            table_head_buttons.appendChild(th_button);
        });
        let count = 0;
        info.forEach(row => {
            let tr = document.createElement('tr');

            let td1 = document.createElement('td');
            td1.innerHTML = ++count;
            tr.appendChild(td1);

            columns.forEach(column => {
                let td = document.createElement('td');
                td.setAttribute('data-column', column);
                td.innerHTML = row[column];
                tr.appendChild(td);
            });
            table_body.appendChild(tr);
        });
    }
    catch(error){
        errorShowData('No se encontraron resultados');
        console.error(error);
    }
}
submit_button.addEventListener('click', search);