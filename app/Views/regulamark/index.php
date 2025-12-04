<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?> <?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


<?= $this->section('styles') ?>
    <?= $this->include('layouts/css_datatables') ?>
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.css']) ?>" />
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

        <div class="col-lg-8 col-md-12 col-sm-12">
                
                <div
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasAdd"
                    aria-labelledby="canvasAddLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasAddLabel" class="offcanvas-title">Añadir regla</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        <span class="text-muted">Los campos con un asterisco (*) son requeridos para completar el formulario.</span>
                    
                        <form action="">

                            <div class="row">
                                
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
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

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control required" id="code-add" placeholder="" aria-describedby="code-add-help">
                                        <label for="code-add">Codigo *</label>
                                        <span class="form-floating-focused"></span>
                                    </div>
                                    <div id="code-add-help" class="text-red"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="tipo" name="tipo" aria-describedby="paisHelp">
                                            <option value=""></option>
                                            <option value="Plazo">Plazo</option>
                                            <option value="Vigencia">Vigencia</option>
                                            <option value="Término de publicación">Término de publicación</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                        <label for="tipo">Tipo *</label>
                                    </div>
                                    <div id="tipoHelp" class="form-text"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="entidad" name="entidad" aria-describedby="paisHelp">
                                            <option value=""></option>
                                            <option value="SIC">SIC</option>
                                            <option value="OMPI">OMPI</option>
                                        </select>
                                        <label for="entidad">Entidad *</label>
                                    </div>
                                    <div id="entidadHelp" class="form-text"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control date" id="origen"  aria-describedby="origenHelp" placeholder="">
                                        <label for="origen">Evento de origen *</label>
                                    </div>                                    
                                    <div id="origenHelp" class="text-red"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="plazo"  aria-describedby="plazoHelp" placeholder="">
                                        <label for="plazo">Expresión de regla *</label>
                                    </div>                                    
                                    <div id="plazoHelp" class="text-red"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="tolerancia" name="tolerancia" aria-describedby="paisHelp">
                                            <option value=""></option>
                                            <option value="Dias habiles vs Calendario">Dias habiles vs Calendario</option>
                                            <option value="Excluir fines de semana">Excluir fines de semana / festivos</option>
                                        </select>
                                        <label for="tolerancia">Tolerancia *</label>
                                    </div>
                                    <div id="entidadHelp" class="form-text"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="prioridad" name="prioridad" aria-describedby="paisHelp">
                                            <option value=""></option>
                                            <option value="Alta">Alta</option>
                                            <option value="Media">Media</option>
                                            <option value="Baja">Baja</option>
                                        </select>
                                        <label for="prioridad">Prioridad *</label>
                                    </div>
                                    <div id="entidadHelp" class="form-text"></div>
                                </div>
                            </div>


                            <div class="row">
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
                            </div>

                            

                            <div class="row">

                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating form-floating-outline mb-6">
                                        <textarea class="form-control h-px-100" id="description" placeholder="Descripción"></textarea>
                                        <label for="description">Descripción</label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12">

                                    <div class="form-floating form-floating-outline mb-6">
                                        <textarea class="form-control h-px-100" id="notas_legales" placeholder="notas_legales"></textarea>
                                        <label for="notas_legales">Notas legales</label>
                                    </div>
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
                                Guardar
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12">
                
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
                                                        <select class="select2 form-select required" data-allow-clear="true" id="tipo-filter" name="tipo-filter" aria-describedby="paisHelp">
                                                            <option value=""></option>
                                                            <option value="Plazo">Plazo</option>
                                                            <option value="Vigencia">Vigencia</option>
                                                            <option value="Término de publicación">Término de publicación</option>
                                                            <option value="Otro">Otro</option>
                                                        </select>
                                                        <label for="tipo-filter">Tipo *</label>
                                                    </div>
                                                    <div id="tipoHelp" class="form-text"></div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="modulo-filter" name="modulo-filter" aria-describedby="modulo-Help">
                                                            <option value=""></option>
                                                            <?php foreach (modules() as $key => $module): ?>
                                                                <option value="<?= $module->id ?>"><?= "$module->name" ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <label for="modulo-filter">Modulo *</label>
                                                    </div>

                                                    <div id="modulo-Help" class="form-text"></div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" data-tag="true" id="entidad-filter" name="entidad-filter" aria-describedby="paisHelp">
                                                            <option value=""></option>
                                                            <option value="SIC">SIC</option>
                                                            <option value="OMPI">OMPI</option>
                                                        </select>
                                                        <label for="entidad-filter">Entidad *</label>
                                                    </div>
                                                    <div id="entidadHelp" class="form-text"></div>
                                                </div>
                                                
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="estado-filter" name="estado" data-placeholder="Seleccione un cliente" aria-describedby="estadoHelp">
                                                            <option value=""></option>
                                                            <option value="Registrada">Activa</option>
                                                            <option value="En trámite">Inactiva</option>
                                                        </select>
                                                        <label for="estado-filter">Estado *</label>
                                                    </div>
                
                                                    <div id="estadoHelp" class="form-text"></div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control required" id="code-filter" placeholder="" aria-describedby="codeHelp">
                                                        <label for="code-filter">Codigo</label>
                                                        <span class="form-floating-focused"></span>
                                                    </div>
                                                    <div id="codeHelp" class="text-red"></div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline mb-6">
                                                        <textarea class="form-control h-px-100" id="description-filter" placeholder="Descripción"></textarea>
                                                        <label for="description-filter">Descripción</label>
                                                    </div>
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

        <div class="col-lg-8 col-md-12 col-sm-12">
                
                <div
                    class="offcanvas offcanvas-end"
                    tabindex="-2"
                    id="canvasPreview"
                    aria-labelledby="canvasPreviewLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasPreviewLabel" class="offcanvas-title">Vista previa</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>
                                            <b>Fecha Origen</b>
                                        </td>
                                        <td>10-10-2025<br><hr>Viernes 10 de octubre del 2025</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Regla Aplicada</b>
                                        </td>
                                        <td>CL_VIG_30D</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Fecha resultado</b>
                                        </td>
                                        <td>26-11-2025<br><hr>Miercoles 26 de noviembre del 2025</td>
                                    </tr>
                                    <tr>
                                        <td><b>Días hábiles/calendario usados</b></td>
                                        <td>30 Dias</td>
                                    </tr>
                                    <tr>
                                        <td><b>Ajustes por festivos</b></td>
                                        <td>3 Dias</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                                     
                        
                        <div class="d-flex align-items-start mt-4">
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

    </div>
</div>

<?= $this->endsection('content') ?>

<?= $this->section('javaScripts') ?>
    <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>
    <script>
        const info_page = <?= json_encode($data) ?>;
    </script>

    <script src="<?= base_url(['master/js/regulamark/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>