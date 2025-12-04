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
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 my-2">
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
    
                            <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="unit" placeholder="" aria-describedby="unitHelp">
                                    <label for="unit">Unidad de negocio</label>
                                    <span class="form-floating-focused"></span>
                                </div>
                                <div id="unitHelp" class="text-red"></div>
                            </div>
    
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

                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input
                                        type="text"
                                        class="form-control date-input"
                                        id="eventEndStart"
                                        name="eventEndStart"
                                        placeholder="Fecha Inicio" />
                                    <label for="eventEndStart">Fecha inicio</label>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="form-floating form-floating-outline mb-5">
                                    <input
                                        type="text"
                                        class="form-control date-input"
                                        id="eventEndDate"
                                        name="eventEndDate"
                                        placeholder="Fecha Finalización" />
                                    <label for="eventEndDate">Fecha Finalización</label>
                                </div>
                            </div>
                        </div>
    
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xxl-12">
            <div class="row gy-6">
                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="avatar me-4">
                                    <div class="avatar-initial bg-label-warning rounded-3">
                                        <i class="ri-functions ri-24px"></i>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <div class="d-flex align-items-center">
                                        <h5 class="mb-0 me-2">$ <?=
                                            number_format(sumCostsAmount(), '2', '.', ',')
                                        ?></h5>
                                    </div>
                                    <p class="mb-0">Costos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="avatar me-4">
                                    <div class="avatar-initial bg-label-success rounded-3">
                                        <i class="ri-refund-2-line ri-24px"></i>
                                    </div>
                                </div>
                                <div class="card-info">
                                    <div class="d-flex align-items-center">
                                        <h5 class="mb-0 me-2">$ <?php
                                            $sum = sumCostsAmount();
                                            $retorno = $sum / 300;
                                            echo number_format($retorno, '2', '.', ',')
                                        ?></h5>
                                        <i class="ri-arrow-up-s-line text-success ri-20px"></i>
                                        <small class="text-success">30%</small>
                                    </div>
                                    <p class="mb-0">Retorno</p>
                                </div>
                            </div>
                        </div>
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

    <!-- <script src="<?= base_url(['master/js/movements/index.js?v='.getCommit()]) ?>"></script> -->
<?= $this->endsection('javaScript') ?>