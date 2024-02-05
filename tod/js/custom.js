$(document).ready(function () {

    $('.postbutton').on('click', function (e) {

        e.preventDefault();

        var formData = $('#postform').serialize();

        $.ajax({
            url: '/create',
            method: 'post',
            data: formData,
            'X-CSRF-TOKEN': $("input[name='_token']").val(),
            success: function (data) {
                console.log(data);
                var datalist = $('.listdata');

                var ulis = $("<ul>");
                $.each(data, function (i, item) {
                    ulis.append("<li>" + item + "</li>");
                })
                ulis.append("</ul><button class='delete text-danger' value=" + data.id + ">Delete </button><button class='pl-2 update text-primary' value="+data.id+">Update</button>")

                datalist.append(ulis);

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
});
