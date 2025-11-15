<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?> <?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


<?= $this->section('styles') ?>
    <?= $this->include('layouts/css_datatables') ?>
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/dropzone/dropzone.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/quill/editor.css']) ?>" />
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

        <div class="card bg-transparent shadow-none border-0 mb-0">
            <div class="card-body row g-6 p-0 pb-0">
                <div class="col-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 d-flex gap-4 my-2 d-flex justify-content-center align-items-center">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-primary rounded-3">
                                    <div>
                                    <i class="fa-duotone fa-solid fa-arrows-rotate"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-1 fw-medium">Reutilización de plantillas</p>
                                <span class="text-primary mb-0 h5">15/Noviembre</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 d-flex gap-4 my-2 justify-content-center d-flex align-items-center">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-info rounded-3">
                                    <div>
                                        <i class="fa-duotone fa-light fa-code-branch"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-1 fw-medium">Tasa de adopción del versionado (%)</p>
                                <span class="text-info mb-0 h5">82%</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
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
                        <?php foreach ($data->tablists as $key => $tablist): ?>
                            <div class="tab-pane fade <?= $key == 0 ? 'show active' : "" ?> card-action"  id="navs-pills-detail-<?= $tablist->id ?>" role="tabpanel">
                                <!-- <div class="row"> -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-action-title card-title mb-0"><?= $tablist->name ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <td>Ejemplos</td>
                                                        <td>Notas</td>
                                                        <td>Diccionario</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $tablist->examples ?></td>
                                                        <td><?= $tablist->notes ?></td>
                                                        <td>
                                                            <ul>
                                                                <?php foreach($tablist->diccionary as $diccionary): ?>
                                                                    <li><?= $diccionary ?></li>
                                                                <?php endforeach ?>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
    
                                    <div class="card col-md-12 col-xxl-12 mt-2">
                                        <div class="d-flex align-items-end row">
                                            <div class="col-md-12">
                                                <div class="card-body py-0">
                                                    <div class="col s12 card-datatable ">
                                                        <table class="datatables-basic table table-bordered text-center h-100" id="table_datatable_<?= $tablist->id ?>"></table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <!-- </div> -->
                            </div>
                        <?php endforeach ?>
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
                        
                        <div class="row">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <form action="">

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control required" id="title" placeholder="" aria-describedby="title-Help">
                                                <label for="title">Titulo Plantilla *</label>
                                                <span class="form-floating-focused"></span>
                                            </div>
                                            <div id="title-Help" class="text-red"></div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                            <div id="full-editor">
                                            </div>
                                        </div>
                                    </div>
        
                                </form>
        
                                <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0" id="dropzone-basic-created">
                                    <div class="dz-message needsclick m-0 py-5">
                                        Arrastra el archivo aquí o haz clic para subirlo.
                                    </div>
                                    <div class="fallback">
                                    <input name="file" type="file" />
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div id="diccionary"></div>
                            </div>
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
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasPrev"
                    aria-labelledby="canvasPrevLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasPrevLabel" class="offcanvas-title">Añadir</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        
                        <p id="texto">

                        </p>
                    
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
                                type="button"
                                class="btn btn-outline-secondary d-grid"
                                data-bs-dismiss="offcanvas">
                                Cerrar
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12">
                
                <div
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasHistoryDiff"
                    aria-labelledby="canvasHistoryDiffLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasHistoryDiffLabel" class="offcanvas-title">Historial</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        
                        <div class="col s12 card-datatable ">
                            <table class="datatables-basic table table-bordered text-center h-100" id="table_datatable_history"></table>
                        </div>
                    
                        
                        <div class="d-flex align-items-start mt-4">
                            <button
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
    <script src="<?= base_url(['assets/vendor/libs/dropzone/dropzone.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/quill/katex.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/quill/quill.js']) ?>"></script>
    <script src="<?= base_url(['assets/js/forms-editors.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>

    <script>
        const data = <?= json_encode($data) ?>;
    </script>

    <script src="<?= base_url(['master/js/doculaw/template_library/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>