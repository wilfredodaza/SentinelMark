<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?> <?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


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
                        <div class="col-lg-4 col-md-6 col-sm-12 d-flex gap-4 my-2 d-flex align-items-center">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-primary rounded-3">
                                    <div>
                                        <i class="fa-duotone fa-regular fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-1 fw-medium">Tiempo medio de generación de documento (s)</p>
                                <span class="text-primary mb-0 h5">34h</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 d-flex gap-4 my-2 d-flex align-items-center">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-info rounded-3">
                                    <div>
                                        <i class="fa-duotone fa-light fa-wand-sparkles"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-1 fw-medium">Porcentaje de documentos con autocompletado (%)</p>
                                <span class="text-info mb-0 h5">82%</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 d-flex gap-4 my-2 d-flex align-items-center">
                            <div class="avatar avatar-lg">
                                <div class="avatar-initial bg-label-warning rounded-3">
                                    <div>
                                        <i class="fa-light fa-file-circle-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="content-right">
                                <p class="mb-1 fw-medium">Errores de cumplimiento detectados</p>
                                <span class="text-warning mb-0 h5">14</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="col-md-12 col-xxl-12">
            <div class="card d-flex align-items-end row">
                <div class="col-md-12">
                    <div class="card-body py-0">
                        <div class="col s12 card-datatable ">
                            <table class="datatables-basic table table-bordered text-center h-100" id="table_datatable"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12">
                
                <div
                    class="offcanvas offcanvas-end"
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
                            <form action="">

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <select class="select2 form-select required" data-allow-clear="true" id="tipo" name="tipo" aria-describedby="paisHelp">
                                                <option value=""></option>
                                                <?php foreach($brands as $brand): ?>
                                                    <option value="<?= $brand->id ?>"><?= $brand->nombre_corto ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <label for="tipo">Marca *</label>
                                        </div>
                                        <div id="tipoHelp" class="form-text"></div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <select class="select2 form-select required" data-allow-clear="true" id="template" name="template" aria-describedby="templateHelp">
                                                <option value=""></option>
                                                <?php foreach($categories as $category): ?>
                                                    <optgroup label="<?= $category->name ?>">
                                                        <?php foreach($category->templates as $template): ?>
                                                            <option value="<?= $template->id ?>"><?= $template->title ?></option>
                                                        <?php endforeach ?>
                                                    </optgroup>
                                                <?php endforeach ?>
                                            </select>
                                            <label for="template">Plantilla *</label>
                                        </div>
                                        <div id="templateHelp" class="form-text"></div>
                                    </div>

                                    <div class="col-lg-12 my-2" style="display:none" id="check-document">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1"> Descargar documento al finalizar </label>
                                        </div>
                                    </div>

                                </div>
    
                            </form>

                            

                            <div class="col-lg-12 my-2" style="display:none" id="check-document-form">
                                <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0" id="dropzone-basic-created">
                                    <div class="dz-message needsclick m-0 py-5">
                                        Arrastra el documento aquí o haz clic para subirlo.
                                    </div>
                                    <div class="fallback">
                                    <input name="file" type="file" />
                                    </div>
                                </form>
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

    <script src="<?= base_url(['master/js/doculaw/generate/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>