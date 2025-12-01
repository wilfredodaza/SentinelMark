<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?> <?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


<?= $this->section('styles') ?>
    <?= $this->include('layouts/css_datatables') ?>
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/nouislider/nouislider.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/apex-charts/apex-charts.css']) ?>" />
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
                        <div class="demo-inline-spacing d-flex align-items-center justify-content-end flex-end flex-end">
                            <button type="button" class="btn rounded-pill btn-label-primary waves-effect my-0">
                                <i class="ri-file-pdf-2-line"></i> Generar PDF
                            </button>
                            <button type="button" class="btn rounded-pill btn-label-dark waves-effect my-0 mx-0" data-bs-toggle="offcanvas" data-bs-target="#canvasFilter" aria-controls="offcanvasEnd">
                                <i class="ri-filter-3-line"></i>Filtro
                            </button>
                        </div>
                    </div>
                    <div id="description-indicadores"></div>
                </div>
                <div class="card-body d-flex justify-content-around flex-wrap gap-4 p-0 px-5" id="indicadores"></div>
            </div>
        </div>

        <!-- Topic you are interested in -->
        <div class="col-12">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Hallazgos en el ultimo año</h5>
                    <div class="dropdown">
                    <button
                        class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                        type="button"
                        id="topic"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ri-more-2-line ri-20px"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
                        <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
                        <a class="dropdown-item" href="javascript:void(0);">See All</a>
                    </div>
                    </div>
                </div>
                <div class="card-body row g-3">
                    <div class="col-lg-7 col-md-8 col-sm-12">
                        <div id="horizontalBarChart"></div>
                    </div>

                    <div class="col-lg-5 col-md-4 col-sm-12 d-flex justify-content-around align-items-center p-0 m-0 ">

                        <div class="demo-inline-spacing d-flex p-0 m-0 w-100">
                            <?php foreach ($months_chunks as $key => $groups): ?>
                                <ul class="list-group m-2 w-100">
                                    <?php foreach ($groups as $key => $month): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-2">
                                            <?= $month->nombre ?>
                                            <span class="badge badge-center text-primary w-min"><?= $month->hallazgos ?></span>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endforeach ?>
                        </div>

                        <?php foreach ($months_chunks as $key => $groups): ?>
                            <div class="d-none">
                                <?php foreach ($groups as $key => $month): ?>
                                    <div class="d-flex align-items-center border-bottom w-100">
                                        <!-- <span class="text-primary me-2"><i class="ri-circle-fill ri-12px"></i></span> -->
                                        <div>
                                            <p class="mb-0"><?= $month->nombre ?></p>
                                            <h5 class="mb-0"><?= $month->hallazgos ?></h5>
                                        </div>
                                    </div>
                                    <!-- <div class="d-flex align-items-baseline my-10">
                                        <span class="text-success me-2"><i class="ri-circle-fill ri-12px"></i></span>
                                        <div>
                                            <p class="mb-0">Music</p>
                                            <h5 class="mb-0">14%</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <span class="text-danger me-2"><i class="ri-circle-fill ri-12px"></i></span>
                                        <div>
                                            <p class="mb-0">React</p>
                                            <h5 class="mb-0">10%</h5>
                                        </div>
                                    </div> -->
                                <?php endforeach ?>
                            </div>
                        <?php endforeach ?>


                        <!-- <div>
                            <div class="d-flex align-items-baseline">
                                <span class="text-info me-2"><i class="ri-circle-fill ri-12px"></i></span>
                                <div>
                                    <p class="mb-0">UX Design</p>
                                    <h5 class="mb-0">20%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline my-10">
                                <span class="text-secondary me-2"><i class="ri-circle-fill ri-12px"></i></span>
                                <div>
                                    <p class="mb-0">Animation</p>
                                    <h5 class="mb-0">12%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <span class="text-warning me-2"><i class="ri-circle-fill ri-12px"></i></span>
                                <div>
                                    <p class="mb-0">SEO</p>
                                    <h5 class="mb-0">9%</h5>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ Topic you are interested in -->

        <div class="col-lg-5 col-md-12 col-sm-12">
            <div class="row h-100">
                <div class="col-12">
                    <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Top marcas más atacadas</h5>
                        </div>
                        <div class="dropdown">
                        <button
                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                            type="button"
                            id="deliveryExceptionsReasons"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-line ri-20px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="deliveryExceptionsReasons">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="deliveryExceptionsChart"></div>
                    </div>
                    </div>
                </div>
                <!--/ Reasons for delivery exceptions -->

                <!-- Assignment Progress -->
                <div class="col-12 mt-5">
                    <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Distribución por tipo de similitud</h5>
                        <div class="dropdown">
                        <button
                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                            type="button"
                            id="assignProgress"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-line ri-20px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="assignProgress">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">View All</a>
                        </div>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <ul class="p-0 m-0 row h-100">
                            <li class="d-flex mb-2 col-lg-6 col-md-12 col-sm-12 align-items-center justify-content-center">
                                <div
                                class="chart-progress me-4"
                                data-color="primary"
                                data-series="45"
                                data-progress_variant="true"></div>
                                <div class="row w-100 align-items-center">
                                    <div class="col-9">
                                        <div class="me-2">
                                        <h6 class="mb-2">% Fonética</h6>
                                        <p class="mb-0 small">45 Hallazgos</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 col-lg-6 col-md-12 col-sm-12 align-items-center justify-content-center">
                                <div
                                class="chart-progress me-4"
                                data-color="success"
                                data-series="20"
                                data-progress_variant="true"></div>
                                <div class="row w-100 align-items-center">
                                <div class="col-9">
                                    <div class="me-2">
                                    <h6 class="mb-2">% Fuzzy</h6>
                                    <p class="mb-0 small">20 Hallazgos</p>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 col-lg-6 col-md-12 col-sm-12 align-items-center justify-content-center">
                                <div
                                class="chart-progress me-4"
                                data-color="danger"
                                data-series="17"
                                data-progress_variant="true"></div>
                                <div class="row w-100 align-items-center">
                                <div class="col-9">
                                    <div class="me-2">
                                    <h6 class="mb-2">% Semántica</h6>
                                    <p class="mb-0 small">17 Hallazgos</p>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="d-flex mb-2 col-lg-6 col-md-12 col-sm-12 align-items-center justify-content-center">
                                <div
                                class="chart-progress me-4"
                                data-color="info"
                                data-series="18"
                                data-progress_variant="true"></div>
                                <div class="row w-100 align-items-center">
                                <div class="col-9">
                                    <div class="me-2">
                                    <h6 class="mb-2">% Figurativa</h6>
                                    <p class="mb-0 small">18 Hallazgos</p>
                                    </div>
                                </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <!--/ Assignment Progress -->

            </div>
        </div>

        <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="card h-100" style="min-height: 1000px">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Heatmap de clases Niza</h5>
                    <div class="dropdown">
                        <button
                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                            type="button"
                            id="topic"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-line ri-20px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="topic">
                            <a class="dropdown-item" href="javascript:void(0);">Highest Views</a>
                            <a class="dropdown-item" href="javascript:void(0);">See All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="heatMapChart"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-ms-12 col-sm-12">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Hallazgos por clase</h5>
                    <div class="dropdown">
                        <button
                            class="btn btn-text-secondary rounded-pill text-muted border-0 p-1"
                            type="button"
                            id="assignProgress"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="ri-more-2-line ri-20px"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="assignProgress">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" href="javascript:void(0);">View All</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="treemap"></div>
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

                                            <div class="col-lg-6 col-md-12 col-sm-12">
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

                                            <div class="col-lg-6 col-md-12 col-sm-12">
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

                                            <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                <div class="form-floating form-floating-outline">
                                                    <select class="select2 form-select required" data-allow-clear="false" id="brand-propia-add" name="brand-propia-add" aria-describedby="brand-propia-Help">
                                                        <option value=""></option>
                                                        <?php foreach (getBrands() as $key => $brand): ?>
                                                            <option value="<?= $brand->id ?>"><?= "$brand->Marca" ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <label for="brand-propia-add">Marca propia</label>
                                                </div>

                                                <div id="brand-propia-Help" class="form-text"></div>
                                            </div>

                                            <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="unit" placeholder="" aria-describedby="unitHelp">
                                                    <label for="unit">Unidad de negocio</label>
                                                    <span class="form-floating-focused"></span>
                                                </div>
                                                <div id="unitHelp" class="text-red"></div>
                                            </div>

                                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
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

                                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                                <div class="w-100 border px-5">
                                                    <small class="text-light fw-medium">Umbral mínimo de similitud</small>
                                                    <div id="slider-handles-3" class="mt-2 mb-12"></div>
                                                    <!-- <input class="form-control" type="file" id="formFile"> -->
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

    </div>
</div>

<?= $this->endsection('content') ?>

<?= $this->section('javaScripts') ?>
    <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/apex-charts/apexcharts.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/nouislider/nouislider.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>

    <script src="<?= base_url(['assets/js/forms-sliders.js?v='.getCommit()]) ?>"></script>
    <script>
        const months_chunks = <?= json_encode($months_chunks) ?>;
        const months        = <?= json_encode($months) ?>;
        const brands        = <?= json_encode($brands) ?>;
        const seriesTreemap   = <?= json_encode($seriesTreemap) ?>;
        const coloresGenerados   = <?= json_encode($coloresGenerados) ?>;
        const mapheat   = <?= json_encode($mapheat) ?>;
    </script>

    <script src="<?= base_url(['master/js/vigiamarca/report.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>