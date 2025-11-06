<?php $menus = menus(); ?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url(['dashboard']) ?>" class="app-brand-link">
            <span class="app-brand-logo demo">
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
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2"><?= isset(configInfo()['name_app']) ? configInfo()['name_app'] : 'Name' ?></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
                    fill-opacity="0.9" />
                <path
                    d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
                    fill-opacity="0.4" />
            </svg>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Apps & Pages -->
        <li class="menu-header mt-5">
            <span class="menu-header-text" data-i18n="Menú">Menú</span>
        </li>

        <li class="menu-item <?= isActive(base_url(['dashboard'])) ?>">
            <a href="<?= base_url(['dashboard']) ?>" class="menu-link">
                <i class="menu-icon tf-icons ri-home-4-fill"></i>
                <div data-i18n="Home">Home</div>
            </a>
        </li>

        <?php foreach($menus as $key => $menu): ?>
            <?php if(count($menu->sub_menu) == 0): ?>
                <li class="menu-item <?= isActive($menu->base_url) ?>">
                    <a href="<?= $menu->base_url ?>" class="menu-link">
                        <?php if(!empty($menu->icon)): ?>
                            <i class="menu-icon tf-icons <?= $menu->icon ?>"></i>
                        <?php else: ?>
                            <i class="menu-icon tf-icons ri-radio-button-line"></i>
                        <?php endif ?>
                        <div data-i18n="<?= $menu->option ?>"><?= $menu->option ?></div>
                    </a>
                </li>
            <?php else: ?>
                <li class="menu-item <?= subActive($menu->id) ?>">
                    <a href="<?= $menu->base_url ?>" class="menu-link menu-toggle">
                        <?php if(!empty($menu->icon)): ?>
                            <i class="menu-icon tf-icons <?= $menu->icon ?>"></i>
                        <?php else: ?>
                            <i class="menu-icon tf-icons ri-radio-button-line"></i>
                        <?php endif ?>
                        <div data-i18n="<?= $menu->option ?>"><?= $menu->option ?></div>
                    </a>
                    <ul class="menu-sub">
                        <?php foreach ($menu->sub_menu as $key => $sub_menu): ?>
                            <li class="menu-item  <?= isActive($sub_menu->base_url) ?>">
                                <a href="<?= $sub_menu->base_url ?>" class="menu-link">
                                    <div data-i18n="<?= $sub_menu->option ?>"><?= $sub_menu->option ?></div>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>
            <?php endif ?>
        <?php endforeach ?>

        <li class="menu-item <?= isActive(base_url(['password'])) ?>">
            <a href="<?= base_url(['password']) ?>" class="menu-link">
                <i class="menu-icon tf-icons ri-lock-password-line"></i>
                <div data-i18n="Renovar Contraseña">Renovar Contraseña</div>
            </a>
        </li>
    </ul>
</aside>