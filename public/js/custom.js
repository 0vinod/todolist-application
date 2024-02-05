$(document).ready(function () {

    $('.postbutton').on('click', function (e) {

        e.preventDefault();

        var formData = $('#postform').serialize();

        var params = new URLSearchParams(formData);

        method = 'post';
        url = "/create";

        if (params.has('id')) {
            method = 'put';
            url = "/update/" + params.get('id');
        }
        console.log(formData)
            ;
        $.ajax({
            url: url,
            method: method,
            data: formData,
            'X-CSRF-TOKEN': $("input[name='_token']").val(),
            success: function (datas) {

                var datalist = $('.listdata');

                if (datalist.find('ul').length > 0) {
                    datalist.find('ul').remove();
                }

                $.each(datas, function (is, data) {

                    var ulis = $("<ul>");

                    $.each(data, function (i, item) {
                        ulis.append("<li>" + item + "</li>");
                    })

                    ulis.append("</ul><button class='delete text-danger' value=" + data.id + ">Delete </button><button style='margin-left:5px;' class='update text-primary' value=" + data.id + ">Update</button>")

                    datalist.append(ulis);
                })
                $('#postform')[0].reset();
            }
        })
    })

    $('.listdata').on('click', '.delete', function (e) {

        e.preventDefault();
        var btnD = $(this)
        var id = btnD.val()


        $.ajax({
            url: '/delete/' + id,
            method: 'get',
            success: function (data) {
                console.log(data)
                btnD.closest('ul').remove()
            }
        })
    })

    $('.listdata').on('click', '.update', function (e) {
        e.preventDefault();

        var id = $(this).val();

        var closestUl = $(this).closest('ul');

        var name = closestUl.find('li').eq(1).text();
        var mobile = closestUl.find('li').eq(2).text();

        $('#postform').append("<input name='id' type='hidden' value=" + id + ">")

        $('#postform').find("input[name='name']").val(name)
        $('#postform').find("input[name='mobile']").val(mobile)
        console.log(name);
    })
});
