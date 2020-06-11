var app = (function ($) {

    function submitForm(e) {
        e.preventDefault()

        // Відправка на сервер
        $.ajax({
                url: $('#buyButton').attr('href'),
                data: $('#buyButton').serialize(),
                type: 'GET',
                success: function (responce) {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(responce, "text/html");
                    var jsonData = JSON.parse(doc.getElementById('resultQuery').innerText);

                    if (jsonData.success === 1) {
                        (document.getElementById('resultModal')).getElementsByClassName('modal-body')[0].innerText = jsonData.text;
                        $("#resultModal").modal("show");
                    } else {
                        alert('ERROR:' + jsonData.text);
                    }
                }
            }
        );
    }

    function init() {
        $('#buyButton').on('click', submitForm);
    }

    return {
        init: init
    }

})(jQuery);


jQuery(document).ready(app.init);