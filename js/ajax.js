function ajax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }

    if (!xmlhttp && typeof XMLHttpRequest != "undefined") {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function seleccionardiv(div) {
    var contenedor;
    switch (div) {
        case 1:
            contenedor = document.getElementById("contenedor");
            break;
    }
    return contenedor;
}

function buscar(opcion, div, id, op, parametrosExtra = {}) {
    let contenedor = seleccionardiv(div);
    let objetoajax = ajax();
    const jsonParametros = JSON.stringify(parametrosExtra);
    console.log(opcion, div, id, op, parametrosExtra);
    objetoajax.open("POST", "../php/vistas.php", true);
    let data = "opcion=" + encodeURIComponent(opcion) +
        "&id=" + encodeURIComponent(id) +
        "&operacion=" + encodeURIComponent(op) +
        "&parametros=" + encodeURIComponent(jsonParametros);
    objetoajax.onreadystatechange = function () {
        if (objetoajax.readyState === 4 && objetoajax.status === 200) {
            contenedor.innerHTML = objetoajax.responseText;
            const funcionesPorOpcion = {
                3: () => tendenciashistoricas(),
                4: () => pronosticos(),
                5: () => alertas(),
                6: () => reportes(),
                8: () => empleados(),
                9: () => filtrosAnalisis(),
                10: () => analizisVentasRendimientos(),
                11: () => comparativos(),
                12: () => operacionesReportes(),
                14: () => configuracionPromos(),
                15: () => registrosPromociones(),
                16: () => impactoPromociones(),
                17: () => generacionReportes()
            }
            if (funcionesPorOpcion[opcion]) {
                funcionesPorOpcion[opcion]();
            }
        }
    };
    objetoajax.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    objetoajax.send(data);
}

function tendenciashistoricas() {
    // Gráfica de tendencias históricas
    const trendChartCtx = document.getElementById('trendChart').getContext('2d');
    const trendChart = new Chart(trendChartCtx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Ventas Históricas',
                data: [120, 150, 180, 200, 220, 240],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            }
        }
    });

    // Gráfica de picos y caídas por categoría
    const peaksChartCtx = document.getElementById('peaksChart').getContext('2d');
    const peaksChart = new Chart(peaksChartCtx, {
        type: 'bar',
        data: {
            labels: ['Categoría 1', 'Categoría 2', 'Categoría 3'],
            datasets: [
                {
                    label: 'Picos de Ventas',
                    data: [300, 250, 400],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Caídas de Ventas',
                    data: [100, 80, 120],
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            }
        }
    });

    // Acción para aplicar análisis
    document.getElementById('applyAnalysis').addEventListener('click', () => {
        const analysisType = document.getElementById('analysisType').value;
        const numPeriods = document.getElementById('numPeriods').value;
        const categoryFilter = document.getElementById('categoryFilter').value;

        if (!numPeriods) {
            alert('Por favor, ingresa el número de periodos.');
            return;
        }

        alert(`Aplicando análisis: ${analysisType}, Periodos: ${numPeriods}, Categoría: ${categoryFilter}`);
        // Aquí puedes añadir la lógica para aplicar los análisis
    });/**/
}

function pronosticos() {
    // Generar pronósticos (simulado)
    document.getElementById('generateForecast').addEventListener('click', () => {
        const selectedCategories = Array.from(document.querySelectorAll('#categoryForm .form-check-input:checked'))
            .map(input => input.value);

        if (selectedCategories.length === 0) {
            alert('Por favor, selecciona al menos una categoría.');
            return;
        }

        // Simular generación de datos para la tabla y la gráfica
        const forecastData = {
            "Categoria 1": [100, 120, 130, 140, 150, 160],
            "Categoria 2": [200, 210, 230, 240, 250, 260],
            "Categoria 3": [300, 310, 320, 330, 340, 350]
        };

        // Actualizar la tabla
        const tableBody = document.getElementById('forecastTableBody');
        tableBody.innerHTML = '';
        selectedCategories.forEach(category => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${category}</td>
                ${forecastData[category].map(value => `<td>${value}</td>`).join('')}
            `;
            tableBody.appendChild(row);
        });

        // Actualizar la gráfica
        const forecastChartCtx = document.getElementById('forecastChart').getContext('2d');
        new Chart(forecastChartCtx, {
            type: 'line',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                datasets: selectedCategories.map(category => ({
                    label: `${category} (Pronóstico)`,
                    data: forecastData[category],
                    borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                    borderWidth: 2,
                    fill: false
                }))
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    });
}

function alertas() {
    // Guardar configuración de alertas
    document.getElementById('saveAlertConfig').addEventListener('click', () => {
        const thresholdMin = document.getElementById('thresholdMin').value;
        const thresholdMax = document.getElementById('thresholdMax').value;
        const notificationType = document.getElementById('notificationType').value;

        if (!thresholdMin || !thresholdMax) {
            alert('Por favor, completa los umbrales mínimo y máximo.');
            return;
        }

        alert(`Configuración guardada:\n- Umbral Mínimo: ${thresholdMin}\n- Umbral Máximo: ${thresholdMax}\n- Notificación: ${notificationType}`);
        // Aquí puedes agregar la lógica para guardar esta configuración en tu sistema.
    });
}

function reportes() {
    // Simulación de datos de ejemplo para la gráfica
    const reportChartCtx = document.getElementById('reportChart').getContext('2d');
    const reportChart = new Chart(reportChartCtx, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [
                {
                    label: 'Categoría 1',
                    data: [100, 120, 150, 170, 180, 200],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Categoría 2',
                    data: [80, 90, 100, 110, 120, 130],
                    backgroundColor: 'rgba(255, 159, 64, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });

    // Botón para generar reporte (simulado)
    document.getElementById('generateReport').addEventListener('click', () => {
        const period = document.getElementById('reportPeriod').value;
        const category = document.getElementById('reportCategory').value;
        const product = document.getElementById('reportProduct').value;

        alert(`Reporte generado:\n- Periodo: ${period}\n- Categoría: ${category}\n- Producto: ${product || 'Todos los productos'}`);
        // Aquí puedes implementar la lógica para generar el reporte real.
    });

    // Botones para exportar gráficos
    document.getElementById('exportPDF').addEventListener('click', () => {
        alert('Función para exportar a PDF en desarrollo.');
        // Implementa tu lógica para exportar a PDF aquí.
    });

    document.getElementById('exportExcel').addEventListener('click', () => {
        alert('Función para exportar a Excel en desarrollo.');
        // Implementa tu lógica para exportar a Excel aquí.
    });
}

/**Servicio al cliente */
function empleados() {
    const dataTableBody = document.getElementById("dataTableBody");
    const saveDataBtn = document.getElementById("saveData");

    // Función para guardar datos manuales
    saveDataBtn.addEventListener("click", () => {
        const workShift = document.getElementById("workShift").value;
        const employeeName = document.getElementById("employeeName").value;
        const clientsServed = document.getElementById("clientsServed").value;
        const salesMade = document.getElementById("salesMade").value;

        if (!employeeName || !clientsServed || !salesMade) {
            alert("Por favor, completa todos los campos.");
            return;
        }

        // Agregar los datos a la tabla
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
                <td>${dataTableBody.rows.length}</td>
                <td>${workShift}</td>
                <td>${employeeName}</td>
                <td>${clientsServed}</td>
                <td>${salesMade}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editRow(this)">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Eliminar</button>
                </td>
            `;
        dataTableBody.appendChild(newRow);

        // Limpiar el formulario
        document.getElementById("captureForm").reset();
    });

    // Función para eliminar una fila
    function deleteRow(button) {
        button.parentElement.parentElement.remove();
    }

    // Función para editar una fila
    function editRow(button) {
        const row = button.parentElement.parentElement;
        const cells = row.children;

        document.getElementById("workShift").value = cells[1].textContent;
        document.getElementById("employeeName").value = cells[2].textContent;
        document.getElementById("clientsServed").value = cells[3].textContent;
        document.getElementById("salesMade").value = cells[4].textContent;

        row.remove();
    }

    // Simular carga masiva
    document.getElementById("uploadFile").addEventListener("click", () => {
        alert("Función de carga masiva en desarrollo.");
        // Aquí puedes implementar la lógica para procesar el archivo subido.
    });
}

function filtrosAnalisis() {
    // Aplicar filtros (simulación)
    document.getElementById('applyFilters').addEventListener('click', () => {
        const startDate = document.getElementById('filterStartDate').value;
        const endDate = document.getElementById('filterEndDate').value;
        const shift = document.getElementById('filterShift').value;
        const employee = document.getElementById('filterEmployee').value;
        const category = document.getElementById('filterCategory').value;
        const period = document.getElementById('filterPeriod').value;

        alert(`Filtros aplicados:\n- Fechas: ${startDate} a ${endDate}\n- Turno: ${shift}\n- Empleado: ${employee}\n- Categoría: ${category}\n- Periodo: ${period}`);
        // Aquí puedes implementar la lógica para filtrar los datos.
    });

    // Gráfica de actividad por turnos
    const activityChartCtx = document.getElementById('activityChart').getContext('2d');
    new Chart(activityChartCtx, {
        type: 'bar',
        data: {
            labels: ['Apertura', 'Intermedio', 'Cierre'],
            datasets: [{
                label: 'Ventas',
                data: [50, 30, 20],
                backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(255, 159, 64, 0.7)', 'rgba(255, 99, 132, 0.7)']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Gráfica de comparación entre empleados
    const employeeComparisonChartCtx = document.getElementById('employeeComparisonChart').getContext('2d');
    new Chart(employeeComparisonChartCtx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [
                {
                    label: 'Empleado A',
                    data: [10, 15, 20, 25, 30],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Empleado B',
                    data: [20, 25, 30, 35, 40],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
}

function analizisVentasRendimientos() {
    // Simulación de datos para gráficos
    const salesByShiftData = {
        labels: ['Apertura', 'Intermedio', 'Cierre'],
        datasets: [{
            label: 'Ventas',
            data: [50, 30, 20],
            backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)']
        }]
    };

    const salesByEmployeeData = {
        labels: ['Empleado A', 'Empleado B', 'Empleado C'],
        datasets: [{
            label: 'Proporción de Ventas',
            data: [40, 35, 25],
            backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(75, 192, 192, 0.7)']
        }]
    };

    const performanceTrendsData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
        datasets: [
            {
                label: 'Empleado A',
                data: [10, 15, 20, 25, 30],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            },
            {
                label: 'Empleado B',
                data: [20, 25, 30, 35, 40],
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false
            }
        ]
    };

    const clientsComparisonData = {
        labels: ['Clientes Atendidos', 'Clientes que Compraron'],
        datasets: [{
            label: 'Clientes',
            data: [100, 70],
            backgroundColor: ['rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)']
        }]
    };

    const employeeEffectivenessData = {
        labels: ['Empleado A', 'Empleado B', 'Empleado C'],
        datasets: [{
            label: 'Efectividad (%)',
            data: [80, 60, 90],
            backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)']
        }]
    };

    // Inicialización de gráficos
    new Chart(document.getElementById('salesByShiftChart'), { type: 'bar', data: salesByShiftData });
    new Chart(document.getElementById('salesByEmployeeChart'), { type: 'pie', data: salesByEmployeeData });
    new Chart(document.getElementById('performanceTrendsChart'), { type: 'line', data: performanceTrendsData });
    new Chart(document.getElementById('clientsComparisonChart'), { type: 'doughnut', data: clientsComparisonData });
    new Chart(document.getElementById('employeeEffectivenessChart'), { type: 'bar', data: employeeEffectivenessData });

    // Simulación de ventas totales por turno
    document.getElementById('aperturaSales').textContent = 50;
    document.getElementById('intermedioSales').textContent = 30;
    document.getElementById('cierreSales').textContent = 20;
}

function comparativos() {
    // Datos simulados
    const employeeData = [
        { name: "Empleado A", shift: "Apertura", clients: 100, sales: 80 },
        { name: "Empleado B", shift: "Intermedio", clients: 120, sales: 60 },
        { name: "Empleado C", shift: "Cierre", clients: 90, sales: 45 }
    ];

    const effectivenessTable = document.getElementById("effectivenessTable");
    const alertsList = document.getElementById("alertsList");

    // Cálculo de porcentaje de conversión y generación de alertas
    employeeData.forEach((employee) => {
        const conversionRate = ((employee.sales / employee.clients) * 100).toFixed(2);

        // Agregar fila a la tabla
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${employee.name}</td>
            <td>${employee.shift}</td>
            <td>${employee.clients}</td>
            <td>${employee.sales}</td>
            <td>${conversionRate}%</td>
            <td class="${conversionRate < 60 ? "low-performance" : "high-performance"}">
                ${conversionRate < 60 ? "Bajo Rendimiento" : "Alto Rendimiento"}
            </td>
        `;
        effectivenessTable.appendChild(row);

        // Generar alerta si el rendimiento es bajo
        if (conversionRate < 60) {
            const alertItem = document.createElement("li");
            alertItem.className = "list-group-item";
            alertItem.innerHTML = `
                <strong>${employee.name}:</strong> Rendimiento bajo en el turno ${employee.shift} (${conversionRate}% conversión). 
                <span class="text-danger">Sugerencia:</span> ${conversionRate < 50
                    ? "Capacitación en técnicas de venta."
                    : "Incentivos para mejorar su rendimiento."
                }
            `;
            alertsList.appendChild(alertItem);
        }
    });
}

function operacionesReportes() {
    // Función para exportar la tabla a PDF
    document.getElementById('exportPDF').addEventListener('click', () => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Título
        doc.text('Reporte de Ventas y Rendimiento', 10, 10);

        // Extraer tabla
        const table = document.getElementById('reportTable');
        let rows = [];
        for (let row of table.rows) {
            let cells = [];
            for (let cell of row.cells) {
                cells.push(cell.innerText);
            }
            rows.push(cells);
        }

        // Agregar tabla al PDF
        doc.autoTable({
            head: [rows[0]],
            body: rows.slice(1),
        });

        // Descargar PDF
        doc.save('reporte.pdf');
    });

    // Función para exportar la tabla a Excel
    document.getElementById('exportExcel').addEventListener('click', () => {
        const table = document.getElementById('reportTable');
        const workbook = XLSX.utils.table_to_book(table, { sheet: "Reporte" });
        XLSX.writeFile(workbook, "reporte.xlsx");
    });
}

/**Promociones */
function configuracionPromos() {
    const promotionTableBody = document.getElementById("promotionTableBody");

    // Guardar promoción
    document.getElementById("savePromotion").addEventListener("click", () => {
        const promoProduct = document.getElementById("promoProduct").value;
        const promoType = document.getElementById("promoType").value;
        const promoStartDate = document.getElementById("promoStartDate").value;
        const promoEndDate = document.getElementById("promoEndDate").value;
        const promoLimit = document.getElementById("promoLimit").value;
        const maxPerClient = document.getElementById("maxPerClient").value;
        const promoTag = document.getElementById("promoTag").value;

        if (!promoProduct || !promoType || !promoStartDate || !promoEndDate || !promoLimit || !maxPerClient) {
            alert("Por favor, completa todos los campos.");
            return;
        }

        const newRow = document.createElement("tr");
        newRow.innerHTML = `
        <td>${promotionTableBody.children.length + 1}</td>
        <td>${promoProduct}</td>
        <td>${promoType}</td>
        <td>${promoStartDate}</td>
        <td>${promoEndDate}</td>
        <td>${promoTag}</td>
        <td class="active-promotion">Activa</td>
        <td>
            <button class="btn btn-warning btn-sm" onclick="togglePromotion(this)">Desactivar</button>
        </td>
    `;

        promotionTableBody.appendChild(newRow);
        document.getElementById("promotionForm").reset();
        alert("Promoción guardada exitosamente.");
    });

    // Activar/Desactivar promoción
    function togglePromotion(button) {
        const row = button.parentElement.parentElement;
        const statusCell = row.cells[6];
        if (statusCell.classList.contains("active-promotion")) {
            statusCell.classList.remove("active-promotion");
            statusCell.classList.add("inactive-promotion");
            statusCell.textContent = "Inactiva";
            button.textContent = "Activar";
            button.classList.replace("btn-warning", "btn-success");
        } else {
            statusCell.classList.remove("inactive-promotion");
            statusCell.classList.add("active-promotion");
            statusCell.textContent = "Activa";
            button.textContent = "Desactivar";
            button.classList.replace("btn-success", "btn-warning");
        }
    }
}

function registrosPromociones() {
    // Aplicar filtros (simulación)
    document.getElementById('applyFilters').addEventListener('click', () => {
        const promotion = document.getElementById('filterPromotion').value;
        const product = document.getElementById('filterProduct').value;
        const startDate = document.getElementById('filterDateStart').value;
        const endDate = document.getElementById('filterDateEnd').value;

        alert(`Filtros aplicados:\n- Promoción: ${promotion}\n- Producto: ${product || "Todos"}\n- Fecha: ${startDate || "Inicio"} a ${endDate || "Fin"}`);
        // Aquí puedes implementar la lógica de filtrado real.
    });

    // Datos simulados para los gráficos
    const promotionComparisonData = {
        labels: ['Con Promoción', 'Sin Promoción'],
        datasets: [{
            label: 'Unidades Vendidas',
            data: [200, 150],
            backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(255, 99, 132, 0.7)']
        }]
    };

    const salesIncreaseData = {
        labels: ['Promoción 1', 'Promoción 2', 'Promoción 3'],
        datasets: [{
            label: 'Incremento en Ventas (%)',
            data: [20, 30, 15],
            backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(255, 159, 64, 0.7)', 'rgba(153, 102, 255, 0.7)']
        }]
    };

    // Inicialización de gráficos
    new Chart(document.getElementById('promotionComparisonChart'), { type: 'bar', data: promotionComparisonData });
    new Chart(document.getElementById('salesIncreaseChart'), { type: 'line', data: salesIncreaseData });
}

function impactoPromociones() {
    // Datos simulados para gráficos
    const salesImpactData = {
        labels: ['Antes', 'Durante', 'Después'],
        datasets: [{
            label: 'Ventas',
            data: [100, 150, 120],
            backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(75, 192, 192, 0.7)', 'rgba(255, 206, 86, 0.7)']
        }]
    };

    const salesTrendData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
        datasets: [{
            label: 'Tendencias de Ventas',
            data: [80, 90, 100, 150, 140],
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 2,
            fill: false
        }]
    };

    // Inicialización de gráficos
    new Chart(document.getElementById('salesImpactChart'), { type: 'bar', data: salesImpactData });
    new Chart(document.getElementById('salesTrendChart'), { type: 'line', data: salesTrendData });

    // Datos simulados para indicadores clave
    document.getElementById('salesIncrease').textContent = '25%';
    document.getElementById('totalSalesValue').textContent = '$50,000';
    document.getElementById('roiValue').textContent = '150%';
}

function generacionReportes() {
    // Gráfico de Comparativos de Ventas
    const promotionComparisonData = {
        labels: ['Promoción 1', 'Promoción 2', 'Promoción 3'],
        datasets: [{
            label: 'Unidades Vendidas',
            data: [150, 120, 90],
            backgroundColor: ['rgba(54, 162, 235, 0.7)', 'rgba(75, 192, 192, 0.7)', 'rgba(255, 206, 86, 0.7)']
        }]
    };

    const historicalTrendsData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
        datasets: [{
            label: 'Ventas',
            data: [80, 120, 100, 150, 130],
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 2,
            fill: false
        }]
    };

    // Inicializar Gráficos
    new Chart(document.getElementById('promotionComparisonChart'), { type: 'bar', data: promotionComparisonData });
    new Chart(document.getElementById('historicalTrendsChart'), { type: 'line', data: historicalTrendsData });
}
