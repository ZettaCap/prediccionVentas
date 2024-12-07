<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Código 405: Método no permitido
    echo "Método no permitido.";
    exit;
}
if (!isset($_POST['opcion'])) {
    http_response_code(400); // Código 400: Petición incorrecta
    echo "Falta el parámetro 'opcion'.";
    exit;
}

switch ($opcion) {
    case 1:
        moduloVentas();
        break;
    case 2:
        frm_datosVenta();
        break;
    case 3:
        frm_analizizEstadisticos();
        break;
    case 4:
        generacion_pronosticos();
        break;
    case 5:
        alertas();
        break;
    case 6:
        reportes_desiciones();
        break;
    case 7:
        menu_servicioCliente();
        break;
    case 8:
        registroEmpleados();
        break;
    case 9:
        filtrosAnalisis();
        break;
    case 10:
        analizis_ventasRendimientos();
        break;
    case 11:
        comparativosEfectividad();
        break;
    case 12:
        reportes();
        break;
    case 13:
        menuPromocionEvaluacion();
        break;
    case 14:
        configuracionPromociones();
        break;
    case 15:
        registrosPromocion();
        break;
    case 16:
        impactoPromociones();
        break;
    case 17:
        generacionReportes();
        break;
}

function moduloVentas()
{ ?>
    <div class="container my-5">
        <h1 class="text-center mb-4">Módulo de Pronósticos de Venta</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Registro de datos históricos</h5>
                        <p class="card-text">Importa o ingresa datos históricos de ventas agrupados
                            por periodos.</p>
                        <a href="javascript:buscar(2, 1, 0, 0);" class="btn btn-primary">Registrar datos</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Análisis de datos</h5>
                        <p class="card-text">Accede a herramientas de análisis estadístico para
                            identificar patrones.</p>
                        <a href="javascript:buscar(3,1,0,0)" class="btn btn-secondary">Analizar datos</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Generación de pronósticos</h5>
                        <p class="card-text">Calcula pronósticos de ventas por categoría fácilmente.
                        </p>
                        <a href="javascript:buscar(4,1,0,0);" class="btn btn-success">Generar pronósticos</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de alertas</h5>
                        <p class="card-text">Configura alertas automáticas basadas en los
                            pronósticos.</p>
                        <a href="javascript:buscar(5,1,0,0)" class="btn btn-warning">Configurar alertas</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Genera reportes detallados con gráficos y descargas.
                        </p>
                        <a href="javascript:buscar(6,1,0,0)" class="btn btn-info">Generar reportes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }

function frm_datosVenta()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Registro de Datos Históricos</h2>
        <form>
            <div class="mb-4">
                <h4>Carga de Datos</h4>
                <label for="fileUpload" class="form-label">Subir archivo (CSV, Excel, etc.):</label>
                <input type="file" class="form-control" id="fileUpload" accept=".csv, .xlsx, .xls">
                <div class="form-text">Acepta archivos en formato CSV o Excel.</div>
            </div>
            <div class="mb-4">
                <h4>Ingreso Manual de Datos</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="dateInput" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" id="dateInput">
                    </div>
                    <div class="col-md-6">
                        <label for="salesAmount" class="form-label">Cantidad de Ventas:</label>
                        <input type="number" class="form-control" id="salesAmount"
                            placeholder="Ingrese la cantidad">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-secondary" id="addManualData">Agregar
                        Datos</button>
                </div>
            </div>
            <div class="mb-4">
                <h4>Visualización Previa</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Cantidad de Ventas</th>
                        </tr>
                    </thead>
                    <tbody id="dataPreview">
                        <tr>
                            <td colspan="3" class="text-center">No hay datos cargados aún.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mb-4">
                <h4>Agrupación por Periodos</h4>
                <label for="periodSelector" class="form-label">Seleccionar Periodo:</label>
                <select class="form-select" id="periodSelector">
                    <option value="diario">Diario</option>
                    <option value="semanal">Semanal</option>
                    <option value="mensual">Mensual</option>
                    <option value="trimestral">Trimestral</option>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-danger me-2">Limpiar</button>
                <button type="submit" class="btn btn-primary">Guardar Datos</button>
            </div>
        </form>
    </div>
<?php }


function frm_analizizEstadisticos()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Análisis Estadístico</h2>

        <div class="mb-5">
            <h4>Panel Visual de Datos</h4>
            <div class="row g-4">
                <div class="col-md-6">
                    <h5>Tendencias Históricas</h5>
                    <canvas id="trendChart"></canvas>
                </div>
                <div class="col-md-6">
                    <h5>Picos y Caídas por Categoría</h5>
                    <canvas id="peaksChart"></canvas>
                </div>
            </div>
        </div>

        <div>
            <h4>Herramientas de Análisis</h4>
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="analysisType" class="form-label">Técnica Estadística:</label>
                        <select class="form-select" id="analysisType">
                            <option value="promedio">Promedios Móviles</option>
                            <option value="regresion">Regresión Lineal</option>
                            <option value="estacional">Análisis Estacional</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="numPeriods" class="form-label">Número de Periodos:</label>
                        <input type="number" class="form-control" id="numPeriods"
                            placeholder="Ejemplo: 3">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="categoryFilter" class="form-label">Categoría:</label>
                        <select class="form-select" id="categoryFilter">
                            <option value="todas">Todas</option>
                            <option value="categoria1">Categoría 1</option>
                            <option value="categoria2">Categoría 2</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100"
                            id="applyAnalysis">Aplicar Análisis</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php }

function generacion_pronosticos()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Generación de Pronósticos</h2>

        <div class="mb-4">
            <h4>Selector de Categorías</h4>
            <form id="categoryForm" class="custom-checkbox-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Categoria 1"
                        id="category1">
                    <label class="form-check-label" for="category1">Categoría 1</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Categoria 2"
                        id="category2">
                    <label class="form-check-label" for="category2">Categoría 2</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="Categoria 3"
                        id="category3">
                    <label class="form-check-label" for="category3">Categoría 3</label>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" id="generateForecast">Generar
                        Pronósticos</button>
                </div>
            </form>
        </div>
        <div class="mb-4">
            <h4>Visualización del Pronóstico</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Enero</th>
                        <th>Febrero</th>
                        <th>Marzo</th>
                        <th>Abril</th>
                        <th>Mayo</th>
                        <th>Junio</th>
                    </tr>
                </thead>
                <tbody id="forecastTableBody">
                    <tr>
                        <td colspan="7" class="text-center">No se han generado pronósticos aún.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h4>Gráfica Comparativa</h4>
            <canvas id="forecastChart"></canvas>
        </div>
    </div>
<?php }

function alertas()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Gestión de Alertas</h2>

        <!-- Configuración de Alertas -->
        <div class="mb-5">
            <h4>Configuración de Alertas</h4>
            <form>
                <div class="row g-3">
                    <!-- Definir umbrales -->
                    <div class="col-md-6">
                        <label for="thresholdMin" class="form-label">Umbral Mínimo
                            (Faltantes):</label>
                        <input type="number" class="form-control" id="thresholdMin"
                            placeholder="Ejemplo: 10">
                    </div>
                    <div class="col-md-6">
                        <label for="thresholdMax" class="form-label">Umbral Máximo
                            (Excesos):</label>
                        <input type="number" class="form-control" id="thresholdMax"
                            placeholder="Ejemplo: 100">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <!-- Selección de notificaciones -->
                    <div class="col-md-12">
                        <label for="notificationType" class="form-label">Notificación:</label>
                        <select class="form-select" id="notificationType">
                            <option value="sistema">Mensaje en el Sistema</option>
                            <option value="email">Correo Electrónico</option>
                            <option value="sms">SMS</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" class="btn btn-primary" id="saveAlertConfig">Guardar
                        Configuración</button>
                </div>
            </form>
        </div>

        <!-- Panel de Alertas Activas -->
        <div>
            <h4>Panel de Alertas Activas</h4>
            <div id="alertsPanel">
                <!-- Ejemplo de alerta -->
                <div class="alert alert-priority-high d-flex justify-content-between align-items-center"
                    role="alert">
                    <div>
                        <strong>Alerta Alta:</strong> Categoría "Bebidas" está por debajo del umbral
                        (5 unidades).
                    </div>
                    <button class="btn btn-danger btn-sm">Reabastecer Inventario</button>
                </div>
                <div class="alert alert-priority-medium d-flex justify-content-between align-items-center"
                    role="alert">
                    <div>
                        <strong>Alerta Media:</strong> Categoría "Snacks" está cerca del umbral
                        máximo (95 unidades).
                    </div>
                    <button class="btn btn-warning btn-sm">Modificar Órdenes</button>
                </div>
                <div class="alert alert-priority-low d-flex justify-content-between align-items-center"
                    role="alert">
                    <div>
                        <strong>Alerta Baja:</strong> Categoría "Lácteos" tiene existencias estables
                        (50 unidades).
                    </div>
                    <button class="btn btn-success btn-sm">Ver Detalles</button>
                </div>
            </div>
        </div>
    </div>
<?php }

function reportes_desiciones()
{ ?>
    <div class="mb-5">
        <h4>Panel de Reportes</h4>
        <form id="reportForm" class="row g-3">
            <!-- Selección de periodo -->
            <div class="col-md-4">
                <label for="reportPeriod" class="form-label">Periodo:</label>
                <select class="form-select" id="reportPeriod">
                    <option value="diario">Diario</option>
                    <option value="semanal">Semanal</option>
                    <option value="mensual">Mensual</option>
                    <option value="anual">Anual</option>
                </select>
            </div>

            <!-- Selección de categoría -->
            <div class="col-md-4">
                <label for="reportCategory" class="form-label">Categoría:</label>
                <select class="form-select" id="reportCategory">
                    <option value="todas">Todas</option>
                    <option value="categoria1">Categoría 1</option>
                    <option value="categoria2">Categoría 2</option>
                    <option value="categoria3">Categoría 3</option>
                </select>
            </div>

            <!-- Selección de producto -->
            <div class="col-md-4">
                <label for="reportProduct" class="form-label">Producto:</label>
                <input type="text" class="form-control" id="reportProduct"
                    placeholder="Ejemplo: Producto A">
            </div>

            <!-- Botón para generar reporte -->
            <div class="col-12 mt-3 text-end">
                <button type="button" class="btn btn-primary" id="generateReport">Generar
                    Reporte</button>
            </div>
        </form>
    </div>

    <!-- Gráficas Interactivas -->
    <div>
        <h4>Gráficas Interactivas</h4>
        <div class="row">
            <div class="col-md-12">
                <canvas id="reportChart"></canvas>
            </div>
        </div>
        <div class="mt-3 text-end">
            <button class="btn btn-success me-2" id="exportPDF">Exportar a PDF</button>
            <button class="btn btn-secondary" id="exportExcel">Exportar a Excel</button>
        </div>
    </div>
<?php }


function menu_servicioCliente()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Servicio al Cliente</h2>

        <!-- Menú Principal -->
        <div class="mb-5">
            <h4>Menú Principal</h4>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Captura de Datos</h5>
                            <p class="card-text">Registra horarios, empleados y ventas realizadas
                                por turno.</p>
                            <button class="btn btn-primary" id="openCaptureForm" onclick="javascript:buscar(8,1,0,0);">Ir a Captura de Datos</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Filtros y Análisis</h5>
                            <p class="card-text">Filtra por empleados, fechas y turnos para análisis detallado.</p>
                            <button class="btn btn-secondary" id="openFiltersForm" onclick="javascript:buscar(9, 1, 0, 0)">Ir a Filtros y Análisis</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Gráficos y Reportes</h5>
                            <p class="card-text">Visualiza análisis de ventas y rendimientos en gráficas.</p>
                            <button class="btn btn-success" id="openGraphsForm" onclick="javascript:buscar(10, 1, 0, 0);">Ver Gráficas</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Comparativos de Efectividad</h5>
                            <p class="card-text">Mide la relación entre clientes atendidos y ventas
                                realizadas.</p>
                            <button class="btn btn-warning" id="openComparativesForm" onclick="javascript:buscar(11, 1, 0, 0);">Ver Comparativos</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Generacion de reportes</h5>
                            <p class="card-text">Descarga reportes en Excel o PDF.</p>
                            <button class="btn btn-success" id="openAlertsForm" onclick="javascript:buscar(12, 1, 0, 0);">Ir a reportes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }

function registroEmpleados()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Registro de Horarios, Empleados y Ventas</h2>
        <!-- Formulario de Captura de Datos -->
        <div class="mb-5">
            <h4>Formulario de Captura de Datos</h4>
            <form id="captureForm">
                <div class="row g-3">
                    <!-- Selección de Turno -->
                    <div class="col-md-4">
                        <label for="workShift" class="form-label">Turno de Trabajo:</label>
                        <select class="form-select" id="workShift">
                            <option value="apertura">Apertura</option>
                            <option value="intermedio">Intermedio</option>
                            <option value="cierre">Cierre</option>
                        </select>
                    </div>
                    <!-- Nombre del Empleado -->
                    <div class="col-md-4">
                        <label for="employeeName" class="form-label">Nombre del Empleado:</label>
                        <input type="text" class="form-control" id="employeeName"
                            placeholder="Nombre completo">
                    </div>
                    <!-- Registro de Ventas -->
                    <div class="col-md-4">
                        <label for="clientsServed" class="form-label">Clientes Atendidos:</label>
                        <input type="number" class="form-control" id="clientsServed"
                            placeholder="Número de clientes">
                    </div>
                    <div class="col-md-4">
                        <label for="salesMade" class="form-label">Ventas Realizadas:</label>
                        <input type="number" class="form-control" id="salesMade"
                            placeholder="Cantidad de ventas">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" id="saveData">Guardar
                        Datos</button>
                </div>
            </form>
        </div>

        <!-- Carga Masiva -->
        <div class="mb-5">
            <h4>Carga Masiva de Datos</h4>
            <form>
                <div class="mb-3">
                    <label for="fileUpload" class="form-label">Subir archivo (CSV, Excel):</label>
                    <input type="file" class="form-control" id="fileUpload" accept=".csv, .xlsx">
                </div>
                <button type="button" class="btn btn-secondary" id="uploadFile">Cargar
                    Archivo</button>
            </form>
        </div>

        <!-- Edición y Consulta de Datos -->
        <div>
            <h4>Consulta y Edición de Datos</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Turno</th>
                        <th>Empleado</th>
                        <th>Clientes Atendidos</th>
                        <th>Ventas Realizadas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="dataTableBody">
                    <tr>
                        <td colspan="6" class="text-center">No hay registros aún.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php }

function filtrosAnalisis()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Filtros para Análisis</h2>

        <!-- Selección de Datos -->
        <div class="mb-5">
            <h4>Selección de Datos</h4>
            <form id="filterForm" class="row g-3">
                <!-- Filtro por Fechas -->
                <div class="col-md-4">
                    <label for="filterStartDate" class="form-label">Fecha de Inicio:</label>
                    <input type="date" class="form-control" id="filterStartDate">
                </div>
                <div class="col-md-4">
                    <label for="filterEndDate" class="form-label">Fecha de Fin:</label>
                    <input type="date" class="form-control" id="filterEndDate">
                </div>

                <!-- Filtro por Turnos -->
                <div class="col-md-4">
                    <label for="filterShift" class="form-label">Turno:</label>
                    <select class="form-select" id="filterShift">
                        <option value="todos">Todos</option>
                        <option value="apertura">Apertura</option>
                        <option value="intermedio">Intermedio</option>
                        <option value="cierre">Cierre</option>
                    </select>
                </div>

                <!-- Filtro por Empleados -->
                <div class="col-md-6">
                    <label for="filterEmployee" class="form-label">Empleado:</label>
                    <input type="text" class="form-control" id="filterEmployee" placeholder="Nombre del empleado">
                </div>

                <!-- Filtro por Categoría -->
                <div class="col-md-6">
                    <label for="filterCategory" class="form-label">Categoría de Producto:</label>
                    <select class="form-select" id="filterCategory">
                        <option value="todas">Todas</option>
                        <option value="bebidas">Bebidas</option>
                        <option value="snacks">Snacks</option>
                        <option value="lácteos">Lácteos</option>
                    </select>
                </div>

                <!-- Filtro por Periodo -->
                <div class="col-md-4">
                    <label for="filterPeriod" class="form-label">Periodo:</label>
                    <select class="form-select" id="filterPeriod">
                        <option value="diario">Diario</option>
                        <option value="semanal">Semanal</option>
                        <option value="mensual">Mensual</option>
                        <option value="anual">Anual</option>
                    </select>
                </div>

                <!-- Botón para aplicar filtros -->
                <div class="col-md-12 mt-3 text-end">
                    <button type="button" class="btn btn-primary" id="applyFilters">Aplicar Filtros</button>
                </div>
            </form>
        </div>

        <!-- Comparativos Personalizados -->
        <div>
            <h4>Comparativos Personalizados</h4>
            <div class="row g-4">
                <!-- Turnos con mayor o menor actividad -->
                <div class="col-md-6">
                    <h5>Turnos con Mayor/Menor Actividad</h5>
                    <canvas id="activityChart"></canvas>
                </div>
                <!-- Comparación entre empleados -->
                <div class="col-md-6">
                    <h5>Comparación entre Empleados</h5>
                    <canvas id="employeeComparisonChart"></canvas>
                </div>
            </div>
        </div>
    </div>
<?php }

function analizis_ventasRendimientos()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Análisis de Ventas y Rendimientos</h2>

        <!-- Panel Visual Interactivo -->
        <div class="mb-5">
            <h4>Panel Visual Interactivo</h4>
            <div class="row g-4">
                <!-- Gráficos de Barras: Ventas por Turno -->
                <div class="col-md-6">
                    <h5>Ventas por Turno</h5>
                    <div class="chart-container">
                        <canvas id="salesByShiftChart"></canvas>
                    </div>
                </div>

                <!-- Gráficos de Pastel: Proporción de Ventas por Empleado -->
                <div class="col-md-6">
                    <h5>Proporción de Ventas por Empleado</h5>
                    <div class="chart-container">
                        <canvas id="salesByEmployeeChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-4">
                <!-- Gráficos de Líneas: Tendencias de Rendimiento -->
                <div class="col-md-12">
                    <h5>Tendencias de Rendimiento por Empleado</h5>
                    <div class="chart-container">
                        <canvas id="performanceTrendsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventas Totales por Turno -->
        <div class="mb-5">
            <h4>Ventas Totales por Turno</h4>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Apertura <span class="badge bg-primary rounded-pill" id="aperturaSales">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Intermedio <span class="badge bg-secondary rounded-pill"
                        id="intermedioSales">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Cierre <span class="badge bg-success rounded-pill" id="cierreSales">0</span>
                </li>
            </ul>
        </div>

        <!-- Comparación: Clientes Atendidos vs Clientes que Compraron -->
        <div class="mb-5">
            <h4>Clientes Atendidos vs. Clientes que Compraron</h4>
            <div class="chart-container">
                <canvas id="clientsComparisonChart"></canvas>
            </div>
        </div>

        <!-- Porcentaje de Efectividad por Empleado -->
        <div>
            <h4>Porcentaje de Efectividad por Empleado</h4>
            <div class="chart-container">
                <canvas id="employeeEffectivenessChart"></canvas>
            </div>
        </div>
    </div>
<?php }

function comparativosEfectividad()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Comparativos de Efectividad</h2>

        <!-- Relación Clientes-Ventas -->
        <div class="mb-5">
            <h4>Relación Clientes-Ventas</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Turno</th>
                        <th>Clientes Atendidos</th>
                        <th>Ventas Realizadas</th>
                        <th>Porcentaje de Conversión</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="effectivenessTable">
                    <tr>
                        <td>Empleado A</td>
                        <td>Apertura</td>
                        <td>100</td>
                        <td>80</td>
                        <td>80%</td>
                        <td class="high-performance">Alto Rendimiento</td>
                    </tr>
                    <tr>
                        <td>Empleado B</td>
                        <td>Intermedio</td>
                        <td>120</td>
                        <td>60</td>
                        <td>50%</td>
                        <td class="low-performance">Bajo Rendimiento</td>
                    </tr>
                    <tr>
                        <td>Empleado C</td>
                        <td>Cierre</td>
                        <td>90</td>
                        <td>45</td>
                        <td>50%</td>
                        <td class="low-performance">Bajo Rendimiento</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Alertas de Rendimiento -->
        <div>
            <h4>Alertas de Rendimiento</h4>
            <ul id="alertsList" class="list-group">
                <li class="list-group-item">
                    <strong>Empleado B:</strong> Rendimiento bajo en el turno Intermedio (50%
                    conversión). <span class="text-danger">Sugerencia:</span> Capacitación en
                    técnicas de venta.
                </li>
                <li class="list-group-item">
                    <strong>Empleado C:</strong> Rendimiento bajo en el turno Cierre (50%
                    conversión). <span class="text-danger">Sugerencia:</span> Incentivos para
                    mejorar su rendimiento.
                </li>
            </ul>
        </div>
    </div>
<?php }

function reportes()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Reportes y Exportación</h2>

        <!-- Generación de Reportes -->
        <div class="mb-5">
            <h4>Generación de Reportes</h4>
            <form id="reportForm" class="row g-3">
                <!-- Selección de Periodo -->
                <div class="col-md-6">
                    <label for="reportStartDate" class="form-label">Fecha de Inicio:</label>
                    <input type="date" class="form-control" id="reportStartDate">
                </div>
                <div class="col-md-6">
                    <label for="reportEndDate" class="form-label">Fecha de Fin:</label>
                    <input type="date" class="form-control" id="reportEndDate">
                </div>

                <!-- Botones de Generación -->
                <div class="col-md-12 mt-4 text-end">
                    <button type="button" class="btn btn-primary me-2" id="exportPDF">Exportar a
                        PDF</button>
                    <button type="button" class="btn btn-secondary" id="exportExcel">Exportar a
                        Excel</button>
                </div>
            </form>
        </div>

        <!-- Resumen por Empleado y Turno -->
        <div>
            <h4>Resumen por Empleado y Turno</h4>
            <table class="table table-striped table-bordered" id="reportTable">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Turno</th>
                        <th>Clientes Atendidos</th>
                        <th>Ventas Realizadas</th>
                        <th>Porcentaje de Conversión</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Empleado A</td>
                        <td>Apertura</td>
                        <td>100</td>
                        <td>80</td>
                        <td>80%</td>
                    </tr>
                    <tr>
                        <td>Empleado B</td>
                        <td>Intermedio</td>
                        <td>120</td>
                        <td>60</td>
                        <td>50%</td>
                    </tr>
                    <tr>
                        <td>Empleado C</td>
                        <td>Cierre</td>
                        <td>90</td>
                        <td>45</td>
                        <td>50%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php }


function menuPromocionEvaluacion()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Promoción y Evaluación</h2>

        <!-- Menú Principal -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Configuración de Promociones</h5>
                        <p class="card-text">Crear, editar y eliminar promociones asociadas a
                            productos.</p>
                        <button class="btn btn-primary" id="openConfigPromotions" onclick="javascript:buscar(14, 1, 0, 0);">Ir a
                            Configuración</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Registro de Ventas por Promoción</h5>
                        <p class="card-text">Consulta de ventas vinculadas a promociones activas.
                        </p>
                        <button class="btn btn-secondary" id="openPromotionSales" onclick="javascript:buscar(15, 1, 0, 0);">Ir a Registro de
                            Ventas</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Análisis del Impacto</h5>
                        <p class="card-text">Mide el efecto de las promociones en las ventas.</p>
                        <button class="btn btn-success" id="openImpactAnalysis" onclick="javascript:buscar(16, 1, 0, 0);">Ir a
                            Análisis</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Generar informes de desempeño por promoción.</p>
                        <button class="btn btn-info" id="openReports" onclick="javascript:buscar(17, 1, 0, 0);">Ir a Reportes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }

function configuracionPromociones()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Configuración de Promociones</h2>

        <!-- Formulario de Creación de Promociones -->
        <div class="mb-5">
            <h4>Crear Nueva Promoción</h4>
            <form id="promotionForm">
                <div class="row g-3">
                    <!-- Selección de Producto -->
                    <div class="col-md-6">
                        <label for="promoProduct" class="form-label">Producto:</label>
                        <select id="promoProduct" class="form-select">
                            <option value="producto1">Producto 1</option>
                            <option value="producto2">Producto 2</option>
                            <option value="producto3">Producto 3</option>
                        </select>
                    </div>

                    <!-- Tipo de Promoción -->
                    <div class="col-md-6">
                        <label for="promoType" class="form-label">Tipo de Promoción:</label>
                        <select id="promoType" class="form-select">
                            <option value="descuento">Descuento Porcentual</option>
                            <option value="precio_fijo">Precio Fijo</option>
                            <option value="regalo">Regalo por Compra</option>
                        </select>
                    </div>

                    <!-- Fechas y Horas -->
                    <div class="col-md-4">
                        <label for="promoStartDate" class="form-label">Fecha y Hora de
                            Inicio:</label>
                        <input type="datetime-local" class="form-control" id="promoStartDate">
                    </div>
                    <div class="col-md-4">
                        <label for="promoEndDate" class="form-label">Fecha y Hora de Fin:</label>
                        <input type="datetime-local" class="form-control" id="promoEndDate">
                    </div>

                    <!-- Límites -->
                    <div class="col-md-4">
                        <label for="promoLimit" class="form-label">Límite de Productos:</label>
                        <input type="number" class="form-control" id="promoLimit"
                            placeholder="Cantidad disponible">
                    </div>
                    <div class="col-md-6">
                        <label for="maxPerClient" class="form-label">Máx. Compras por
                            Cliente:</label>
                        <input type="number" class="form-control" id="maxPerClient"
                            placeholder="Máx. por cliente">
                    </div>

                    <!-- Etiquetas -->
                    <div class="col-md-6">
                        <label for="promoTag" class="form-label">Etiqueta/Categoría:</label>
                        <input type="text" class="form-control" id="promoTag"
                            placeholder="Ej: Promoción por temporada">
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button type="button" class="btn btn-primary" id="savePromotion">Guardar
                        Promoción</button>
                </div>
            </form>
        </div>

        <!-- Vista de Promociones Activas -->
        <div>
            <h4>Promociones Activas</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Tipo</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Etiqueta</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="promotionTableBody">
                    <tr>
                        <td colspan="8" class="text-center">No hay promociones registradas.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php }

function registrosPromocion()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Registro de Ventas por Promoción</h2>

        <!-- Filtros para Visualización de Datos -->
        <div class="mb-5">
            <h4>Filtros</h4>
            <form id="filterForm" class="row g-3">
                <div class="col-md-3">
                    <label for="filterPromotion" class="form-label">Promoción:</label>
                    <select id="filterPromotion" class="form-select">
                        <option value="todas">Todas</option>
                        <option value="promo1">Promoción 1</option>
                        <option value="promo2">Promoción 2</option>
                        <option value="promo3">Promoción 3</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filterProduct" class="form-label">Producto:</label>
                    <input type="text" id="filterProduct" class="form-control"
                        placeholder="Ejemplo: Coca Cola">
                </div>
                <div class="col-md-3">
                    <label for="filterDateStart" class="form-label">Fecha Inicio:</label>
                    <input type="date" id="filterDateStart" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="filterDateEnd" class="form-label">Fecha Fin:</label>
                    <input type="date" id="filterDateEnd" class="form-control">
                </div>
                <div class="col-md-12 mt-3 text-end">
                    <button type="button" class="btn btn-primary" id="applyFilters">Aplicar
                        Filtros</button>
                </div>
            </form>
        </div>

        <!-- Visualización de Datos -->
        <div class="mb-5">
            <h4>Ventas Durante Promociones</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Promoción</th>
                        <th>Producto</th>
                        <th>Unidades Vendidas</th>
                        <th>Fecha</th>
                        <th>Región</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody">
                    <tr>
                        <td>1</td>
                        <td>Promoción 1</td>
                        <td>Coca Cola</td>
                        <td>120</td>
                        <td>2024-12-01</td>
                        <td>Región Norte</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Promoción 2</td>
                        <td>Pepsi</td>
                        <td>80</td>
                        <td>2024-12-02</td>
                        <td>Región Sur</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Comparativos -->
        <div class="mb-5">
            <h4>Comparativos</h4>
            <div class="row g-4">
                <!-- Gráfico de Ventas con vs. sin Promoción -->
                <div class="col-md-6">
                    <h5>Productos con vs. sin Promoción</h5>
                    <canvas id="promotionComparisonChart"></canvas>
                </div>
                <!-- Incremento en Ventas -->
                <div class="col-md-6">
                    <h5>Incremento en Unidades Vendidas</h5>
                    <canvas id="salesIncreaseChart"></canvas>
                </div>
            </div>
        </div>
    </div>
<?php }

function impactoPromociones()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Análisis del Impacto de las Promociones</h2>

        <!-- Panel de Indicadores Clave -->
        <div class="mb-5">
            <h4>Indicadores Clave</h4>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Incremento en Ventas</h5>
                            <p class="card-text fs-4" id="salesIncrease">25%</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Valor Total de Ventas</h5>
                            <p class="card-text fs-4" id="totalSalesValue">$50,000</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Retorno sobre Inversión (ROI)</h5>
                            <p class="card-text fs-4" id="roiValue">150%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficas de Análisis -->
        <div class="mb-5">
            <h4>Gráficas de Análisis</h4>
            <div class="row g-4">
                <!-- Gráfico de Barras -->
                <div class="col-md-6">
                    <h5>Ventas Antes, Durante y Después de la Promoción</h5>
                    <canvas id="salesImpactChart"></canvas>
                </div>
                <!-- Gráfico de Líneas -->
                <div class="col-md-6">
                    <h5>Tendencias de Ventas Asociadas a Promociones</h5>
                    <canvas id="salesTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tabla de Impacto -->
        <div>
            <h4>Tabla de Impacto</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Promoción</th>
                        <th>Unidades Vendidas</th>
                        <th>Valor Generado</th>
                        <th>Impacto (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Coca Cola</td>
                        <td>Promoción 1</td>
                        <td>120</td>
                        <td>$6,000</td>
                        <td>20%</td>
                    </tr>
                    <tr>
                        <td>Pepsi</td>
                        <td>Promoción 2</td>
                        <td>90</td>
                        <td>$4,500</td>
                        <td>15%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php }

function generacionReportes()
{ ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Generación de Reportes</h2>

        <!-- Reportes Personalizados -->
        <div class="mb-5">
            <h4>Filtros para Reportes Personalizados</h4>
            <form id="reportFilterForm" class="row g-3">
                <div class="col-md-4">
                    <label for="reportPromotion" class="form-label">Promoción:</label>
                    <select id="reportPromotion" class="form-select">
                        <option value="todas">Todas</option>
                        <option value="promo1">Promoción 1</option>
                        <option value="promo2">Promoción 2</option>
                        <option value="promo3">Promoción 3</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="reportStartDate" class="form-label">Fecha de Inicio:</label>
                    <input type="date" id="reportStartDate" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="reportEndDate" class="form-label">Fecha de Fin:</label>
                    <input type="date" id="reportEndDate" class="form-control">
                </div>
                <div class="col-md-12 text-end mt-3">
                    <button type="button" class="btn btn-primary me-2" id="generatePDF">Exportar a
                        PDF</button>
                    <button type="button" class="btn btn-secondary" id="generateExcel">Exportar a
                        Excel</button>
                </div>
            </form>
        </div>

        <!-- Visualización Interactiva -->
        <div class="mb-5">
            <h4>Visualización Interactiva</h4>
            <div class="row g-4">
                <!-- Gráfico de Barras -->
                <div class="col-md-6">
                    <h5>Comparativos de Ventas por Promoción</h5>
                    <canvas id="promotionComparisonChart"></canvas>
                </div>
                <!-- Gráfico de Líneas -->
                <div class="col-md-6">
                    <h5>Tendencias Históricas de Promociones</h5>
                    <canvas id="historicalTrendsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Resumen de Promociones -->
        <div>
            <h4>Resumen de Promociones</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Promoción</th>
                        <th>Unidades Vendidas</th>
                        <th>Valor Generado</th>
                        <th>Efectividad (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Promoción 1</td>
                        <td>150</td>
                        <td>$7,500</td>
                        <td>75%</td>
                    </tr>
                    <tr>
                        <td>Promoción 2</td>
                        <td>120</td>
                        <td>$6,000</td>
                        <td>60%</td>
                    </tr>
                    <tr>
                        <td>Promoción 3</td>
                        <td>90</td>
                        <td>$4,500</td>
                        <td>50%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php }
