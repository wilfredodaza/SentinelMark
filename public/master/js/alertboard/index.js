$(() => {
    const dropzoneBasicCreated = document.querySelector('#dropzone-basic-created');
    if (dropzoneBasicCreated) {
        const myDropzone = new Dropzone(dropzoneBasicCreated, {
        previewTemplate: previewTemplate(),
            parallelUploads: 1,
            maxFilesize: 5,
            addRemoveLinks: true,
            maxFiles: 1
        });
    }

    // const calendarEl = document.getElementById('calendar'),
    //     appCalendarSidebar = document.querySelector('.app-calendar-sidebar'),
    //     addEventSidebar = document.getElementById('addEventSidebar');

    
})