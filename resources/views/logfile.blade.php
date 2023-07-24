<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Log File</title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
          integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="pb-13 pt-lg-0 pt-5">
            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Log File View</h3>
        </div>
        <div class="form-group">
            <label class="font-size-h6 font-weight-bolder text-dark">File Path</label>
            <input class="form-control" id="file_path" name="file_path" type="text">
        </div>
        <div class="pb-lg-0 pb-5">
            <button data-page="1" type="button"
                    class="submit_file btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">
                View
            </button>
        </div>

        <table class="table">
            <thead>

            </thead>
            <tbody class="tbody-lines">

            </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
        integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.submit_file,.first_page,.previous_page,.next_page,.last_page', function () {
        var page = $(this).data('page');

        $.ajax({
            url: "{{route('log-file-post')}}",
            method: "POST",
            data: {
                "file_path": $('#file_path').val(),
                "page": page
            },
            success: function (response) {
                console.log(response);
                row = ``;
                var start_column = response.start_column;
                $.each(response.lines, function (index, value) {
                    row += `
                        <tr>
                            <td style="width: 10%">${start_column++}</td>
                            <td>${value}</td>
                        </td>
                    `;
                });

                row += `
                    <tr>
                        <td>
                            <button data-page="${response.first_page}" class="first_page"> l< </button>
                            <button data-page="${response.previous_page}" class="previous_page"> < </button>
                        </td>
                        <td>
                            <button data-page="${response.next_page}" class="next_page"> > </button>
                            <button data-page="${response.last_page}" class="last_page"> >l </button>
                        </td>
                    </tr>
                `;

                $('.tbody-lines').html(row);
            }
        });
    });
</script>

</body>
</html>
