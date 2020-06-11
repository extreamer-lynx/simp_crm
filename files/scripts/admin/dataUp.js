function send(id, url, resultForm) {

    var app = (function ($) {

        function submitForm(e) {
            e.preventDefault()

            // Відправка на сервер
            $.ajax({
                    url: url,
                    data: $(id).serialize(),
                    type: 'POST',
                    success: function (responce) {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(responce, "text/html");
                        var jsonData = JSON.parse(doc.getElementById('result').innerText);
                        if(jsonData.success == 1)
                        {
                            for (let pair of jsonData.text) {
                                console.log(`Ключ = ${pair[0]}, значение = ${pair[1]}`);
                            }
                        }
                        else
                        {
                            alert('error');
                        }

                    }
                }
            );
        }

        function init() {
            $(id).on('submit', submitForm);
        }

        return {
            init: init
        }

    })(jQuery);


    jQuery(document).ready(app.init);
};

