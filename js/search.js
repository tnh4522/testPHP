// ajax search
$(document).ready(function () {
    $("#search").on("click", function () {
        const name = $(this).closest(".search_box").find("input").val();
        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {
                name: name
            },
            success: function (data) {
                data = JSON.parse(data);
                let html = '';
                Object.keys(data).map((key) => {
                    html = '<tr>';
                    html += `<td>${data[key].id}</td>`;
                    html += `<td> <a href='detail.php?id=${data[key].id}' type='button' class='btn btn-primary'>Voir</a></td>`;
                    html += `<tr>`;
                });
                $(".table tbody").html(html);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});