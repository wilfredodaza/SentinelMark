<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?><?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


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
                            <h3 class="mb-0"><?= $data->title ?? 'Titulo' ?></h3>
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

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Taza de éxito</h5>
                    </div>
                    <div class="d-flex align-items-center card-subtitle">
                            <div class="me-2">Del 27 de junio al <?= formatDate(date('Y-m-d')) ?> </div>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-between flex-wrap gap-2">

                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-success rounded">
                            <i class="ri-shield-check-line ri-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">458</h5>
                            <p class="mb-0">Oposiciones favorables</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-danger rounded">
                            <i class="ri-close-circle-line ri-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">587</h5>
                            <p class="mb-0">Total Cerradas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Impression & Order Chart -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Oposiciones activas</h5>
                    </div>
                </div>
                
                <?php
                    $activas    = 865;
                    $count      = 985;
                ?>
                <div class="card-body pb-0">
                    <div class="d-flex align-items-center justify-content-around  gap-4">
                        <div>
                            <div
                            class="chart-progress"
                            data-color="primary"
                            data-series="<?= number_format((($activas * 100) / $count), 0, ',', '.') ?>"
                            data-icon="../../assets/img/icons/misc/card-icon-laptop.png"></div>
                        </div>
                        <div>
                            <div class="card-info">
                                <div class="d-flex align-items-centergap-2 flex-wrap">
                                    <h5 class="mb-0 w-100 text-center"><?= "$activas de $count" ?></h5>
                                    <div class="d-flex align-items-center text-muted text-center w-100">
                                        <p class="mb-0 small w-100">
                                            <?= number_format((($activas * 100) / $count), 2, ',', '.') ?>
                                            <i class="fa-duotone fa-regular fa-percent"></i>
                                        </p>
                                        
                                        <!-- <div class="ri-arrow-down-s-line ri-20px"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-around flex-wrap gap-4 pb-2">
                        <div class="d-flex align-items-center gap-3">
                          <div class="card-info text-center">
                            <h5 class="mb-0">456</h5>
                            <p class="mb-0">Activa</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                          <div class="card-info text-center">
                            <h5 class="mb-0">125</h5>
                            <p class="mb-0">En estudio</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                          <div class="card-info text-center">
                            <h5 class="mb-0">180</h5>
                            <p class="mb-0">Enviada</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                          <div class="card-info text-center">
                            <h5 class="mb-0">150</h5>
                            <p class="mb-0">Cerrada </p>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Total Impression & Order Chart -->

        <!-- visits By Day Chart-->
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Oposiciones próximas a vencimiento</h5>
                    </div>
                    <p class="mb-0 card-subtitle">Total: 254</p>
                </div>
                <div class="card-body">
                    <div id="visitsByDayChart"></div>
                    <!-- <div class="d-flex justify-content-between mt-4">
                    <div>
                        <h6 class="mb-0">Most Visited Day</h6>
                        <p class="mb-0 small">Total 62.4k Visits on Thursday</p>
                    </div>
                    <div class="avatar">
                        <div class="avatar-initial bg-label-primary rounded">
                        <i class="ri-arrow-right-s-line ri-24px scaleX-n1-rtl"></i>
                        </div>
                    </div>
                    </div> -->
                </div>
            </div>
        </div>
        <!--/ visits By Day Chart-->

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

<?= $this->endsection('content') ?>

<?= $this->section('javaScripts') ?>
    <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
    <script src="<?= base_url(['assets/js/app-ecommerce-dashboard.js?v='.getCommit()]) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>

    <script>
        const info_page = <?= json_encode($data) ?>;
    </script>

    <script src="<?= base_url(['master/js/trademark_protection/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>