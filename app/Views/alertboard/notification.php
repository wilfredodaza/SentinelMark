<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?><?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


<?= $this->section('styles') ?>
    <?= $this->include('layouts/css_datatables') ?>
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/dropzone/dropzone.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/pages/app-chat.css']) ?>">
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
                            <div class="col-lg-6 col-md-12 col-sm-6 d-flex align-items-center justify-content-end flex-end">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-style1 mb-0 mt-2 justify-content-center justify-content-md-end mt-md-0">
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
                    <div class="tab-pane fade show active card-action"  id="navs-pills-detail-1" role="tabpanel"><!-- Resumen General -->
                        <div class="card col-md-12 col-xxl-12 mt-2">
                            <div class="d-flex align-items-end row">
                                <div class="col-md-12">
                                    <div class="card-body py-0">
                                        <div class="col s12 card-datatable ">
                                            <table class="datatables-basic table table-bordered text-center h-100" id="datatables-basic-1"></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade "  id="navs-pills-detail-2" role="tabpanel"> <!-- Clases Niza -->
                        <div class="card col-md-12 col-xxl-12 mt-2">
                            <div class="d-flex align-items-end row">
                                <div class="col-md-12">
                                    <div class="card-body py-0">
                                        <div class="col s12 card-datatable ">
                                            <table class="datatables-basic table table-bordered text-center h-100" id="datatables-basic-2"></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade card-action" id="navs-pills-detail-3" role="tabpanel"> <!-- Titular y agente -->
                        <div class="card col-md-12 col-xxl-12 mt-2">
                            <div class="d-flex align-items-end row">
                                <div class="col-md-12">
                                    <div class="card-body py-0">
                                        <div class="col s12 card-datatable ">
                                            <table class="datatables-basic table table-bordered text-center h-100" id="datatables-basic-3"></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12">
                
                <div
                    class="offcanvas offcanvas-end"
                    tabindex="-2"
                    id="canvasAddCanal"
                    aria-labelledby="canvasAddCanalLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasAddCanalLabel" class="offcanvas-title">Añadir Canal</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        <span class="text-muted">Los campos con un asterisco (*) son requeridos para completar el formulario.</span>
                        <div class="row">
                            <form action="">
    
                                <div class="row">  

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="name-enlace" value="" aria-describedby="name-enlace-help" placeholder="">
                                            <label for="name-enlace">Canal *</label>
                                        </div>                                    
                                        <div id="name-enlace-help" class="text-red"></div>
                                    </div>                               
    
                                    <!-- <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control date-input" id="name-fecha" value="" aria-describedby="name-fecha-help" placeholder="">
                                            <label for="name-fecha">Fecha *</label>
                                        </div>                                    
                                        <div id="name-fecha-help" class="text-red"></div>
                                    </div> -->

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="name-version" value="" aria-describedby="name-version-help" placeholder="">
                                            <label for="name-version">Hora de envio *</label>
                                        </div>                                    
                                        <div id="name-version-help" class="text-red"></div>
                                    </div>
                                </div>
    
                            </form>
                        </div>
                        
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
                    class="offcanvas offcanvas-end"
                    tabindex="-2"
                    id="canvasAddFrecuencia"
                    aria-labelledby="canvasAddFrecuenciaLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasAddFrecuenciaLabel" class="offcanvas-title">Añadir Frecuencia</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        <span class="text-muted">Los campos con un asterisco (*) son requeridos para completar el formulario.</span>
                        <div class="row">
                            <form action="">
    
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="number" class="form-control" id="name-version" value="" aria-describedby="name-version-help" placeholder="">
                                            <label for="name-version">Dias</label>
                                        </div>                                    
                                        <div id="name-version-help" class="text-red"></div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="name-enlace" value="" aria-describedby="name-enlace-help" placeholder="">
                                            <label for="name-enlace">Titulo</label>
                                        </div>                                    
                                        <div id="name-enlace-help" class="text-red"></div>
                                    </div>
                                </div>
    
                            </form>
                        </div>
                        
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
        const canales = <?= json_encode(channels()) ?>;
        const frecuencias = <?= json_encode(recordatorios()) ?>;
    </script>

    <script src="<?= base_url(['master/js/alertboard/alerts.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>