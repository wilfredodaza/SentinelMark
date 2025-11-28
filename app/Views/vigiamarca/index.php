<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?> <?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


<?= $this->section('styles') ?>
    <?= $this->include('layouts/css_datatables') ?>
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/nouislider/nouislider.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/jquery-timepicker/jquery-timepicker.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/pickr/pickr-themes.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/dropzone/dropzone.css']) ?>" />
<?= $this->endsection('styles') ?>

<?= $this->section('content') ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <div class="col-lg-12 mt-0 px-0">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-<?= isset($data->breadcrumbs) ? 6 : 12 ?> col-md-12 col-sm-6">
                            <h3 class="mb-0"><?= $data->title ?? 'Titulo' ?> <?= $data->sub_title ?? '' ?></h3>
                        </div>
                        <?php if(isset($data->breadcrumbs) ): ?>
                            <div class="col-lg-6 col-md-12 col-sm-6 d-flex align-items-center justify-content-end flex-end flex-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-style1 mb-0 justify-content-end">
                                        <?php foreach($data->breadcrumbs as $breadcrumb): ?>
                                            <li class="breadcrumb-item <?= !isset($breadcrumb->url) ? "active" : "" ?>">
                                                <a href="<?= isset($breadcrumb->url) ? $breadcrumb->url : "javascript:void(0);" ?>"><?= $breadcrumb->name ?></a>
                                            </li>
                                        <?php endforeach ?>
                                    </ol>
                                </nav>
                            </div>
                        <?php endif ?>
                    </div>
                    <div id="description-indicadores"></div>
                </div>
                <div class="card-body d-flex justify-content-around flex-wrap gap-4 p-0 px-5" id="indicadores"></div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 px-0">
            <div class="nav-align-left mb-6">
                <ul class="nav nav-pills nav-fill me-4" style="max-width: 200px; height: min-content" role="tablist">
                    <?php foreach ($data->tablists as $key => $tablist): ?>
                        <li class="nav-item w-100">
                            <button
                                type="button"
                                class="nav-link <?= $key == 0 ? "active" : ""?>"
                                role="tab"
                                data-bs-toggle="tab"
                                data-bs-target="#navs-pills-detail-<?= $tablist->id ?>"
                                aria-controls="navs-pills-detail-<?= $tablist->id ?>"
                                aria-selected="true">
                                <span class="d-none d-sm-block">
                                <div class="d-flex justify-content-between align-items-center">
                                        <div class=""><i class="tf-icons <?= $tablist->icon ?> me-2"></i> </div>
                                        <div class="" style="text-wrap:auto"><?= $tablist->name ?></div>
                                    </div>
                                </span>
                                <i class="<?= $tablist->icon ?> ri-20px d-sm-none"></i>
                            </button>
                        </li>
                    <?php endforeach ?>
                    <li class="nav-item d-none">
                        <button
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-add"
                            type="button"
                            role="tab">
                            Hidden
                        </button>
                    </li>

                    <li class="nav-item d-none">
                        <button
                            class="nav-link"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-findings"
                            type="button"
                            role="tab">
                            Hidden
                        </button>
                    </li>
                </ul>
                <div class="tab-content p-0 bg-none w-0" style="height: fit-content;">
                    <div class="tab-pane fade show active"  id="navs-pills-detail-1" role="tabpanel">
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="card-title m-0 d-flex justify-content-lg-start justify-content-md-center">Listado de búsquedas</h4>
                            </div>
                            <div class="card-body py-0">
                                <div class="card-datatable pt-0">
                                    <table class="datatables-basic table table-bordered text-center h-100" id="table_datatable"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade card-action" id="navs-pills-detail-2" role="tabpanel">
                        <div class="card">
                            <div class="card-header py-2">
                                <h4 class="card-title w-100 m-0 d-flex justify-content-lg-start justify-content-md-center">
                                    Gacetas
                                </h4>
                            </div>
                            <div class="card-body py-0">
                                <div class="card-datatable table-responsive pt-0 content-datatables-basic">
                                    <table class="datatables-basic table table-bordered" id="table_datatable_2">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade card-action" id="navs-pills-add" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-block">
                                <h5 class="card-title my-0 w-100" id="form-search">
                                    Añadir busqueda nueva
                                </h5>
                                <span class="text-muted">Los campos con un asterisco (*) son requeridos para completar el formulario.</span>
                            </div>

                        </div>
                        <form action="">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="divider mt-0">
                                        <div class="divider-text">Datos generales</div>
                                    </div>
        
                                    <div class="row">
        
                                        <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control required" id="name-add" placeholder="" aria-describedby="code-add-help">
                                                <label for="name-add">Nombre de la vigilancia *</label>
                                                <span class="form-floating-focused"></span>
                                            </div>
                                            <div id="name-add-help" class="text-red"></div>
                                        </div>
        
                                        
                                        <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2 form-select required" data-allow-clear="true" id="tipo" name="tipo" aria-describedby="paisHelp">
                                                    <option value=""></option>
                                                    <option value="Vigilar marca de mi portafolio">Vigilar marca de mi portafolio</option>
                                                    <option value="Vigilar palabra / término">Vigilar palabra / término</option>
                                                    <option value="Vigilar marcas de un titular">Vigilar marcas de un titular</option>
                                                </select>
                                                <label for="tipo">Tipo *</label>
                                            </div>
                                            <div id="tipoHelp" class="form-text"></div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2 form-select required" data-allow-clear="true" id="pais-add" name="pais-add" aria-describedby="pais-Help">
                                                    <option value=""></option>
                                                    <?php foreach (countries() as $key => $country): ?>
                                                        <option value="<?= $country->id ?>"><?= "$country->name - $country->code" ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <label for="pais-add">País/Juridcción *</label>
                                            </div>
        
                                            <div id="pais-Help" class="form-text"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="divider mt-0">
                                        <div class="divider-text">Parámetros de búsqueda</div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control required" id="base-add" placeholder="" aria-describedby="base-add-help">
                                                <label for="base-add">Texto base *</label>
                                                <span class="form-floating-focused"></span>
                                            </div>
                                            <div id="base-add-help" class="text-red"></div>
                                        </div>
            
                                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2 form-select required" data-allow-clear="true" id="niza" placeholder="" name="niza" aria-describedby="nizaHelp" multiple>
                                                    <option value=""></option>
                                                    <?php foreach (getClasesNiza() as $key => $niza): ?>
                                                        <option value="<?= $niza->id ?>"><?= $niza->id ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <label for="niza">Clases Niza *</label>
                                            </div>
                                            <div id="nizaHelp" class="form-text"></div>
                                        </div>
            
                                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="propietario" name="propietario" aria-describedby="paisHelp">
                                                    <option value=""></option>
                                                </select>
                                                <label for="propietario">Propietario *</label>
                                            </div>
                                            <div id="propietarioHelp" class="form-text"></div>
                                        </div>
            
                                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2 form-select required" data-allow-clear="true" id="tipo_signo" name="tipo_signo" aria-describedby="paisHelp">
                                                    <option value=""></option>
                                                    <option value="Denominativo">Denominativo</option>
                                                    <option value="Figurativo">Figurativo</option>
                                                    <option value="Mixto">Mixto</option>
                                                </select>
                                                <label for="tipo_signo">Tipo de signo a vigilar *</label>
                                            </div>
                                            <div id="tipo_signoHelp" class="form-text"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    
                                    <div class="divider mt-0">
                                        <div class="divider-text">Opciones de motor</div>
                                    </div>
                                    <div class="row">
            
                                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                            <div class="input-group">
                                                <div class="input-group-text form-check mb-0">
                                                    <input class="form-check-input m-auto" id="check_fonetica" type="checkbox" value="" aria-label="Checkbox for following text input">
                                                </div>
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select required" disabled data-allow-clear="true" data-tag="true" id="fonetica" name="fonetica" aria-describedby="paisHelp" data-placeholder="Seleccione sensibilidad">
                                                        <option value=""></option>
                                                        <option value="Baja">Baja</option>
                                                        <option value="Media">Media</option>
                                                        <option value="Alta">Alta</option>
                                                    </select>
                                                    <label for="fonetica">Activar búsqueda fonética</label>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                            <div class="input-group">
                                                <div class="input-group-text form-check mb-0">
                                                    <input class="form-check-input m-auto" id="check_difusa" type="checkbox" value="" aria-label="Checkbox for following text input">
                                                </div>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="number" class="form-control" id="fuzzy" aria-label="Text input with checkbox" placeholder="Distancia máxima permitida (ej. 1-3 caracteres)">
                                                    <label for="fuzzy">Activar coincidencia difusa</label>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                            <div class="input-group no-wrap">
                                                <div class="input-group-text form-check mb-0">
                                                    <input class="form-check-input m-auto" id="check_semantica" type="checkbox" value="" aria-label="Checkbox for following text input">
                                                </div>
                                                    <div class="w-100 border px-5">
                                                        <small class="text-light fw-medium">Activar similitud semántica</small>
                                                        <div id="slider-handles" class="mt-2 mb-12"></div>
                                                        <small class="text-light fw-low">Umbral de similitud (0-1, con sugerencia: 0.7)</small>
                                                    </div>
                                            </div>
                                        </div>
            
                                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                            <div class="input-group no-wrap">
                                                <div class="input-group-text form-check mb-0">
                                                    <input class="form-check-input m-auto" id="check_figurativa" type="checkbox" value="" aria-label="Checkbox for following text input">
                                                    <!-- <label for="formFile" class="form-label">Activar búsqueda figurativa</label> -->
                                                </div>
                                                <div class="w-100 border px-5">
                                                        <small class="text-light fw-medium">Activar búsqueda figurativa</small>
                                                        <div id="slider-handles-2" class="mt-2 mb-12"></div>
                                                        <small class="text-light fw-low">Umbral de similitud (0-1, con sugerencia: 0.7)</small>
                                                        <!-- <input class="form-control" type="file" id="formFile"> -->
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="divider mt-0">
                                        <div class="divider-text">Frecuencia y ejecución</div>
                                    </div>
                                    <div class="row">
            
                                        <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2 form-select required" data-allow-clear="true"  id="frecuencia" name="frecuencia" aria-describedby="paisHelp">
                                                    <option value=""></option>
                                                    <option value="Cada vez que haya nueva Gaceta SIC" selected>Cada vez que haya nueva Gaceta SIC</option>
                                                    <option value="Diaria">Diaria</option>
                                                    <option value="Semanal">Semanal</option>
                                                    <option value="Solo manual">Solo manual</option>
                                                </select>
                                                <label for="frecuencia">Frecuencia *</label>
                                            </div>
                                            <div id="entidadHelp" class="form-text"></div>
                                        </div>
            
                                        <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control required" id="flatpickr-time" placeholder="HH:MM" aria-describedby="horario-add-help">
                                                <label for="flatpickr-time">Horario de ejecucion *</label>
                                                <span class="form-floating-focused"></span>
                                            </div>
                                            <div id="horario-add-help" class="text-red"></div>
                                        </div>
            
                                        <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="responsable" name="responsable" aria-describedby="paisHelp">
                                                    <option value=""></option>
                                                </select>
                                                <label for="responsable">Responsable *</label>
                                            </div>
                                            <div id="responsableHelp" class="form-text"></div>
                                        </div>
            
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-body">

                                    <div class="divider mt-0">
                                        <div class="divider-text">Umbrales y priorización</div>
                                    </div>

                                    <div class="row">

                                        <div class="col-lg-8 col-md-12 col-sm-12 my-2">
                                            <div class="w-100 border px-5">
                                                <small class="text-light fw-medium">Score mínimo para registrar hallazgo: ej. 0.5</small>
                                                <div id="slider-handles-3" class="mt-2 mb-12"></div>
                                                <!-- <input class="form-control" type="file" id="formFile"> -->
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                            <div class="form-check mt-4 d-flex align-items-center">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label px-5" for="defaultCheck1"> Crear automáticamente una <b>alerta en AlertBoard </b>para hallazgos “Alto riesgo” </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <button
                                        type="button"
                                        id="btn-cancel-add"
                                        onclick="cancelAdd()"
                                        class="btn btn-outline-secondary d-grid"
                                        data-bs-dismiss="offcanvas">
                                        Cancelar
                                        </button>
                                    <button
                                        type="submit"
                                        class="btn btn-label-primary d-grid mx-4"
                                        data-bs-dismiss="offcanvas">
                                        Guardar y activar
                                        </button>

                                        
                                    <button
                                        type="submit"
                                        class="btn btn-primary d-grid"
                                        data-bs-dismiss="offcanvas">
                                        Guardar como borrador
                                        </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade card-action" id="navs-pills-findings" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title my-0 w-100" id="form-search">
                                    Hallazgos encontrados
                                </h5>
                            </div>
                            <!-- <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table" id="table_findigns">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Marca</th>                                                
                                                <th>Marca <br>detectada</th>
                                                <th>Titular marca <br>detectada</th>
                                                <th>Término <br>vigilado</th>
                                                <th>Score <br>similitud</th>
                                                <th>Tipo <br>similitud</th>
                                                <th>Clases <br>niza</th>
                                                <th>País/Juridicción</th>
                                                <th>Fecha <br>publicación</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        </tbody>
                                    </table>
                                </div>
                            </div> -->
                        </div>

                        <div class="row" id="findings">

                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex mt-5">


            </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12">
                
                <div
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasAdd"
                    aria-labelledby="canvasAddLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasAddLabel" class="offcanvas-title">Añadir</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
                                type="button"
                                class="btn btn-outline-secondary d-grid"
                                data-bs-dismiss="offcanvas">
                                Cancelar
                                </button>
                            <button
                                type="submit"
                                class="btn btn-primary d-grid mx-4"
                                data-bs-dismiss="offcanvas">
                                Guardar y avtivar
                                </button>

                                
                            <button
                                type="submit"
                                class="btn btn-label-primary d-grid"
                                data-bs-dismiss="offcanvas">
                                Guardar como borrador
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12"><!--  Filtro -->
                
                <div
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasFilter"
                    aria-labelledby="canvasFilterLabel">
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        <form action="" id="form-filter">

                            <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0">
                                <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center mb-6 py-0">
                                    <span class="card-title mb-4 lh-lg px-md-12 h4 text-heading">
                                        Busca <span class="text-primary text-nowrap">todo en un mismo lugar</span>.
                                    </span>
                                    <div class="d-flex align-items-center justify-content-between app-academy-md-80 w-100">
                                        <input type="search" placeholder="Realice tu busqueda" class="form-control form-control-sm me-4">
                                        <button type="submit" class="btn btn-primary btn-icon waves-effect waves-light">
                                            <i class="ri-search-line ri-22px"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion accordion-popout" id="accordionPopout">
                                <div class="accordion-item mx-0">
                                    <h2 class="accordion-header" id="headingPopoutOne">
                                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionPopoutOne" aria-expanded="false" aria-controls="accordionPopoutOne">
                                            Busqueda especifica
                                        </button>
                                    </h2>

                                    <div id="accordionPopoutOne" class="accordion-collapse collapse" aria-labelledby="headingPopoutOne" data-bs-parent="#accordionPopout" style="">
                                        <div class="accordion-body">
                                            <div class="row">

                                            
                                                
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="estado-filter" name="estado" data-placeholder="Seleccione un cliente" aria-describedby="estadoHelp">
                                                            <option value=""></option>
                                                            <option value="Registrada">Activa</option>
                                                            <option value="Pausada">Pausada</option>
                                                            <option value="Error">Error</option>
                                                        </select>
                                                        <label for="estado-filter">Estado</label>
                                                    </div>
                
                                                    <div id="estadoHelp" class="form-text"></div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="tipo-filter" name="tipo-filter" aria-describedby="paisHelp">
                                                            <option value=""></option>
                                                            <option value="Vigilar marca de mi portafolio">Vigilar marca de mi portafolio</option>
                                                            <option value="Vigilar palabra / término">Vigilar palabra / término</option>
                                                            <option value="Vigilar marcas de un titular">Vigilar marcas de un titular</option>
                                                        </select>
                                                        <label for="tipo-filter">Tipo *</label>
                                                    </div>
                                                    <div id="tipoHelp" class="form-text"></div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="pais-filter" name="pais-filter" aria-describedby="pais-Help">
                                                            <option value=""></option>
                                                            <?php foreach (countries() as $key => $country): ?>
                                                                <option value="<?= $country->id ?>"><?= "$country->name - $country->code" ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <label for="pais-filter">País/Juridcción *</label>
                                                    </div>

                                                    <div id="pais-Help" class="form-text"></div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="responsablefilter" name="responsablefilter" aria-describedby="paisHelp">
                                                            <option value=""></option>
                                                        </select>
                                                        <label for="responsablefilter">Responsable *</label>
                                                    </div>
                                                    <div id="responsablefilterHelp" class="form-text"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
                                type="submit"
                                class="btn btn-primary d-grid mx-4"
                                data-bs-dismiss="offcanvas">
                                Filtrar
                                </button>
                            <button
                                type="button"
                                class="btn btn-outline-secondary d-grid"
                                data-bs-dismiss="offcanvas">
                                Cancelar
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12"><!--  Hallazgos -->
                
                <div
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasHallazgosComparacion"
                    aria-labelledby="canvasHallazgosComparacionLabel">
                    
                    <div class="offcanvas-header">
                        <h4 id="canvasHallazgosComparacionLabel" class="offcanvas-title">Hallazgos Comparacion</h4>
                        <button
                            type="button"
                            class="btn-close text-reset"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">

                        <div id="hallazgo-comparacion"></div>
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
                                id="closeBtn"
                                type="button"
                                class="btn btn-outline-secondary d-grid"
                                data-bs-dismiss="offcanvas">
                                Cerrar
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12"><!--  Hallazgos -->
                
                <div
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasHallazgos"
                    aria-labelledby="canvasHallazgosLabel">
                    
                    <div class="offcanvas-header">
                        <h4 id="canvasHallazgosLabel" class="offcanvas-title">Hallazgos</h4>
                        <button
                            type="button"
                            class="btn-close text-reset"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">

                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Marca</th>
                                        <th>Descripción</th>
                                        <th>Umbral</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
                                id="closeBtn"
                                type="button"
                                class="btn btn-outline-secondary d-grid"
                                data-bs-dismiss="offcanvas">
                                Cerrar
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12"><!--  Gaceta -->
                
                <div
                    class="offcanvas offcanvas-end"
                    tabindex="-2"
                    id="canvasGaceta"
                    aria-labelledby="canvasGacetaLabel">
                    
                    <div class="offcanvas-header">
                        <h4 id="canvasGacetaLabel" class="offcanvas-title">Añadir Gaceta</h4>
                        <button
                            type="button"
                            class="btn-close text-reset"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        
                        <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0" id="dropzone-basic-created">
                            <div class="dz-message needsclick m-0 py-5">
                                Arrastra el archivo aquí o haz clic para subirlo.
                            </div>
                            <div class="fallback">
                            <input name="file" type="file" />
                            </div>
                        </form>
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
                                id="closeBtn"
                                type="button"
                                class="btn btn-outline-secondary d-grid"
                                data-bs-dismiss="offcanvas">
                                Cerrar
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12"><!--  Oposición -->
                
                <div
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasOposicion"
                    aria-labelledby="canvasOposicionLabel">
                    
                    <div class="offcanvas-header">
                        <h4 id="canvasOposicionLabel" class="offcanvas-title">Crear Oposicion</h4>
                        <button
                            type="button"
                            class="btn-close text-reset"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        
                        <form action="/upload">
                            <div class="divider">
                                <div class="divider-text">Marca Propia</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="brand-propio-add" name="brand-propio-add" aria-describedby="brand-propio-Help">
                                            <option value=""></option>
                                            <?php foreach (getBrands() as $key => $brand): ?>
                                                <option value="<?= $brand->id ?>"><?= "$brand->Marca" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="brand-propio-add">Marca Propia *</label>
                                    </div>

                                    <div id="brand-propio-Help" class="form-text"></div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="clases-propio-add" name="clases-propio-add" aria-describedby="clases-propio-Help" multiple>
                                            <option value=""></option>
                                            <?php foreach (getClasesNiza() as $key => $niza): ?>
                                                <option value="<?= $niza->id ?>"><?= "$niza->id" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="clases-propio-add">Clases Niza *</label>
                                    </div>

                                    <div id="clases-propio-Help" class="form-text"></div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="pais-propio-add" name="pais-propio-add" aria-describedby="pais-propio-Help">
                                            <option value=""></option>
                                            <?php foreach (countries() as $key => $country): ?>
                                                <option value="<?= $country->id ?>"><?= "$country->name - $country->code" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="pais-propio-add">País/Juridcción *</label>
                                    </div>

                                    <div id="pais-propio-Help" class="form-text"></div>
                                </div>
                            </div>

                            <div class="divider">
                                <div class="divider-text">Marca Detectada</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="brand-detectada-add" name="brand-detectada-add" aria-describedby="brand-detectada-Help">
                                            <option value=""></option>
                                            <?php foreach (getBrands() as $key => $brand): ?>
                                                <option value="<?= $brand->id ?>"><?= "$brand->Marca" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="brand-detectada-add">Marca Detectada *</label>
                                    </div>

                                    <div id="brand-detectada-Help" class="form-text"></div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="clases-detectada-add" name="clases-detectada-add" aria-describedby="clases-detectada-Help" multiple>
                                            <option value=""></option>
                                            <?php foreach (getClasesNiza() as $key => $niza): ?>
                                                <option value="<?= $niza->id ?>"><?= "$niza->id" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="clases-detectada-add">Clases Niza *</label>
                                    </div>

                                    <div id="clases-detectada-Help" class="form-text"></div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="tipo-filter" name="tipo"  aria-describedby="tipoHelp">
                                            <option value=""></option>
                                            <option value="Absoluta">Absoluta</option>
                                            <option value="Confusión">Confusión</option>
                                            <option value="Competencia desleal">Competencia desleal</option>
                                        </select>
                                        <label for="tipo-filter">Tipo Causal</label>
                                    </div>

                                    <div id="tipoHelp" class="form-text"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control date-input" placeholder="YYYY-MM-DD" id="flatpickr-date" value="<?= date('Y-m-d') ?>">
                                        <label for="flatpickr-date">Fecha publicacion</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-tag="true" data-allow-clear="false" id="titular" name="titular" aria-describedby="estadoHelp">
                                            <option value=""></option>
                                        </select>
                                        <label for="titular">Titular *</label>
                                    </div>

                                    <div id="titularHelp" class="form-text"></div>
                                </div>
                            </div>
                        </form>
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
                                type="button"
                                class="btn btn-primary d-grid mx-4"
                                data-bs-dismiss="offcanvas">
                                Guardar
                                </button>

                            <button
                                id="closeBtn"
                                type="button"
                                class="btn btn-outline-secondary d-grid"
                                data-bs-dismiss="offcanvas">
                                Cerrar
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12"><!--  AlertBoard -->
                
                <div
                    class="offcanvas offcanvas-end"
                    tabindex="-2"
                    id="canvasAlerta"
                    aria-labelledby="canvasAlertaLabel">
                    
                    <div class="offcanvas-header">
                        <h4 id="canvasAlertaLabel" class="offcanvas-title">Crear Alerta</h4>
                        <button
                            type="button"
                            class="btn-close text-reset"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        
                        <form action="/upload">
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" id="description" placeholder="Descripción"></textarea>
                                        <label for="description">Descripción</label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control date-input" placeholder="YYYY-MM-DD" id="flatpickr-date-2">
                                        <label for="flatpickr-date-2">Fecha limite</label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline input-filter">
                                        <select class="select2 form-select required" data-allow-clear="true" id="responsable-add" name="responsable-add" aria-describedby="estadoHelp">
                                            <option value=""></option>
                                            <option value="Laura Gómez">Laura Gómez</option>
                                            <option value="Carlos Pérez">Carlos Pérez</option>
                                            <option value="Sofía Ruiz">Sofía Ruiz</option>
                                        </select>
                                        <label for="responsable-add">Responsable *</label>
                                    </div>

                                    <div id="responsable-addHelp" class="form-text">

                                    </div>
                                </div>

                                <div class="mb-5">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input allDay-switch" id="notification-1" />
                                        <label class="form-check-label text-green" for="notification-1"><i class="ri-whatsapp-line"></i> WhatsApp</label>
                                    </div>
                                </div>

                                <div class="mb-5">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input allDay-switch" id="notification-2" />
                                        <label class="form-check-label text-orange text-darken-5" for="notification-2"><i class="ri-google-fill"></i> Correo Electronico</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
                                type="button"
                                class="btn btn-primary d-grid mx-4"
                                data-bs-dismiss="offcanvas">
                                Guardar
                                </button>

                            <button
                                id="closeBtn"
                                type="button"
                                class="btn btn-outline-secondary d-grid"
                                data-bs-dismiss="offcanvas">
                                Cerrar
                                </button>
                        </div>
                    </div>
                </div>
        </div>


    </div>
</div>

<?= $this->endsection('content') ?>

<?= $this->section('javaScripts') ?>
    <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/nouislider/nouislider.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/dropzone/dropzone.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>

    <script>
        const info_page = <?= json_encode($data) ?>;
        const gacetas = <?= json_encode(getGacetas()) ?>;
    </script>

    <script src="<?= base_url(['assets/js/forms-sliders.js?v='.getCommit()]) ?>"></script>


    <script src="<?= base_url(['master/js/vigiamarca/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>