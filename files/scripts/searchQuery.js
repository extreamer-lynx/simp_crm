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

                    if (jsonData.success === 1) {
                        (document.getElementById('resultModal')).getElementsByClassName('modal-body')[0].innerText = jsonData.text;
                        $("#resultModal").modal("show");
                    } else {

                        if(Array.isArray(jsonData.text))
                        {
                            let err = '';
                            for(let er in jsonData.text)
                            {
                                for(let er2 in jsonData.text) {
                                    if(jsonData.text[er] === jsonData.text[er2] & er != er2)
                                        jsonData.text[er2] = '';
                                    err += jsonData.text[er] + '\n';
                                }
                            }
                            (document.getElementById('resultModal')).getElementsByClassName('modal-body')[0].innerText = err;
                            $("#resultModal").modal("show");
                        }
                        else {
                            (document.getElementById('resultModal')).getElementsByClassName('modal-body')[0].innerText = jsonData.text;
                            $("#resultModal").modal("show");
                        }
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