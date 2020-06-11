var app = (function ($) {

    function submitForm(e) {
        e.preventDefault()

        // Відправка на сервер
        $.ajax({
                url: $('#categoryButton').attr('name'),
                type: 'GET',
                success: function (responce) {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(responce, "text/html");
                    var jsonData = JSON.parse(doc.getElementById('resultQuery').innerText);

                    if (jsonData.success === 1) {
                        $('#label').html(jsonData.category);
                        console.log(jsonData.text);
                        $('div#products').html(jsonData.text);
                    }
                }
            }
        );
    }

    function init() {
        $('#categoryButton').on('click', submitForm);
    }

    return {
        init: init
    }

})(jQuery);


jQuery(document).ready(app.init);