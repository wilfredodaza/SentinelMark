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

        <div class="col-md-6 col-sm-12 col-lg-4">
            <div class="card h-100">
                <div class="card-header pb-xl-7">
                    <div class="d-flex align-items-center mb-1 flex-wrap">
                        <h5 class="mb-0 me-1">Cumplimiento de plazos (%)</h5>
                        <p class="mb-0 text-success">32 / 50</p>
                    </div>
                    <span class="d-block card-subtitle">Actuaciones enviadas antes de su vencimiento / total del periodo</span>
                </div>
                <div class="card-body pb-xl-8">
                    <div id="overviewChart" class="d-flex align-items-center"></div>
                </div>
            </div>
        </div>
        <!--/ overview Radial chart -->

        <!-- Total Impression & Order Chart -->
        <!-- <div class="col-lg-4 col-md-6 col-sm-12">
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
        </div> -->
        <!--/ Total Impression & Order Chart -->

        <!-- visits By Day Chart-->
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">Litigios próximos a vencer</h5>
                    </div>
                    <p class="mb-0 card-subtitle">Total: 36</p>
                </div>
                <div class="card-body">
                    <div id="salesCountryChart"></div>
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

        

        <div class="col-md-6 col-sm-12 col-lg-4">
            <div class="card h-100">
                <div class="card-header pb-xl-7">
                    <div class="d-flex align-items-center mb-1 flex-wrap">
                        <h5 class="mb-0 me-1">Éxito en recursos (%)</h5>
                        <p class="mb-0 text-success">41 / 50</p>
                    </div>
                    <span class="d-block card-subtitle">Recursos favorables / total resueltos</span>
                </div>
                <div class="card-body pb-xl-8">
                    <div id="overviewChart2" class="d-flex align-items-center"></div>
                </div>
            </div>
        </div>
        <!--/ overview Radial chart -->

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
                                                        <select class="select2 form-select required" data-allow-clear="true" id="tipo-filter" name="tipo"  aria-describedby="tipoHelp">
                                                            <option value=""></option>
                                                            <option value="Colombia">Requerimiento</option>
                                                            <option value="Colombia">Recurso</option>
                                                            <option value="Colombia">Litigio</option>
                                                        </select>
                                                        <label for="tipo-filter">Tipo</label>
                                                    </div>
                
                                                    <div id="tipoHelp" class="form-text"></div>
                                                </div>
                                                
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="estado-filter" name="estado"  aria-describedby="estadoHelp">
                                                            <option value=""></option>
                                                            <option value="Registrada">Pendiente</option>
                                                            <option value="En trámite">En borrador</option>
                                                            <option value="Aprobada">Enviado</option>
                                                            <option value="Rechazada">En decisión</option>
                                                            <option value="Rechazada">Cerrado</option>
                                                        </select>
                                                        <label for="estado-filter">Estado</label>
                                                    </div>
                
                                                    <div id="estadoHelp" class="form-text"></div>
                                                </div>
                                            </div>
                
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="pais-filter" name="pais"  aria-describedby="paisHelp">
                                                            <option value=""></option>
                                                            <option value="Registrada">Co</option>
                                                            <option value="En trámite">Br</option>
                                                            <option value="Aprobada">Ec</option>
                                                        </select>
                                                        <label for="pais-filter">Pais</label>
                                                    </div>
                
                                                    <div id="paisHelp" class="form-text"></div>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="clasesNiza" name="clasesNiza" aria-describedby="clase-niza-Help" multiple>
                                                            <option value=""></option>
                                                            <?php foreach ($clasesNiza as $key => $niza): ?>
                                                                <option value="<?= $niza->id ?>"><?= $niza->id ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <label for="clasesNiza">Clases Niz</label>
                                                    </div>

                                                    <div id="clase-niza-Help" class="form-text"></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="abogado-filter" name="abogado"  aria-describedby="abogadoHelp" multiple>
                                                            <option value=""></option>
                                                            <option value="Registrada">Laura Gómez</option>
                                                            <option value="En trámite">Carlos Perez</option>
                                                            <option value="Aprobada">Sofia Ruiz</option>
                                                        </select>
                                                        <label for="abogado-filter">Abogado</label>
                                                    </div>
                
                                                    <div id="abogadoHelp" class="form-text"></div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control date-input" id="date" value="" aria-describedby="dateHelp" placeholder="YYYY-MM-DD">
                                                        <label for="date">Fecha solicitud</label>
                                                    </div>                                    
                                                    <div id="dateHelp" class="text-red"></div>
                                                </div>
                                            </div>
                
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" data-allow-clear="true" id="riesgo-filter" name="riesgo"  aria-describedby="riesgoHelp">
                                                            <option value=""></option>
                                                            <option value="Registrada">Bajo</option>
                                                            <option value="En trámite">Medio</option>
                                                            <option value="Aprobada">Alto</option>
                                                        </select>
                                                        <label for="riesgo-filter">Riesgo</label>
                                                    </div>
                
                                                    <div id="riesgoHelp" class="form-text"></div>
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
    <script src="<?= base_url(['assets/js/app-ecommerce-dashboard.js?v='.getCommit()]) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>
    <script src="<?= base_url(['assets/js/dashboards-analytics.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>

    <script>
        const info_page = <?= json_encode($data) ?>;
    </script>

    <script src="<?= base_url(['master/js/brand_defense/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>