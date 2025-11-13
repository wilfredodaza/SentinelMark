<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?><?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


<?= $this->section('styles') ?>
    <?= $this->include('layouts/css_datatables') ?>
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.css']) ?>" />
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
                            <h3 class="mb-0"><?= $data->title ?? 'Titulo' ?></h3>
                        </div>
                        <?php if(isset($data->breadcrumbs) ): ?>
                            <div class="col-lg-6 col-md-12 col-sm-6 d-flex align-items-center justify-content-end flex-end">
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
                    <h4 id="canvasAddLabel" class="offcanvas-title">Añadir portafolio de marcas</h4>
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
                                        <input type="text" class="form-control required" id="marca" placeholder="" aria-describedby="marcaHelp">
                                        <label for="marca">Nombre de la marca *</label>
                                        <span class="form-floating-focused"></span>
                                    </div>
                                    <div id="marcaHelp" class="text-red"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="tipo" name="tipo" aria-describedby="paisHelp">
                                            <option value=""></option>
                                            <option value="Denominativa">Denominativa</option>
                                            <option value="Figurativa">Figurativa</option>
                                            <option value="Mixta">Mixta</option>
                                        </select>
                                        <label for="tipo">Tipo </label>
                                    </div>
                                    <div id="tipoHelp" class="form-text"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" id="pais-add" name="pais-add" aria-describedby="pais-add-help">
                                            <option value=""></option>
                                            <option value="Colombia" selected>Colombia</option>
                                            <option value="mexico">Mexico</option>
                                            <option value="EEUU">Estados unidos</option>
                                        </select>
                                        <label for="pais-add">País *</label>
                                    </div>

                                    <div id="pais-add-help" class="form-text"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="unit-add" placeholder="" aria-describedby="unit-addHelp">
                                        <label for="unit-add">Unidad de negocio</label>
                                        <span class="form-floating-focused"></span>
                                    </div>
                                    <div id="unit-addHelp" class="text-red"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="clasesNiza-Add" name="clasesNiza-Add" aria-describedby="clase-niza-Help" multiple>
                                            <option value=""></option>
                                            <?php foreach ($clasesNiza as $key => $niza): ?>
                                                <option value="<?= $niza->id ?>"><?= $niza->id ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="clasesNiza-Add">Clases Niza *</label>
                                    </div>

                                    <div id="clase-niza-Help" class="form-text"></div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="titular" name="titular" aria-describedby="estadoHelp">
                                            <option value=""></option>
                                        </select>
                                        <label for="titular">Titular *</label>
                                    </div>

                                    <div id="titularHelp" class="form-text"></div>
                                </div>
                            </div>

                            <div class="row">
                                
                            <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="agente-add" name="agente-add" aria-describedby="estadoHelp">
                                            <option value=""></option>
                                        </select>
                                        <label for="agente-add">Agente *</label>
                                    </div>

                                    <div id="agente-addHelp" class="form-text">

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control date-input" id="date" value="<?= date('Y-m-d') ?>" aria-describedby="dateHelp" placeholder="YYYY-MM-DD">
                                        <label for="date">Fecha solicitud *</label>
                                    </div>                                    
                                    <div id="dateHelp" class="text-red"></div>
                                </div>
                            </div>

                        </form>

                        <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0" id="dropzone-basic-created">
                            <div class="dz-message needsclick m-0 py-5">
                                Arrastra el logo aquí o haz clic para subirlo.
                            </div>
                            <div class="fallback">
                            <input name="file" type="file" />
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
                    id="canvasEdit"
                    aria-labelledby="canvasEditLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasEditLabel" class="offcanvas-title">Editar portafolio de marcas</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        <span class="text-muted">Los campos con un asterisco (*) son requeridos para completar el formulario.</span>
                    
                        <form action="" id="form-edit">

                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control required" id="marca" placeholder="" aria-describedby="marcaHelp">
                                        <label for="marca">Nombre de la marca *</label>
                                        <span class="form-floating-focused"></span>
                                    </div>
                                    <div id="marcaHelp" class="text-red"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" onchange="changeTipo(this.value)" data-allow-clear="false" id="tipo" name="tipo" aria-describedby="paisHelp">
                                            <option value=""></option>
                                            <option value="Denominativa">Denominativa</option>
                                            <option value="Figurativa">Figurativa</option>
                                            <option value="Mixta">Mixta</option>
                                        </select>
                                        <label for="tipo">Tipo </label>
                                    </div>
                                    <div id="tipoHelp" class="form-text"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" id="pais" name="pais" aria-describedby="pais-help">
                                            <option value=""></option>
                                            <option value="Colombia" selected>Colombia</option>
                                            <option value="mexico">Mexico</option>
                                            <option value="EEUU">Estados unidos</option>
                                        </select>
                                        <label for="pais">País *</label>
                                    </div>

                                    <div id="pais-help" class="form-text"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="unit" placeholder="" aria-describedby="unitHelp">
                                        <label for="unit">Unidad de negocio</label>
                                        <span class="form-floating-focused"></span>
                                    </div>
                                    <div id="unitHelp" class="text-red"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="clasesNiza" name="clasesNiza" aria-describedby="clase-niza-Help" multiple>
                                            <option value=""></option>
                                            <?php foreach ($clasesNiza as $key => $niza): ?>
                                                <option value="<?= $niza->id ?>"><?= $niza->id ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="clasesNiza">Clases Niza *</label>
                                    </div>

                                    <div id="clase-niza-Help" class="form-text"></div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="titular" name="titular" aria-describedby="estadoHelp">
                                            <option value=""></option>
                                        </select>
                                        <label for="titular">Titular *</label>
                                    </div>

                                    <div id="titularHelp" class="form-text"></div>
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="agente-add" name="agente-add" aria-describedby="estadoHelp">
                                            <option value=""></option>
                                        </select>
                                        <label for="agente-add">Agente *</label>
                                    </div>

                                    <div id="agente-addHelp" class="form-text">

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control date-input" id="date" value="<?= date('Y-m-d') ?>" aria-describedby="dateHelp" placeholder="YYYY-MM-DD">
                                        <label for="date">Fecha solicitud *</label>
                                    </div>                                    
                                    <div id="dateHelp" class="text-red"></div>
                                </div>
                            </div>

                        </form>
                        
                        <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0 d-none" id="dropzone-basic-edit">
                            <div class="dz-message needsclick m-0 py-5">
                                Arrastra el expediente aquí o haz clic para subirlo.
                            </div>
                            <div class="fallback">
                            <input name="file" type="file" />
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
                                                        <select class="select2 form-select required" data-allow-clear="true" id="pais-filter" name="pais" data-placeholder="Seleccione un cliente" aria-describedby="paisHelp">
                                                            <option value=""></option>
                                                            <option value="Colombia">Colombia</option>
                                                        </select>
                                                        <label for="pais-filter">País</label>
                                                    </div>
                
                                                    <div id="paisHelp" class="form-text"></div>
                                                </div>
                                                
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="estado-filter" name="estado" data-placeholder="Seleccione un cliente" aria-describedby="estadoHelp">
                                                            <option value=""></option>
                                                            <option value="Registrada">Registrada</option>
                                                            <option value="En trámite">En trámite</option>
                                                            <option value="Aprobada">Aprobada</option>
                                                            <option value="Rechazada">Rechazada</option>
                                                        </select>
                                                        <label for="estado-filter">Estado *</label>
                                                    </div>
                
                                                    <div id="estadoHelp" class="form-text"></div>
                                                </div>
                                            </div>
                
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control required" id="clase-filter" placeholder="" aria-describedby="claseHelp">
                                                        <label for="clase-filter">Clase</label>
                                                        <span class="form-floating-focused"></span>
                                                    </div>
                                                    <div id="claseHelp" class="text-red"></div>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control required" id="titular-filter" placeholder="" aria-describedby="titularHelp">
                                                        <label for="titular-filter">Titular *</label>
                                                    </div>
                                                    <div id="titular-filterHelp" class="text-red"></div>
                                                </div>
                                            </div>
                
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="unit-filter" name="unit" data-placeholder="Seleccione un cliente" aria-describedby="paisHelp">
                                                            <option value=""></option>
                                                        </select>
                                                        <label for="unit-filter">Unidad de negocio</label>
                                                    </div>
                
                                                    <div id="unitHelp" class="form-text"></div>
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
    </div>
</div>

<?= $this->endsection('content') ?>

<?= $this->section('javaScripts') ?>
    <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/dropzone/dropzone.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>

    <script>
        const info_page = <?= json_encode($data) ?>;
    </script>

    <script src="<?= base_url(['master/js/brand_portfolio/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>