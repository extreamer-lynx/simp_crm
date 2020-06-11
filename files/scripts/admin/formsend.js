function send(id, url) {

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
            $(id).on('submit', submitForm);
        }

        return {
            init: init
        }

    })(jQuery);


    jQuery(document).ready(app.init);
};

send('#categoryAdd','/adminpanel/CategoryAdd')
send('#categoryDel','/adminpanel/CategoryDel')
send('#delProd','/adminpanel/DelProd')



function delUser(id) {
    $.ajax({
            url: '/adminpanel/DeleteProd',
            data: 'id='+id,
            type: 'POST',
            success: function (responce) {
                let parser = new DOMParser();
                let doc = parser.parseFromString(responce, "text/html");
                var jsonData = JSON.parse(doc.getElementById('resultQuery').innerText);

                if (jsonData.success === 1) {
                    //(document.getElementById(result)).innerText = jsonData.text;
                    (document.getElementById('resultModal')).getElementsByClassName('modal-body')[0].innerText = jsonData.text;
                    $("#resultModal").modal("show");
                } else {
                    alert('ERROR:' + jsonData.text);
                }
            }
        }
    );
}

function chngStat(id,status) {
    $.ajax({
            url: '/adminpanel/ChangeStatus',
            data: 'id='+id+'&status='+status,
            type: 'POST',
            success: function (responce) {
                let parser = new DOMParser();
                let doc = parser.parseFromString(responce, "text/html");
                var jsonData = JSON.parse(doc.getElementById('resultQuery').innerText);

                if (jsonData.success === 1) {
                    //(document.getElementById(result)).innerText = jsonData.text;
                    (document.getElementById('resultModal')).getElementsByClassName('modal-body')[0].innerText = jsonData.text;
                    $("#resultModal").modal("show");
                } else {
                    alert('ERROR:' + jsonData.text);
                }
            }
        }
    );
}