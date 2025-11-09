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
                        <div class="card px-5 py-3">
                            <div class="card-header py-0 pb-2 align-items-center border-bottom d-flex flex-wrap">
                                
                                <h5 class="card-action-title card-title mb-0">Resumen General</h5>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Marca Propia: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "{$detail->Marca_Referencia->Marca}" ?> <a href="<?= base_url(['dashboard/brand_portfolio', $detail->Marca_Referencia->id]) ?>" target="_blank"><i class="fa-duotone fa-regular fa-link"></i></a></dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Marca Opositora: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "{$detail->Marca_Opositora->Marca}" ?> <a href="<?= base_url(['dashboard/brand_portfolio', $detail->Marca_Opositora->id]) ?>" target="_blank"><i class="fa-duotone fa-regular fa-link"></i></a></dd>
    
                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Estado: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "$detail->estado" ?></dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">País/Jurisdicción: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "$detail->pais" ?></dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Tipo Causal: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "$detail->tipo_causal" ?></dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Número de expediente: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "{$detail->Marca_Referencia->Expediente}" ?></dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Fechas clave: </dt>
                                        <dd class="col-sm-7 col-xxl-8">
                                            <ul>
                                                <li><b>Recepción:</b> 15-06-2025 </li>
                                                <li><b>Envío oposición:</b> 15-08-2025 </li>
                                                <li><b>Ddecisión:</b> 15-10-2025 </li>
                                            </ul>
                                        </dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Abogado responsable: </dt>
                                        <dd class="col-sm-7 col-xxl-8">
                                            <?= "$detail->abogado_asignado" ?>
                                        </dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Score de riesgo: </dt>
                                        <dd class="col-sm-7 col-xxl-8">
                                            <?= "$detail->riesgo - $detail->nivel%" ?>
                                        </dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Observaciones: </dt>
                                        <dd class="col-sm-7 col-xxl-8">
                                            <?= "$detail->observation" ?>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade card-action"  id="navs-pills-detail-2" role="tabpanel"><!-- Matriz de riesgo -->
                        <div class="card px-5 py-3">
                            <div class="card-header py-0 pb-2 align-items-center border-bottom d-flex flex-wrap">
                                
                                <h5 class="card-action-title card-title mb-0">Matriz de riesgo</h5>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Factor</th>
                                            <th>Peso</th>
                                            <th>Regla/Medición</th>
                                            <th>Notas</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>Similitud denominativa</td>
                                            <td>25%</td>
                                            <td>Embeddings/text distance ≥ umbral</td>
                                            <td>De VigíaMarca</td>
                                        </tr>

                                        <tr>
                                            <td>Similitud figurativa</td>
                                            <td>15%</td>
                                            <td>Embeddings imagen (CLIP) si aplica</td>
                                            <td>Opcional en MVP</td>
                                        </tr>

                                        <tr>
                                            <td>Coincidencia clases Niza</td>
                                            <td>15%</td>
                                            <td>Intersección clases</td>
                                            <td>Mayor intersección, mayor riesgo</td>
                                        </tr>

                                        <tr>
                                            <td>Uso previo del término</td>
                                            <td>10%</td>
                                            <td>Evidencias de uso interno</td>
                                            <td>Aporta defensa/ataque</td>
                                        </tr>

                                        <tr>
                                            <td>Histórico de conflictos</td>
                                            <td>10%</td>
                                            <td># casos previos cerrados</td>
                                            <td>Mayor historial = ↑ riesgo</td>
                                        </tr>

                                        <tr>
                                            <td>Fuerza distintiva</td>
                                            <td>15%</td>
                                            <td>Manual (Bajo/Medio/Alto)</td>
                                            <td>Normalizado a 0 - 100</td>
                                        </tr>

                                        <tr>
                                            <td>Plazo restante</td>
                                            <td>10%</td>
                                            <td>Días a vencimiento</td>
                                            <td>Menos días = ↑ prioridad</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade card-action"  id="navs-pills-detail-3" role="tabpanel"><!-- Documentos Adjuntos -->
                        <div class="card px-5 py-3">
                            <!-- <div class="card-header py-0 pb-2 align-items-center border-bottom d-flex flex-wrap">
                                
                                <h5 class="card-action-title card-title mb-0">Documentos Adjuntos</h5>
                            </div> -->
                            <div class="card-datatable table-responsive pt-0">
                                <table class="datatables-basic-1 table table-bordered"></table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade card-action"  id="navs-pills-detail-4" role="tabpanel"><!-- Plantillas recomendadas (DocuLaw) -->
                        <div class="card px-5 py-3">
                            <div class="card-header py-0 pb-2 align-items-center border-bottom d-flex flex-wrap">
                                
                                <h5 class="card-action-title card-title mb-0">Plantillas recomendadas (DocuLaw)</h5>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Plantilla sugerida</th>
                                            <th>Uso</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>Oposición por causal absoluta</td>
                                            <td>Vicios de registrabilidad, descriptividad, genericidad</td>
                                        </tr>

                                        <tr>
                                            <td>Oposición por confusión</td>
                                            <td>Comparativo denominativo/figurativo, canales de comercialización</td>
                                        </tr>

                                        <tr>
                                            <td>Competencia desleal</td>
                                            <td>Aprovechamiento de reputación ajena, desvío de clientela</td>
                                        </tr>

                                        <tr>
                                            <td>Recurso de reposición</td>
                                            <td>Contra decisiones desfavorables</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-pills-detail-5" role="tabpanel">

                        <div class="col-12 col-xxl-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title mb-0">Linea de tiempo</h5>
                                    </div>
                                </div>
                                <div class="card-body pt-4">
                                    <ul class="timeline card-timeline mb-0">
                                        <?php foreach(array_reverse($detail->events) as $evento): ?>
                                            <li class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point timeline-point-<?= $evento->color == "azul" ? "primary" : 
                                                    ($evento->color == 'verde' ? 'success' : 
                                                        ($evento->color == 'naranja' ? 'warning' : 'danger') ) ?>"></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-3">
                                                    <h6 class="mb-0"><?= $evento->tipo ?></h6>
                                                    <?= $evento->tiempo ?>
                                                    </div>
                                                    <p class="mb-2"><?= $evento->descripcion ?></p>
                                                    <div class="d-flex align-items-center mb-1">
                                                        <div class="badge bg-lighter rounded-3">
                                                            <a href="<?= $evento->documento ?>" target="_blank">
                                                                <img src="../../assets//img/icons/misc/pdf.png" alt="img" width="15" class="me-2">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between flex-wrap gap-2 mb-1_5">
                                                        <div class="d-flex flex-wrap align-items-center">
                                                            <div class="avatar avatar-sm me-2">
                                                            <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                                                            </div>
                                                            <div>
                                                            <p class="mb-0 small fw-medium">Wilfredo Daza</p>
                                                            <small>Administrador</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
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
                    id="canvasAddDocAdjunto"
                    aria-labelledby="canvasAddDocAdjuntoLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasAddDocAdjuntoLabel" class="offcanvas-title">Añadir Documento Adjunto</h4>
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
                                            <select class="select2 form-select required" data-allow-clear="false" id="clase-niza-add" onchange="changeClaseNiza(this.value)" name="clase-niza-add" aria-describedby="clase-niza-add-help">
                                                <option value=""></option>                                          
                                                <option value="NN">NN</option>                                          
                                            </select>
                                            <label for="clase-niza-add">Tipo*</label>
                                        </div>
                                        <div id="clase-niza-add-help" class="form-text"></div>
                                    </div>                                    
    
                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control date-input" id="name-fecha" value="" aria-describedby="name-fecha-help" placeholder="">
                                            <label for="name-fecha">Fecha *</label>
                                        </div>                                    
                                        <div id="name-fecha-help" class="text-red"></div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="name-version" value="" aria-describedby="name-version-help" placeholder="">
                                            <label for="name-version">Version *</label>
                                        </div>                                    
                                        <div id="name-version-help" class="text-red"></div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="name-enlace" value="" aria-describedby="name-enlace-help" placeholder="">
                                            <label for="name-enlace">Enlace *</label>
                                        </div>                                    
                                        <div id="name-enlace-help" class="text-red"></div>
                                    </div>
                                </div>
    
                            </form>

                            <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0" id="dropzone-basic-add-doc">
                                <div class="dz-message needsclick m-0 py-5">
                                    Arrastra el archivo aquí o haz clic para subirlo.
                                </div>
                                <div class="fallback">
                                <input name="file" type="file" />
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
        const detail = (<?= json_encode($detail) ?>);
    </script>


    <script src="<?= base_url(['master/js/trademark_protection/detail.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>