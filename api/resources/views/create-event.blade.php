<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('js/app.js') }}"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Create Event</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/app.css">
        <style>

        </style>
    </head>
    <body>
    <div id="app">
        <create-event-component></create-event-component>
    </div>

    <button type="button" class="btn btn-primary" style="margin-left: 10%" data-toggle="modal" data-target="#exampleModal">
        UPLOAD IMAGE
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form class="form-group" method="post" action="/api/img/upload" id="upload" enctype="multipart/form-data">
            Owner Id: <br><br> <input type="text" name="owner_id"><br><br>
            SET NAME <br><br> <input type="text" name="name" placeholder="Please provide album name"><br><br>
            <input type="file" name="file[]" multiple><br><br>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!-- End Modal -->

    </body>
</html>

<script>
    var form = document.getElementById("upload");
    var request = new XMLHttpRequest();

    function form.addEventListener('submit',function(e)){
        e.preventDefault();
        var formdata = new FormData(form);

        request.open('post','/api/img/upload');
        request.addEventListener("load",transferComplete);
        request.send(formdata);
    };

    function transferComplete(data){
        response = JSON.parse(data.currentTarget.response);
        if(response.success){
            console.log("success");
        }
    }

</script>
