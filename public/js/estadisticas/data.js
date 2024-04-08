const chart_container = document.getElementById('chart');
const load_chart_button = document.getElementById('load-chart-button');
let modal = new bootstrap.Modal(document.getElementById('modal_save_data'));
let modal_chart = new bootstrap.Modal(document.getElementById('modal_load_grafic'));
let modal_config = new bootstrap.Modal(document.getElementById('modal_config_grafic'));

let dataset = {
    labels: [],
    data: []
};

function resetLabels(){
    dataset.labels = [];
}

function resetData(){
    dataset.data = [];
}

function setLabels(data){
    data.forEach(row => {
        dataset.labels.push(row);
    });
}

function setData(data){
    data.forEach(row => {
        dataset.data.push(row);
    });
}

let chart;
function loadChart(){
    let type = document.getElementById('chart-type-selector').value;
    let title = document.getElementById('chart-title').value;
    let background_color = document.getElementById('chart-background-color').value;
    let elements_color = document.getElementById('chart-elements-color').value;
    let border_color = document.getElementById('chart-border-color').value;
    let font_color = document.getElementById('chart-font-color').value;

    document.getElementById('modal_load_graficModalLabel').innerHTML = title || 'Grafico';
    if(chart){
        chart.destroy();
    }

    const changeBackgroundColor = {
        id: 'customCanvasBackgroundColor',
        beforeDraw: (chart, args, options) => {
            const {ctx} = chart;
            ctx.save();
            ctx.globalCompositeOperation = 'destination-over';
            ctx.fillStyle = options.color || '#99ffff';
            ctx.fillRect(0, 0, chart.width, chart.height);
            ctx.restore();
        }
    };

    Chart.defaults.color = font_color || 'rgba(54, 162, 235, 1)';
    chart = new Chart(chart_container, {
        type: type || 'bar',
        data: {
            labels: dataset.labels,
            datasets: [{
                label: title || 'Grafico',
                data: dataset.data,
                borderWidth: 1,
                backgroundColor: elements_color || 'rgba(54, 162, 235, 0.2)',
                borderColor: border_color || 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                customCanvasBackgroundColor: {
                    color: background_color || '#ffffff',
                }
            },
        },
        plugins: [changeBackgroundColor],
    })
    modal_config.hide();
    modal_chart.show();
}

load_chart_button.addEventListener('click', loadChart);

function loadModalSaveDatos(column){
    document.getElementById('label-data-name').innerHTML = column;

    let modal_table_body = document.getElementById('modal-table-body');
    modal_table_body.innerHTML = '';

    let data_length = dataset.data.length;
    let labels_length = dataset.labels.length;
    let mayor = data_length > labels_length ? data_length : labels_length;

    for(let i = 0; i < mayor; i++){
        let tr = document.createElement('tr');

        let td1 = document.createElement('td');
        td1.innerHTML = dataset.labels[i] || '';
        tr.appendChild(td1);

        let td2 = document.createElement('td');
        td2.innerHTML = dataset.data[i] || '';
        tr.appendChild(td2);

        modal_table_body.appendChild(tr);
    }
    modal.show();
}

function getTableData(column){
    let data = [];
    let rows = document.querySelectorAll('td[data-column="'+column+'"]');
    rows.forEach(row => {
        data.push(row.innerHTML);
    });
    return data;
}

function saveData(){
    let data = getTableData(document.getElementById('label-data-name').innerHTML);
    let type = document.getElementById('data-type-selector').value;

    if(type == 'labels'){
        resetLabels();
        setLabels(data);
    }
    else if(type == 'values'){
        resetData();
        setData(data);
    }
    modal.hide();
}

document.getElementById('btn-save-data').addEventListener('click', saveData);

function downloadCanvasAsImage(canvas_id) {
    let canvas = document.getElementById(canvas_id);
    let link = document.createElement('a');
    link.download = 'canvas_image.png';
    link.href = canvas.toDataURL();

    link.click();
    link.remove();
}

document.getElementById('btn-download-canvas').addEventListener('click', () => {
    downloadCanvasAsImage('chart');
});