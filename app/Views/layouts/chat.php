<div class="chat-container">
    <button type="button" class="btn btn-label-primary btn-lg btn-icon btn-float"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasScroll"
        aria-controls="offcanvasScroll">
        <span class="icon-chat">
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
    </button>
</div>

<div
    class="offcanvas offcanvas-end"
    data-bs-scroll="true"
    data-bs-backdrop="false"
    tabindex="-1"
    id="offcanvasScroll"
    aria-labelledby="offcanvasScrollLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasScrollLabel" class="offcanvas-title">Sentinel Chat</h5>
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body h-100 my-auto mx-0 flex-grow-0">
        <div class="app-chat card overflow-hidden h-100">
            <div class="row g-0 h-100">

                <!-- Chat History -->
                <div class="col app-chat-history h-100">
                    <div class="chat-history-wrapper h-100">
                        <div class="chat-history-body h-100">
                            <ul class="list-unstyled chat-history" style="height: 100%;">
                            <li class="chat-message chat-message-right">
                                <div class="d-flex overflow-hidden">
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                    <p class="mb-0">How can we help? We're here for you! 😄</p>
                                    </div>
                                    <div class="text-end text-muted mt-1">
                                    <i class="ri-check-double-line ri-14px text-success me-1"></i>
                                    <small>10:00 AM</small>
                                    </div>
                                </div>
                                <div class="user-avatar flex-shrink-0 ms-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="chat-message">
                                <div class="d-flex overflow-hidden">
                                <div class="user-avatar flex-shrink-0 me-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                    <p class="mb-0">Hey John, I am looking for the best admin template.</p>
                                    <p class="mb-0">Could you please help me to find it out? 🤔</p>
                                    </div>
                                    <div class="chat-message-text mt-2">
                                    <p class="mb-0">It should be Bootstrap 5 compatible.</p>
                                    </div>
                                    <div class="text-muted mt-1">
                                    <small>10:02 AM</small>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="chat-message chat-message-right">
                                <div class="d-flex overflow-hidden">
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                    <p class="mb-0">Materialize has all the components you'll ever need in a app.</p>
                                    </div>
                                    <div class="text-end text-muted mt-1">
                                    <i class="ri-check-double-line ri-14px text-success me-1"></i>
                                    <small>10:03 AM</small>
                                    </div>
                                </div>
                                <div class="user-avatar flex-shrink-0 ms-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="chat-message">
                                <div class="d-flex overflow-hidden">
                                <div class="user-avatar flex-shrink-0 me-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                    <p class="mb-0">Looks clean and fresh UI. 😃</p>
                                    </div>
                                    <div class="chat-message-text mt-2">
                                    <p class="mb-0">It's perfect for my next project.</p>
                                    </div>
                                    <div class="chat-message-text mt-2">
                                    <p class="mb-0">How can I purchase it?</p>
                                    </div>
                                    <div class="text-muted mt-1">
                                    <small>10:05 AM</small>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="chat-message chat-message-right">
                                <div class="d-flex overflow-hidden">
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                    <p class="mb-0">Thanks, you can purchase it.</p>
                                    </div>
                                    <div class="text-end text-muted mt-1">
                                    <i class="ri-check-double-line ri-14px text-success me-1"></i>
                                    <small>10:06 AM</small>
                                    </div>
                                </div>
                                <div class="user-avatar flex-shrink-0 ms-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="chat-message">
                                <div class="d-flex overflow-hidden">
                                <div class="user-avatar flex-shrink-0 me-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                    <p class="mb-0">I will purchase it for sure. 👍</p>
                                    </div>
                                    <div class="chat-message-text mt-2">
                                    <p class="mb-0">Thanks.</p>
                                    </div>
                                    <div class="text-muted mt-1">
                                    <small>10:08 AM</small>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="chat-message chat-message-right">
                                <div class="d-flex overflow-hidden">
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                    <p class="mb-0">Great, Feel free to get in touch.</p>
                                    </div>
                                    <div class="text-end text-muted mt-1">
                                    <i class="ri-check-double-line ri-14px text-success me-1"></i>
                                    <small>10:10 AM</small>
                                    </div>
                                </div>
                                <div class="user-avatar flex-shrink-0 ms-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="chat-message">
                                <div class="d-flex overflow-hidden">
                                <div class="user-avatar flex-shrink-0 me-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                <div class="chat-message-wrapper flex-grow-1">
                                    <div class="chat-message-text">
                                    <p class="mb-0">Do you have design files for Materialize?</p>
                                    </div>
                                    <div class="text-muted mt-1">
                                    <small>10:15 AM</small>
                                    </div>
                                </div>
                                </div>
                            </li>
                            <li class="chat-message chat-message-right">
                                <div class="d-flex overflow-hidden">
                                <div class="chat-message-wrapper flex-grow-1 w-50">
                                    <div class="chat-message-text">
                                    <p class="mb-0">
                                        Yes that's correct documentation file, Design files are included with the template.
                                    </p>
                                    </div>
                                    <div class="text-end text-muted mt-1">
                                    <i class="ri-check-double-line ri-14px me-1"></i>
                                    <small>10:15 AM</small>
                                    </div>
                                </div>
                                <div class="user-avatar flex-shrink-0 ms-4">
                                    <div class="avatar avatar-sm">
                                    <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                                    </div>
                                </div>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Chat History -->

              <div class="app-overlay"></div>
            </div>
        </div>
    </div>
    <div class="offcanvas-footer mx-5 my-5">
        
        <form class="form-send-message d-flex justify-content-between align-items-center mb-5">
            <input
                class="form-control message-input me-4 shadow-none"
                placeholder="Type your message here..." />
            <div class="message-actions d-flex align-items-center">
                <button class="btn btn-primary d-flex send-msg-btn">
                <i class="ri-send-plane-line ri-16px ms-md-2 ms-0"></i>
                </button>
            </div>
        </form>
        <button
            type="button"
            class="btn btn-outline-secondary d-grid w-100"
            data-bs-dismiss="offcanvas">
            Cerrar
        </button>
    </div>
</div>