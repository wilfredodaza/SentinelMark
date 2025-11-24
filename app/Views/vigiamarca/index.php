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
        <div class="col-lg-12 mt-0">
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

        <div class="row">
            <div class="d-flex mt-5">
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
                    </ul>
                </div>

                <div class="tab-content w-100 p-0" style="height: fit-content;">
                    <div class="tab-pane fade show active card-action"  id="navs-pills-detail-1" role="tabpanel">
                        <div class="card">
                            <div class="col-md-12 col-xxl-12">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-md-12">
                                            <div class="card-body py-0">
                                                <div class="col s12 card-datatable ">
                                                    <table class="datatables-basic table table-bordered text-center h-100" id="table_datatable"></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade card-action"  id="navs-pills-detail-2" role="tabpanel">
                        <div class="card">
                            <div class="card-datatable table-responsive pt-0 content-datatables-basic">
                                <table class="datatables-basic table table-bordered" id="table_datatable_2">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <span class="text-muted">Los campos con un asterisco (*) son requeridos para completar el formulario.</span>
                    
                        <form action="">

                            <!-- <div class="divider">
                                <div class="divider-text">Datos generales</div>
                            </div> -->

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

                            <!-- <div class="divider">
                                <div class="divider-text">Parámetros de búsqueda</div>
                            </div> -->

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
                                        <select class="select2 form-select required" data-allow-clear="true" id="niza" name="niza" aria-describedby="nizaHelp" multiple>
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

                            
                            <div class="row">
                                <!-- <div class="divider">
                                    <div class="divider-text">Opciones de motor</div>
                                </div> -->

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="input-group">
                                        <div class="input-group-text form-check mb-0">
                                            <input class="form-check-input m-auto" type="checkbox" value="" aria-label="Checkbox for following text input">
                                        </div>
                                        <div class="form-floating form-floating-outline">
                                            <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="fonetica" name="fonetica" aria-describedby="paisHelp" data-placeholder="Seleccione sensibilidad">
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
                                            <input class="form-check-input m-auto" type="checkbox" value="" aria-label="Checkbox for following text input">
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
                                            <input class="form-check-input m-auto" type="checkbox" value="" aria-label="Checkbox for following text input">
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
                                            <input class="form-check-input m-auto" type="checkbox" value="" aria-label="Checkbox for following text input">
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


                            <!-- <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="modulo-add" name="modulo-add" aria-describedby="modulo-Help">
                                            <option value=""></option>
                                            <?php foreach (modules() as $key => $module): ?>
                                                <option value="<?= $module->id ?>"><?= "$module->name" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="modulo-add">Modulo *</label>
                                    </div>

                                    <div id="modulo-Help" class="form-text"></div>
                                </div>
                            </div> -->

                            

                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <div class="w-100 border px-5">
                                            <small class="text-light fw-medium">Umbrales y priorización</small>
                                            <div id="slider-handles-3" class="mt-2 mb-12"></div>
                                            <small class="text-light fw-low">Score mínimo para registrar hallazgo: ej. 0.5</small>
                                            <!-- <input class="form-control" type="file" id="formFile"> -->
                                        </div>
                                    <!-- <div class="input-group no-wrap">
                                        <div class="input-group-text form-check mb-0">
                                            <input class="form-check-input m-auto" type="checkbox" value="" aria-label="Checkbox for following text input">
                                            <label for="formFile" class="form-label">Activar búsqueda figurativa</label>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                        </form>
                        
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

        <div class="col-lg-8 col-md-12 col-sm-12"><!--  Hallazgos -->
                
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

    </div>
</div>

<?= $this->endsection('content') ?>

<?= $this->section('javaScripts') ?>
    <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/nouislider/nouislider.js']) ?>"></script>
    <script src="<?= base_url([' assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js']) ?>"></script>
    <script src="<?= base_url([' assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js']) ?>"></script>
    <script src="<?= base_url([' assets/vendor/libs/jquery-timepicker/jquery-timepicker.js']) ?>"></script>
    <script src="<?= base_url([' assets/vendor/libs/pickr/pickr.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/dropzone/dropzone.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>

    <script>
        const info_page = <?= json_encode($data) ?>;
        const gacetas = <?= json_encode(getGacetas()) ?>;
    </script>

    <script src="<?= base_url(['assets/js/forms-sliders.js?v='.getCommit()]) ?>"></script>


    <script src="<?= base_url(['master/js/vigiamarca/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>