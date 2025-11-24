<?= $this->extend('layouts/page'); ?>

<?= $this->section('title'); ?> <?= $data->title ?? 'Titulo' ?><?= $this->endSection(); ?>


<?= $this->section('styles') ?>
    <?= $this->include('layouts/css_datatables') ?>
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/fullcalendar/fullcalendar.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/pages/app-calendar.css']) ?>" />
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

        <div class="col-lg-12">
            <div class="card h-100">
                <div class="card-body d-flex justify-content-around flex-wrap gap-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-green rounded">
                                <i class="ri-checkbox-multiple-line ri-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">95%</h5>
                            <p class="mb-0">Cumplimiento de plazos</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-orange rounded">
                                <i class="ri-calendar-schedule-line ri-24px"></i>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">90%</h5>
                            <p class="mb-0">Eventos críticos atendidos a tiempo</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-pink rounded">
                                <i class="ri-notification-3-line ri-24px"></i>
                                <!-- <i class="ri-pie-chart-2-line"></i> -->
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">684</h5>
                            <p class="mb-0">Alertas enviadas</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar">
                            <div class="avatar-initial bg-label-blue rounded">
                                <i class="ri-check-double-line ri-24px"></i>
                                <!-- <i class="ri-pie-chart-2-line"></i> -->
                            </div>
                        </div>
                        <div class="card-info">
                            <h5 class="mb-0">78%</h5>
                            <p class="mb-0">Tasa de lectura</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-xxl-12">
            <div class="card">
            <div class="card app-calendar-wrapper">
                <div class="row g-0">
                  <!-- Calendar Sidebar -->
                  <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
                    <div class="p-5 my-sm-0 mb-4 border-bottom">
                      <button
                        class="btn btn-primary btn-toggle-sidebar w-100"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#addEventSidebar"
                        aria-controls="addEventSidebar">
                        <i class="ri-add-line ri-16px me-1_5"></i>
                        <span class="align-middle">Crear Alerta</span>
                      </button>
                    </div>
                    <div class="px-4">
                      <!-- inline calendar (flatpicker) -->
                      <!-- <div class="inline-calendar"></div> -->

                      <!-- <hr class="mb-5 mx-n4 mt-3" /> -->
                      <!-- Filter -->
                      <div class="mb-4 ms-1 mt-1">
                        <h5>Filtros</h5>
                      </div>

                      <!-- <div class="form-check form-check-secondary mb-5 ms-3">
                        <input
                          class="form-check-input select-all"
                          type="checkbox"
                          id="selectAll"
                          data-value="all"
                          checked />
                        <label class="form-check-label" for="selectAll">Ver todos</label>
                      </div> -->



                      <div class="app-calendar-events-filter text-heading">

                        <div class="col-lg-12 col-md-12 col-sm-12 my-0">
                            <div class="form-floating form-floating-outline mb-6">
                                <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" placeholder="Realiza tu busqueda"></textarea>
                                <label for="exampleFormControlTextarea1">Busca todo en un mismo lugar.</label>
                            </div>
                        </div>

                        <hr>

                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select required input-filter" id="pais-filter" name="pais-filter" aria-describedby="pais-add-help" multiple>
                                    <option value=""></option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="mexico">Mexico</option>
                                    <option value="EEUU">Estados unidos</option>
                                </select>
                                <label for="pais-filter">Jurisdicción/País *</label>
                            </div>

                            <div id="pais-filter-help" class="form-text"></div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select required input-filter" id="tipo-filter" name="tipo-filter" aria-describedby="tipo-add-help" multiple>
                                    <option value=""></option>
                                    <?php foreach($tipos as $tipo): ?>
                                        <option value="<?= $tipo->id ?>"><?= $tipo->name ?></option>
                                    <?php endforeach ?>
                                </select>
                                <label for="tipo-filter">Tipo *</label>
                            </div>

                            <div id="tipo-filter-help" class="form-text"></div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control input-filter" id="unit-add" placeholder="" aria-describedby="unit-addHelp">
                                <label for="unit-add">Unidad de negocio</label>
                                <span class="form-floating-focused"></span>
                            </div>
                            <div id="unit-addHelp" class="text-red"></div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                            <div class="form-floating form-floating-outline input-filter">
                                <select class="select2 form-select required" data-allow-clear="true" id="agente-add" name="agente-add" aria-describedby="estadoHelp" multiple>
                                    <option value=""></option>
                                    <option value="Laura Gómez">Laura Gómez</option>
                                    <option value="Carlos Pérez">Carlos Pérez</option>
                                    <option value="Sofía Ruiz">Sofía Ruiz</option>
                                </select>
                                <label for="agente-add">Agente *</label>
                            </div>

                            <div id="agente-addHelp" class="form-text">

                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                            <div class="form-floating form-floating-outline">
                                <select class="select2 form-select required" data-allow-clear="true" id="clasesNiza-filter" name="clasesNiza-filter" aria-describedby="clase-niza-Help" multiple>
                                    <option value=""></option>
                                    <?php foreach ($clasesNiza as $key => $niza): ?>
                                        <option value="<?= $niza->id ?>"><?= $niza->id ?></option>
                                    <?php endforeach ?>
                                </select>
                                <label for="clasesNiza-filter">Clases Niza *</label>
                            </div>

                            <div id="clase-niza-Help" class="form-text"></div>
                        </div>

                        

                        <div class="form-check form-check-danger mb-5 ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-personal"
                            data-value="personal"
                            checked />
                          <label class="form-check-label" for="select-personal">Crítica</label>
                        </div>
                        <div class="form-check mb-5 ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-business"
                            data-value="business"
                            checked />
                          <label class="form-check-label" for="select-business">Alta</label>
                        </div>
                        <div class="form-check form-check-warning mb-5 ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-family"
                            data-value="family"
                            checked />
                          <label class="form-check-label" for="select-family">Media</label>
                        </div>
                        <div class="form-check form-check-success mb-5 ms-3">
                          <input
                            class="form-check-input input-filter"
                            type="checkbox"
                            id="select-holiday"
                            data-value="holiday"
                            checked />
                          <label class="form-check-label" for="select-holiday">Baja</label>
                        </div>

                        
                      </div>
                    </div>
                  </div>
                  <!-- /Calendar Sidebar -->

                  <!-- Calendar & Modal -->
                  <div class="col app-calendar-content">
                    <div class="card shadow-none border-0">
                      <div class="card-body pb-0">
                        <!-- FullCalendar -->
                        <div id="calendar"></div>
                      </div>
                    </div>
                    <div class="app-overlay"></div>
                    <!-- FullCalendar Offcanvas -->
                    <div
                      class="offcanvas offcanvas-end event-sidebar"
                      tabindex="-1"
                      id="addEventSidebar"
                      aria-labelledby="addEventSidebarLabel">
                      <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title" id="addEventSidebarLabel">Añadir alerta</h5>
                        <button
                          type="button"
                          class="btn-close text-reset"
                          data-bs-dismiss="offcanvas"
                          aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body">
                        <form class="event-form pt-0" id="eventForm" onsubmit="return false">

                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control input-filter" id="title-add" placeholder="" aria-describedby="title-addHelp">
                                    <label for="title-add">Titulo *</label>
                                    <span class="form-floating-focused"></span>
                                </div>
                                <div id="title-addHelp" class="text-red"></div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required input-filter" id="tipo-add" name="tipo-add" aria-describedby="tipo-add-help">
                                        <option value=""></option>
                                        <?php foreach($tipos as $tipo): ?>
                                            <option value="<?= $tipo->id ?>"><?= $tipo->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="tipo-add">Tipo *</label>
                                </div>

                                <div id="tipo-add-help" class="form-text"></div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required input-filter" id="marca-add" name="marca-add" aria-describedby="tipo-add-help">
                                        <option value=""></option>
                                        <?php foreach($marcas as $marca): ?>
                                            <option value="<?= $marca->id ?>"><?= $marca->nombre_corto ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="marca-add">Marca *</label>
                                </div>

                                <div id="marca-add-help" class="form-text"></div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required input-filter" id="pais-add" name="pais-add" aria-describedby="pais-add-help">
                                        <option value=""></option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="mexico">Mexico</option>
                                        <option value="EEUU">Estados unidos</option>
                                    </select>
                                    <label for="pais-add">Jurisdicción/País *</label>
                                </div>

                                <div id="pais-add-help" class="form-text"></div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required" data-allow-clear="true" id="clasesNiza-Add" name="clasesNiza-Add" aria-describedby="clase-niza-Help" multiple>
                                        <option value=""></option>
                                        <?php foreach ($clasesNiza as $key => $niza): ?>
                                            <option value="<?= $niza->id ?>"><?= $niza->id ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="clasesNiza-Add">Clases Niza *</label>
                                </div>

                                <div id="clase-niza-Help" class="form-text"></div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline">
                                    <select class="select2 form-select required" data-allow-clear="true" id="recordatorios-Add" name="recordatorios-Add" aria-describedby="recordatorios-Help" multiple>
                                        <option value=""></option>
                                        <?php foreach ($recordatorios as $key => $recordatorio): ?>
                                            <option value="<?= $recordatorio->id ?>"><?= $recordatorio->text ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="recordatorios-Add">Recordatorios *</label>
                                </div>

                                <div id="recordatorios-Help" class="form-text"></div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 my-2">
                                <div class="form-floating form-floating-outline input-filter">
                                    <select class="select2 form-select required" data-allow-clear="true" id="responsable-add" name="responsable-add" aria-describedby="estadoHelp">
                                        <option value=""></option>
                                        <option value="Laura Gómez">Laura Gómez</option>
                                        <option value="Carlos Pérez">Carlos Pérez</option>
                                        <option value="Sofía Ruiz">Sofía Ruiz</option>
                                    </select>
                                    <label for="responsable-add">Responsable *</label>
                                </div>

                                <div id="responsable-addHelp" class="form-text">

                                </div>
                            </div>
                            <div class="form-floating form-floating-outline mb-5">
                              <input
                                type="text"
                                class="form-control"
                                id="eventEndDate"
                                name="eventEndDate"
                                placeholder="Fecha limite" />
                              <label for="eventEndDate">Fecha limite</label>
                            </div>

                          <div class="mb-5">
                            <div class="form-check form-switch">
                              <input type="checkbox" class="form-check-input allDay-switch" id="notification-1" />
                              <label class="form-check-label text-green" for="notification-1"><i class="ri-whatsapp-line"></i> WhatsApp</label>
                            </div>
                          </div>

                          <div class="mb-5">
                            <div class="form-check form-switch">
                              <input type="checkbox" class="form-check-input allDay-switch" id="notification-2" />
                              <label class="form-check-label text-orange text-darken-5" for="notification-2"><i class="ri-google-fill"></i> Correo Electronico</label>
                            </div>
                          </div>
                          
                          
                        </form>

                        <form action="/upload" class="dropzone needsclick d-flex justify-content-center my-2 p-0" id="dropzone-basic-created">
                            <div class="dz-message needsclick m-0 py-5">
                                Arrastra los archivos aquí o haz clic para subirlo.
                            </div>
                            <div class="fallback">
                                <input name="file" type="file" />
                            </div>
                        </form>
                        <div class="mb-5 d-flex justify-content-sm-between justify-content-start my-6 gap-2">
                            <div class="d-flex">
                                <button type="submit" id="addEventBtn" class="btn btn-primary btn-add-event me-4">
                                    Guardar
                                </button>
                                <button
                                    type="reset"
                                    class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                                    data-bs-dismiss="offcanvas">
                                    Cancel
                                </button>
                            </div>
                            <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
                        </div>
                        </div>
                    </div>
                  </div>
                  <!-- /Calendar & Modal -->
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection('content') ?>

<?= $this->section('javaScripts') ?>
    <script src="<?= base_url(['assets/vendor/libs/fullcalendar/fullcalendar.js']) ?>"></script>
    
    <script src="<?= base_url(['assets/vendor/libs/@form-validation/popular.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/@form-validation/bootstrap5.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/@form-validation/auto-focus.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/moment/moment.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>
    <script src="<?= base_url(['assets/js/app-calendar-events.js']) ?>"></script>
    <script src="<?= base_url(['assets/js/app-calendar.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/dropzone/dropzone.js']) ?>"></script>
    <?= $this->include('layouts/js_datatables') ?>


    <script src="<?= base_url(['master/js/alertboard/index.js?v='.getCommit()]) ?>"></script>
<?= $this->endsection('javaScript') ?>