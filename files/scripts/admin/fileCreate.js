'use strict';


var app = (function ($) {

    function validateFiles(options) {
        var result = [],
            file;


        options.$files.each(function (index, $file) {

            if (!$file.files.length) {
                result.push({index: index, errorCode: 'Немає файлу'});

                return result;
            }

            file = $file.files[0];

            if (file.size > options.maxSize) {
                result.push({index: index, name: file.name, errorCode: 'Завеликий файл'});
            }

            if (options.types.indexOf(file.type) === -1) {
                result.push({index: index, name: file.name, errorCode: 'Неправильний тип файлу'});
            }
        });

        return result;
    }

    function submitForm(e) {
        e.preventDefault();

        var $photos = $('.js-photos'),
            formdata = new FormData,
            validationErrors = validateFiles({
                $files: $photos,
                maxSize: 2 * 1024 * 1024,
                types: ['image/jpeg', 'image/jpg', 'image/png']
            });

        // Валидация
        if (validationErrors.length) {
            let text = '';
            for (let err in validationErrors) {
                text += validationErrors[err]['errorCode'] + ' \n';
            }

            (document.getElementById('resultModal')).getElementsByClassName('modal-body')[0].innerText = 'Помилка при завантаженні фото: ' + text;
            $("#resultModal").modal("show");
            return false;
        }

        $photos.each(function (index, $photo) {
            if ($photo.files.length) {
                formdata.append('photos[]', $photo.files[0]);
            }
        });
        // Відправка на сервер
        $.ajax({
                url: '/adminpanel/addProd?' + $('form#addProduct').serialize(),
                data: formdata,
                type: 'POST',
                dataType: false,
                processData: false,
                beforeSend: function () {

                    // Перед загрузкой файла
                    $('#progressStatus').text('Завантаження файлу');
                },
                contentType: false,
                success: function (responce) {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(responce, "text/html");
                    var jsonData = JSON.parse(doc.getElementById('resultQuery').innerText);

                    if (jsonData.success === 1) {
                        (document.getElementById('resultModal')).getElementsByClassName('modal-body')[0].innerText = jsonData.text;
                        $("#resultModal").modal("show");
                    }
                    else
                    {
                        alert('ERROR: ' + jsonData.text);
                    }
                }
            }
    );
    }

    function init() {
        $('#addProduct').on('submit', submitForm);
    }

    return {
        init: init
    }

})(jQuery);


jQuery(document).ready(app.init);