import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

import 'filepond/dist/filepond.min.css';

window.Alpine = Alpine;

Alpine.plugin(focus);

const inputElement = document.querySelector('input[type="file"]');

FilePond.registerPlugin(FilePondPluginFileValidateType);

const pond = FilePond.create(inputElement, {
    acceptedFileTypes: ['application/pdf'],
    server: {
        url: '/upload',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    allowMultiple: true,
    credits: false,
});

Alpine.start();
