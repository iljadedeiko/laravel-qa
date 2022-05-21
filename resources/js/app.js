/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./fontawesome');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(document).ready(function () {
    setTimeout(function() {
        $('#alert_message, #forgot_password, #invalid_file_path').fadeOut('slow',function() {
            $('#alert_message, #forgot_password, #invalid_file_path').remove();
        });
    }, 2000);

    setTimeout(function() {
        $('#error_message').fadeOut('slow',function() {
            $('#error_message').remove();
        });
    }, 4000);

    setTimeout(function() {
        $('#invalid_token').fadeOut('slow',function() {
            $('#invalid_token').remove();
        });
    }, 6000);

    tinymce.init({
        selector: '#question_textarea, #answer_textarea',
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount image paste'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

    $('#user_profile_avatar').on('change', function(e) {
        $(this).closest('form').submit();
    });
});

