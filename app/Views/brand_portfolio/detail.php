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
                            <h3 class="mb-0"><?= $data->title ?? 'Titulo' ?></h3>
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
                        <div class="card px-5 py-3">
                            <div class="card-header py-0 pb-2 align-items-center border-bottom d-flex flex-wrap">
                                
                                <h5 class="card-action-title card-title mb-0">Resumen General</h5>
                                <!-- <h5 class="card-action-title mb-0 ">
                                    <span class="d-flex">
                                        <?= $detail->Marca ?>
                                    </span>
                                </h5> -->
                                <div class="card-action-element">

                                    <button class="btn btn-primary waves-effect waves-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#canvasEditBrand" aria-controls="offcanvasEnd">
                                        <i class="ri-edit-line ri-14px me-1"></i>Editar
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Signo distintivo: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "$detail->Marca" ?></dd>

                                        <?php if($detail->logo): ?>
                                        
                                            <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Logo: </dt>
                                            <dd class="col-sm-7 col-xxl-8">
                                                <div class="avatar avatar d-flex justify-content-center align-items-center me-4 logo">
                                                    <a href="javascript:void(0);" onclick="viewImage(`<?= 'master/imgs/branding/logo-'.$detail->logo ?>`)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-original-title="Ver">
                                                        <img src="<?= base_url(['master/imgs/branding', "logo-".$detail->logo]) ?>" alt="Avatar" class="">
                                                    </a>
                                                </div>
                                                    <!-- <i class="ri-file-image-line"></i> -->
                                            </dd>
                                        <?php endif ?>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Tipo: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "$detail->icon - $detail->Tipo" ?></dd>
    
                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Jurisdicción: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "$detail->País" ?></dd>
    
                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Estado Empresa: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "{$detail->company_state->title}" ?></dd>

                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Estado Entidad: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= "{$detail->entity_state->title}" ?></dd>
    
                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Número expediente: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><a href="javascript:void(0)"><i class="tf-icons ri-file-line me-2"></i> <?= "$detail->Expediente" ?></a></dd>
    
                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Descripción comercial: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= $detail->descripcion_comercial ?></dd>
    
                                        <dt class="col-sm-5 col-xxl-4 mb-2 d-flex align-items-center text-nowrap fw-medium text-heading">Observaciones del abogado: </dt>
                                        <dd class="col-sm-7 col-xxl-8"><?= $detail->descripcion_abogado ?></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade "  id="navs-pills-detail-2" role="tabpanel"> <!-- Clases Niza -->
                        <!-- DataTable with Buttons -->
                        <div class="card">
                            <div class="card-datatable table-responsive pt-0 content-datatables-basic">
                            <table class="datatables-basic table table-bordered">
                            </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade card-action" id="navs-pills-detail-3" role="tabpanel"> <!-- Titular y agente -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card px-5 py-3">
                                    <div class="card-header align-items-center d-flex flex-wrap">
                                        <h5 class="card-title card-action-title mb-0">Titular</h5>
                                        <div class="card-action-element">
                                            <button class="btn btn-primary waves-effect waves-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#canvasEditBrand" aria-controls="offcanvasEnd">
                                                <i class="ri-edit-line ri-14px me-1"></i>Editar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body mt-2">
                                        <form action="">

                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="<?= $detail->Titular ?>" id="titular-name" placeholder="John Doe" aria-describedby="titular-name-help">
                                                        <label for="titular-name">Nombre Titular</label>
                                                        <div id="titular-name-help" class="form-text"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" id="tipo-persona" name="tipo-persona" aria-describedby="tipo-persona-help">
                                                            <option value=""></option>
                                                            <option value="Colombia" selected>Persona</option>
                                                            <option value="mexico">Empresa</option>
                                                        </select>
                                                        <label for="tipo-persona">Tipo de persona *</label>
                                                    </div>

                                                    <div id="tipo-persona-help" class="form-text"></div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <select class="select2 form-select required" id="tipo-identificacion" name="tipo-identificacion" aria-describedby="tipo-identificacion-help">
                                                            <option value=""></option>
                                                            <option value="Colombia" selected>Cedula</option>
                                                            <option value="mexico">NIT</option>
                                                            <option value="mexico">Cedula Extranjera</option>
                                                        </select>
                                                        <label for="tipo-identificacion">Tipo de Identificacion *</label>
                                                    </div>

                                                    <div id="tipo-identificacion-help" class="form-text"></div>
                                                </div>
                                            </div>
                                            <div class="row my-2">

                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="123456789" id="nit-titular" placeholder="John Doe" aria-describedby="nit-titular-help">
                                                        <label for="nit-titular">Identificacion</label>
                                                        <div id="nit-titular-help" class="form-text"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-sm-12">
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

                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="contacto@sentinel.com" id="email-notificacion" placeholder="John Doe" aria-describedby="email-notificacion-help">
                                                        <label for="email-notificacion">Email Contacto</label>
                                                        <div id="email-notificacion-help" class="form-text"></div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row my2">
                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="3004511625" id="phone-contact" placeholder="John Doe" aria-describedby="phone-contact-help">
                                                        <label for="phone-contact">Telefono</label>
                                                        <div id="phone-contact-help" class="form-text"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="Wilfredo Daza" id="name-contact-prinicpal" placeholder="John Doe" aria-describedby="name-contact-prinicpal-help">
                                                        <label for="name-contact-prinicpal">Contacto Principal</label>
                                                        <div id="name-contact-prinicpal-help" class="form-text"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="wilfredo@sentinel.com" id="email-contact-prinicipal" placeholder="John Doe" aria-describedby="email-contact-prinicipal-help">
                                                        <label for="email-contact-prinicipal">Correo Contacto</label>
                                                        <div id="email-contact-prinicipal-help" class="form-text"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-5">
                                <div class="card px-5 py-3">
                                    <div class="card-header align-items-center d-flex flex-wrap">
                                        <h5 class="card-title card-action-title mb-0">Agente</h5>
                                        <div class="card-action-element">
                                            <button class="btn btn-primary waves-effect waves-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#canvasEditBrand" aria-controls="offcanvasEnd">
                                                <i class="ri-edit-line ri-14px me-1"></i>Editar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body mt-2">
                                        <form action="">

                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="Abogado S.A.S" id="titular-name" placeholder="John Doe" aria-describedby="titular-name-help">
                                                        <label for="titular-name">Nombre del abogado / firma</label>
                                                        <div id="titular-name-help" class="form-text"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="123456789" id="titular-name" placeholder="John Doe" aria-describedby="titular-name-help">
                                                        <label for="titular-name">Matricula profesional</label>
                                                        <div id="titular-name-help" class="form-text"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-2">
                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="3001234567" id="nit-titular" placeholder="John Doe" aria-describedby="nit-titular-help">
                                                        <label for="nit-titular">Telefono</label>
                                                        <div id="nit-titular-help" class="form-text"></div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-12 col-sm-12">
                                                    <div class="form-floating form-floating-outline">
                                                        <input type="text" class="form-control" value="abogados@sentinel.com" id="contact-titular" placeholder="John Doe" aria-describedby="contact-titular-help">
                                                        <label for="contact-titular">Correo</label>
                                                        <div id="contact-titular-help" class="form-text"></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-pills-detail-4" role="tabpanel"> <!-- Documentos Vinculados -->
                        <div class="card">
                            <div class="card-datatable table-responsive pt-0">
                                <table class="datatables-basic-2 table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>Fecha</th>
                                            <th>Plantilla usada</th>
                                            <th>Estado</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-pills-detail-5" role="tabpanel"> <!-- Evidencias y Pruebas de Uso -->
                        <div class="card">
                            <div class="card-datatable table-responsive pt-0">
                                <table class="datatables-basic-3 table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Archivo</th>
                                            <th>Tipo</th>
                                            <th>Descripcion</th>
                                            <th>Fecha</th>
                                            <th>Enlace</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-pills-detail-6" role="tabpanel">
                        <div class="row g-6">
                            <div class="col-sm-12 col-lg-6 col-md-12">
                                <div class="card card-border-shadow-red h-100">
                                    <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="avatar me-4 d-flex justify-content-center">
                                            <span class="avatar-initial rounded-3 red lighten-5 text-red text-darken-5"><i class="ri-price-tag-3-line ri-24px"></i></span>
                                        </div>
                                        <h4 class="mb-0 d-flex justify-content-center">Costos De Presentación</h4>
                                    </div>
                                    <h5 class="mb-0 fw-normal">$ 1.800.000 <small class="text-muted">Primera clase</small></h5>
                                    <p class="mb-0">
                                        <span class="me-1 fw-medium">$ 1.288.000</span>
                                        <small class="text-muted">Clases Adicionales</small>
                                    </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 col-md-12">
                                <div class="card card-border-shadow-pink h-100">
                                    <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="avatar me-4 d-flex justify-content-center">
                                            <span class="avatar-initial rounded-3 pink lighten-5 text-pink text-darken-5"><i class="ri-currency-line ri-24px"></i></span>
                                        </div>
                                        <h4 class="mb-0 d-flex justify-content-center">Gastos de renovacion y vigilancia</h4>
                                    </div>
                                    <h5 class="mb-0 fw-normal">$ 1.800.000 <small class="text-muted">Primera clase</small></h5>
                                    <p class="mb-0">
                                        <span class="me-1 fw-medium">$ 1.288.000</span>
                                        <small class="text-muted">Clases Adicionales</small>
                                    </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="card card-border-shadow-amber h-100">
                                    <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="avatar me-4 d-flex justify-content-center">
                                            <span class="avatar-initial rounded-3 amber lighten-5 text-amber text-darken-5"><i class="ri-money-dollar-box-line ri-24px"></i></span>
                                        </div>
                                        <h4 class="mb-0 d-flex justify-content-center">Honorarios Abogados</h4>
                                    </div>
                                    <h5 class="mb-0 fw-normal">$ 12.800.000</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="card card-border-shadow-orange h-100">
                                    <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                        <div class="avatar me-4 d-flex justify-content-center">
                                            <span class="avatar-initial rounded-3 orange lighten-5 text-orange text-darken-5"><i class="ri-file-shield-line ri-24px"></i></span>
                                        </div>
                                        <h4 class="mb-0 d-flex justify-content-center">Gastos Defensa Judicial</h4>
                                    </div>
                                    <h5 class="mb-0 fw-normal">$ 15.800.000</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card h-100">
                                    <div class="card-header">
                                    <div class="d-flex justify-content-center ">
                                        <h5 class="mb-1">ROI Estimado</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center card-subtitle">
                                        <div class="me-2">$ 12.800.000</div>
                                    </div>
                                    </div>
                                    <div class="card-body d-flex justify-content-between flex-wrap gap-4">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                        <div class="avatar-initial green lighten-5 text-green text-darken-5 rounded">
                                            <i class="ri-shield-star-line ri-24px"></i>
                                        </div>
                                        </div>
                                        <div class="card-info">
                                        <h5 class="mb-0">$ 15.800.000</h5>
                                        <p class="mb-0">Licencias</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                        <div class="avatar-initial green darken-5 text-green text-lighten-5 rounded">
                                            <i class="ri-money-dollar-circle-line ri-24px"></i>
                                        </div>
                                        </div>
                                        <div class="card-info">
                                        <h5 class="mb-0">$ 7.800.000</h5>
                                        <p class="mb-0">Ingresos asociados</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                        <div class="avatar-initial pink lighten-5 text-pink text-darken-5 rounded">
                                            <i class="ri-wallet-line ri-24px"></i>
                                        </div>
                                        </div>
                                        <div class="card-info">
                                        <h5 class="mb-0">$ 10.800.000</h5>
                                        <p class="mb-0">Costos totales</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title me-2">
                                            Costos por año
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="lineAreaChart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title me-2">
                                            ROI Historico
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="lineAreaChart-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-pills-detail-7" role="tabpanel">
                        <div class="card">
                            <div class="card-datatable table-responsive pt-0">
                                <table class="datatables-basic-4 table table-bordered">
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="navs-pills-detail-8" role="tabpanel">

                        <div class="col-12 col-xxl-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title mb-0">Linea de tiempo</h5>
                                    </div>
                                </div>
                                <div class="card-body pt-4">
                                    <ul class="timeline card-timeline mb-0">
                                        <?php foreach($eventos_sic as $evento): ?>
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
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasEditBrand"
                    aria-labelledby="canvasEditBrandLabel">
                    <div class="offcanvas-header pb-0">
                        <h4 id="canvasEditBrandLabel" class="offcanvas-title">Editar marca</h4>
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
                                        <input type="text" class="form-control required" value="<?= $detail->Marca ?>" id="marca-edit" placeholder="" aria-describedby="marca-edit-help">
                                        <label for="marca-edit">Nombre de la marca *</label>
                                        <span class="form-floating-focused"></span>
                                    </div>
                                    <div id="marca-edit-help" class="text-red"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="tipo-edit" name="tipo-edit" aria-describedby="tipo-edit-help" onchange="changeTipo(this.value)">
                                            <option value=""></option>
                                            <option value="Denominativa" <?= $detail->Tipo == 'Denominativa' ? 'selected' : '' ?> >Denominativa</option>
                                            <option value="Figurativa" <?= $detail->Tipo == 'Figurativa' ? 'selected' : '' ?> >Figurativa</option>
                                            <option value="Mixta" <?= $detail->Tipo == 'Mixta' ? 'selected' : '' ?> >Mixta</option>
                                        </select>
                                        <label for="tipo-edit">Tipo</label>
                                    </div>
                                    <div id="tipo-edit-help" class="form-text"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" id="pais-edit" name="pais-edit" aria-describedby="pais-edit-help">
                                            <option value=""></option>
                                            <option value="Colombia" selected>Colombia</option>
                                            <option value="mexico">Mexico</option>
                                            <option value="EEUU">Estados unidos</option>
                                        </select>
                                        <label for="pais-edit">Jurisdicción *</label>
                                    </div>

                                    <div id="pais-edit-help" class="form-text"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="unit-edit" placeholder="" aria-describedby="unit-edit-help">
                                        <label for="unit-edit">Unidad de negocio</label>
                                        <span class="form-floating-focused"></span>
                                    </div>
                                    <div id="unit-edit-help" class="text-red"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-4 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="expediente" value="<?= $detail->Expediente ?>" aria-describedby="expediente-help" placeholder="">
                                        <label for="expediente">Expediente</label>
                                    </div>                                    
                                    <div id="expediente-help" class="text-red"></div>
                                </div>

                                <div class="col-lg-5 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="enlace-expediente" value="" aria-describedby="enlace-expediente-help" placeholder="https://www.ejemplo.com/docs/manual.pdf">
                                        <label for="enlace-expediente">Enlace expediente *</label>
                                    </div>                                    
                                    <div id="enlace-expediente-help" class="text-red"></div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control date-input" id="date" value="<?= $detail->Fecha_Solicitud ?>" aria-describedby="dateHelp" placeholder="YYYY-MM-DD">
                                        <label for="date">Fecha solicitud *</label>
                                    </div>                                    
                                    <div id="dateHelp" class="text-red"></div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="estado-empresa-edit" name="estado-empresa-edit" aria-describedby="estado-empresa-edit-help">
                                            <option value=""></option>
                                            <?php foreach($states_companies as $state): ?>
                                                <option value="<?= $state->id ?>" <?= $state->id == $detail->company_state->id ? 'selected' : '' ?> ><?= $state->title ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="estado-empresa-edit">Estado Empresa *</label>
                                    </div>
                                    <div id="estado-empresa-edit-help" class="form-text"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="estado-entidad-edit" name="estado-entidad-edit" aria-describedby="estado-entidad-edit-help">
                                            <option value=""></option>
                                            <?php foreach($states_entities as $state): ?>
                                                <option value="<?= $state->id ?>" <?= $state->id == $detail->entity_state->id ? 'selected' : '' ?> ><?= $state->title ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label for="estado-entidad-edit">Estado Entidad *</label>
                                    </div>
                                    <div id="estado-entidad-edit-help" class="form-text"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" id="descripcion-general" placeholder=""><?= $detail->descripcion_comercial ?></textarea>
                                        <label for="descripcion-general">Descripción General</label>
                                    </div>                                    
                                    <div id="descripcion-general" class="text-red"></div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" id="descripcion-lawyer" placeholder=""><?= $detail->descripcion_abogado ?></textarea>
                                        <label for="descripcion-lawyer">Descripción del abogado</label>
                                    </div>                                    
                                    <div id="descripcion-lawyer" class="text-red"></div>
                                </div>
                            </div>

                        </form>

                        

                        <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0 <?= $detail->Tipo == 'Denominativa' ? "d-none" : ""?>" id="dropzone-basic-edit">
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
                    class="offcanvas offcanvas-end"
                    tabindex="-2"
                    id="canvasAddClaseNiza"
                    aria-labelledby="canvasAddClaseNizaLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasAddClaseNizaLabel" class="offcanvas-title">Añadir Clase Niza</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        <span class="text-muted">Los campos con un asterisco (*) son requeridos para completar el formulario.</span>
                        <div class="row">
                            <div class="col-lg-4" id="add-niza-form">
                                <form action="">
        
                                    <div class="row">
        
                                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <select class="select2 form-select required" data-allow-clear="false" id="clase-niza-add" onchange="changeClaseNiza(this.value)" name="clase-niza-add" aria-describedby="clase-niza-add-help">
                                                    <option value=""></option>
                                                    <?php foreach($clasesNiza as $ey => $claseNiza): ?>
                                                        <option value="<?= $claseNiza->id ?>"><?= $claseNiza->id ?></option>
                                                    <?php endforeach ?>                                            
                                                </select>
                                                <label for="clase-niza-add">Clase Niza*</label>
                                            </div>
                                            <div id="clase-niza-add-help" class="form-text"></div>
                                        </div>
        
                                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <textarea class="form-control h-px-100" id="descripcion-clase-niza-add" placeholder=""></textarea>
                                                <label for="descripcion-clase-niza-add">Descripción</label>
                                            </div>                                    
                                            <div id="descripcion-clase-niza-add" class="text-red"></div>
                                        </div>
                                        
        
                                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="name-class-niza" value="" aria-describedby="name-class-niza-help" placeholder="">
                                                <label for="name-class-niza">Producto / Servicio *</label>
                                            </div>                                    
                                            <div id="name-class-niza-help" class="text-red"></div>
                                        </div>
                                    </div>
        
                                </form>
                            </div>

                            <div class="col-lg-8 app-chat" id="add-niza-chat">
                                <div class="col app-chat-history">
                                    <div class="chat-history-wrapper">
                                    <div class="chat-history-body ps ps--active-y">
                                        <ul class="list-unstyled chat-history">
                                        <li class="chat-message">
                                            <div class="d-flex overflow-hidden">
                                                <div class="user-avatar flex-shrink-0 ms-4">
                                                    <div class="avatar avatar-sm">
                                                    <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="chat-message-wrapper flex-grow-1">
                                                    <div class="chat-message-text">
                                                        <table border="0" cellpadding="8" cellspacing="0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Producto o grupo</th>
                                                                    <th>Clase Niza sugerida</th>
                                                                    <th>Descripción oficial de la clase</th>
                                                                    <th>Comentario</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Productos químicos para la industria, ciencia y fotografía</td>
                                                                    <td>1</td>
                                                                    <td>Productos químicos utilizados en la industria, ciencia y fotografía, así como en la agricultura, horticultura y silvicultura.</td>
                                                                    <td>Correcto ✅</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Productos químicos para la agricultura, horticultura y silvicultura</td>
                                                                    <td>1</td>
                                                                    <td>Incluye fertilizantes, productos para el tratamiento del suelo, etc.</td>
                                                                    <td>Correcto ✅</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Resinas artificiales en bruto, materias plásticas en bruto</td>
                                                                    <td>1</td>
                                                                    <td>Las resinas y plásticos en bruto se consideran materias primas químicas.</td>
                                                                    <td>Correcto ✅</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Abonos</td>
                                                                    <td>1</td>
                                                                    <td>Fertilizantes químicos para la agricultura.</td>
                                                                    <td>Correcto ✅</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Composiciones extinguidoras</td>
                                                                    <td>1</td>
                                                                    <td>Incluye espumas, polvos o gases para extinguir fuego.</td>
                                                                    <td>Correcto ✅</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Preparaciones para templar y soldar metales</td>
                                                                    <td>1</td>
                                                                    <td>Productos químicos para templar o soldar metales.</td>
                                                                    <td>Correcto ✅</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Productos para conservar alimentos</td>
                                                                    <td>1 o 29</td>
                                                                    <td>Si se trata de aditivos químicos → Clase 1. Si son alimentos conservados → Clase 29.</td>
                                                                    <td>Debes aclarar el uso ⚠️</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Adhesivos (pegamentos) para la industria</td>
                                                                    <td>1</td>
                                                                    <td>Adhesivos industriales, pegamentos y selladores químicos.</td>
                                                                    <td>Correcto ✅</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Bebidas alcohólicas</td>
                                                                    <td>33</td>
                                                                    <td>Vinos, licores, bebidas alcohólicas (excepto cervezas).</td>
                                                                    <td>No debe incluirse en la misma clase que productos químicos ❌</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <div class="text-muted mt-1">
                                                    <small>10:00 AM</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        </ul>
                                    <div class="ps__rail-x" style="left: 0px; bottom: -725px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 725px; height: 418px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 265px; height: 152px;"></div></div></div>
                                    <!-- Chat message form -->
                                    <div class="chat-history-footer">
                                        <form class="form-send-message d-flex justify-content-between align-items-center">
                                        <input class="form-control message-input me-4 shadow-none" placeholder="Type your message here...">
                                        <div class="message-actions d-flex align-items-center">
                                            
                                            <button class="btn btn-primary d-flex send-msg-btn waves-effect waves-light">
                                            <span class="align-middle">Send</span>
                                            <i class="ri-send-plane-line ri-16px ms-md-2 ms-0"></i>
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
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
                            <button
                                type="button"
                                onclick="validarListNiza()" disabled
                                id="btn-validar-niza"
                                class="btn btn-label-danger d-grid app-brand-logo demo">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 612 792" enable-background="new 0 0 612 792" xml:space="preserve">
                                    <g>
                                        <path fill="#<?= isset(configInfo()['primary_color']) && !empty(configInfo()['primary_color']) ? (string) configInfo()['primary_color'] : '8e24aa' ?>" d="M337,789.5c0.7-28.9,7.4-53.3,11.4-78c13.8-86,28.6-171.8,42.9-257.6c4.2-25,3.9-25.2,28.8-23.6
                                            c10.8,0.7,21.7,1.3,32.3,3.1c11.8,2,18.5-1.6,21.6-13.5c2.8-10.9,7.1-21.5,10.7-32.2c5.2-15.7,3.9-17.6-13.1-17.2
                                            c-32.7,0.7-62.6,12-91.9,25.1c-36.1,16.1-36,16.5-30.4,56.1c2.5,17.8,5.2,35.7,8.4,53.4c1.3,7.3,0.2,12.9-5.9,17.7
                                            c-12.1,9.6-24.1,19.4-35.7,29.6c-5.8,5.1-10.5,4.8-16.2,0c-11.4-9.7-22.9-19.3-34.6-28.5c-6-4.7-8-10.1-6.8-17.5
                                            c4.1-24.9,7.3-50,12.1-74.7c2.4-12.4,0.5-20-11.9-25.8c-35.6-16.6-71.3-32.7-111.2-35.3c-20.2-1.3-21.9,1.2-15.5,20.4
                                            c14.3,42.8,14.3,42.8,59.4,39.6c5.1-0.4,10.3,0,15.5-0.6c10.5-1.2,14.2,3.7,15.8,13.8c18.2,109.2,36.9,218.4,55.3,327.6
                                            c0.8,4.5,0.8,9.1,1.2,13.4c-5.7,3.1-8.4-1.1-11.4-3.3c-48.5-35-96.7-70.3-145.4-105c-9.5-6.8-13-14.2-12.8-25.7
                                            c0.6-43.8-0.1-87.7,0.5-131.5c0.1-10.9-3.4-17.7-13.4-21.4c-1.9-0.7-3.6-2.2-5.6-2.7c-30.1-7.9-38.5-28.3-40-58
                                            c-3-59.1-9.8-118.1-15.3-177.1c-0.7-7.9-0.2-15.3,3.3-22.5C92.7,124.7,176.7,45,295.3,3.1c8-2.8,15.6-3.2,23.9-0.3
                                            c118.3,41.2,202,120.3,256.6,232c8.2,16.8,3.2,33.6,1.9,50.1c-4.6,59.1-10.9,118.1-15.9,177.1c-0.9,11.1-4.6,17.4-15,22.3
                                            c-41.9,19.9-41.7,20.2-41.7,65.7c0,34.6,0,69.1,0,103.7c0,7.3-0.2,14.1-7.2,19.2C445.4,710.8,392.8,749,337,789.5z"/>
                                    </g>
                                </svg>
                                <!-- <i class="ri-shield-check-line"></i> -->
                                </button>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12">
                
                <div
                    class="offcanvas offcanvas-end width-add"
                    tabindex="-2"
                    id="canvasAddDoc"
                    aria-labelledby="canvasAddDocLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasAddDocLabel" class="offcanvas-title">Añadir Documento</h4>
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
                                        <input type="text" class="form-control" id="name-doc" value="" aria-describedby="name-doc-help" placeholder="">
                                        <label for="name-doc">Nombre *</label>
                                    </div>                                    
                                    <div id="name-doc-help" class="text-red"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="tipo-doc" name="tipo-doc" aria-describedby="tipo-doc-help">
                                            <option value=""></option>                                       
                                            <option value="oposición">Oposición</option>                                  
                                            <option value="requerimiento">Requerimiento</option>                                      
                                            <option value="resolución">Resolución</option>                              
                                            <option value="informe">Informe</option>                                       
                                        </select>
                                        <label for="tipo-doc">Tipo *</label>
                                    </div>
                                    <div id="tipo-doc-help" class="form-text"></div>
                                </div>                                

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="date-doc" value="<?= date('Y-m-d') ?>" aria-describedby="date-doc-help" placeholder="">
                                        <label for="date-doc">Fecha *</label>
                                    </div>                                    
                                    <div id="date-doc-help" class="text-red"></div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="true" id="template-doc" name="template-doc" aria-describedby="template-doc-help">
                                            <option value="">Defecto</option>                                       
                                            <option value="oposición">Template 1</option>                                  
                                            <option value="requerimiento">Template 2</option>                                      
                                            <option value="resolución">Template 3</option>                              
                                            <option value="informe">Template 4</option>                                       
                                        </select>
                                        <label for="template-doc">Plantilla</label>
                                    </div>
                                    <div id="template-doc-help" class="form-text"></div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <enlacev class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="enlace-doc" value="" aria-describedby="enlace-doc-help" placeholder="https://www.ejemplo.com/docs/manual_usuario.pdf">
                                        <label for="enlace-doc">Enlace</label>
                                    </enlacev>                                    
                                    <div id="enlace-doc-help" class="text-red"></div>
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
                    id="canvasAddEvidencia"
                    aria-labelledby="canvasAddEvidenciaLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasAddEvidenciaLabel" class="offcanvas-title">Añadir Evidencia</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        <span class="text-muted">Los campos con un asterisco (*) son requeridos para completar el formulario.</span>
                    
                        <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0" id="dropzone-basic-add-evidencia">
                            <div class="dz-message needsclick m-0 py-5">
                                Arrastra el archivo aquí o haz clic para subirlo.
                            </div>
                            <div class="fallback">
                            <input name="file" type="file" />
                            </div>
                        </form>
                        <form action="">

                            <div class="row">

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <select class="select2 form-select required" data-allow-clear="false" id="tipo-evidencia" name="tipo-evidencia" aria-describedby="tipo-evidencia-help">
                                            <option value=""></option>                                       
                                            <option value="oposición">Factura</option>                                  
                                            <option value="requerimiento">Publicidad</option>                                      
                                            <option value="resolución">Distribución</option>                              
                                            <option value="informe">Otros</option>                                       
                                        </select>
                                        <label for="tipo-evidencia">Tipo *</label>
                                    </div>
                                    <div id="tipo-evidencia-help" class="form-text"></div>
                                </div> 

                                <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="date-doc" value="<?= date('Y-m-d') ?>" aria-describedby="date-doc-help" placeholder="">
                                        <label for="date-doc">Fecha *</label>
                                    </div>                                    
                                    <div id="date-doc-help" class="text-red"></div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <enlacev class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="enlace-doc" value="" aria-describedby="enlace-doc-help" placeholder="https://www.ejemplo.com/docs/manual_usuario.pdf">
                                        <label for="enlace-doc">Enlace o fuente</label>
                                    </enlacev>                                    
                                    <div id="enlace-doc-help" class="text-red"></div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" id="descripcion-general" placeholder=""></textarea>
                                        <label for="descripcion-general">Descripción General</label>
                                    </div>                                    
                                    <div id="descripcion-general" class="text-red"></div>
                                </div>
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
                    class="offcanvas offcanvas-end"
                    tabindex="-2"
                    id="canvasCompletado"
                    aria-labelledby="canvasCompletadoLabel">
                    <div class="offcanvas-header">
                    <h4 id="canvasCompletadoLabel" class="offcanvas-title">Marcar completado</h4>
                    <button
                        type="button"
                        class="btn-close text-reset"
                        data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                        
                        <form action="">

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Marcar como completado</label>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" id="descripcion-general" placeholder=""></textarea>
                                        <label for="descripcion-general">Observación</label>
                                    </div>                                    
                                    <div id="descripcion-general" class="text-red"></div>
                                </div>
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
    <script src="<?= base_url(['assets/js/app-chat.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>

    <script>
        const info_page = <?= json_encode($data) ?>;
        const detail = (<?= json_encode($detail) ?>);
        const clasesNiza = <?= json_encode($clasesNiza) ?>;
    </script>

    <script src="<?= base_url(['master/js/brand_portfolio/detail.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>