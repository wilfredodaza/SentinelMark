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
                <h4 id="canvasAddLabel" class="offcanvas-title">Añadir costo</h4>
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

                            <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required" data-allow-clear="true" id="brand-add" name="brand-add" aria-describedby="brand-Help">
                                        <option value=""></option>
                                        <?php foreach (getBrands() as $key => $brand): ?>
                                            <option value="<?= $brand->id ?>"><?= "$brand->Marca / $brand->Expediente" ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="brand-add">Marca/Expediente *</label>
                                </div>

                                <div id="brand-Help" class="form-text"></div>
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

                            <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required" data-allow-clear="true" id="module-add" name="module-add" aria-describedby="module-Help">
                                        <option value=""></option>
                                        <?php foreach (modules() as $key => $module): ?>
                                            <option value="<?= $module->id ?>"><?= "$module->name" ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="module-add">Modulo asociado *</label>
                                </div>

                                <div id="module-Help" class="form-text"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required" data-allow-clear="true" id="type-add" name="type-add" aria-describedby="type-Help">
                                        <option value=""></option>
                                        <?php foreach (typeCosts() as $key => $type): ?>
                                            <option value="<?= $type->id ?>"><?= "$type->name" ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="type-add">Tipo de costo *</label>
                                </div>

                                <div id="type-Help" class="form-text"></div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required" data-allow-clear="true" id="sub_type-add" name="sub_type-add" aria-describedby="sub_type-Help">
                                        <option value=""></option>
                                        <?php foreach (subtype() as $key => $sub_type): ?>
                                            <option value="<?= $sub_type->id ?>"><?= "$sub_type->name" ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="sub_type-add">Sub Tipo de costo *</label>
                                </div>

                                <div id="sub_type-Help" class="form-text"></div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" onkeyup="updateFormattedValue(this)" class="form-control date" id="amount-add"  aria-describedby="amount-help" placeholder="">
                                    <label for="amount">Monto *</label>
                                </div>                                    
                                <div id="amount-help" class="text-red"></div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control date-input" id="date"  aria-describedby="dateHelp" placeholder="">
                                    <label for="date">Fecha *</label>
                                </div>                                    
                                <div id="dateHelp" class="text-red"></div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required" data-allow-clear="true" id="state-add" name="state-add" aria-describedby="state-Help">
                                        <option value=""></option>
                                        <?php foreach (state_costs() as $key => $state): ?>
                                            <option value="<?= $state->id ?>"><?= "$state->name" ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="state-add">Estado *</label>
                                </div>

                                <div id="state-Help" class="form-text"></div>
                            </div>

                            <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required" data-tags="true" data-allow-clear="true" id="proveedor-add" name="proveedor-add" aria-describedby="proveedor-Help">
                                        <option value=""></option>
                                    </select>
                                    <label for="proveedor-add">Proveedor / Benerficiario *</label>
                                </div>

                                <div id="proveedor-Help" class="form-text"></div>
                            </div>
                        </div>

                    </form>

                    <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0" id="dropzone-basic-add">
                        <div class="dz-message needsclick m-0 py-5">
                            Arrastra el comprobante aquí o haz clic para subirlo.
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

    <script src="<?= base_url(['master/js/finanzas/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>