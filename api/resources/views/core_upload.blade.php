@section('core_upload')
<body>
<div id="app" class="d-inline-flex">
    <create-event-component></create-event-component>
</div>
<div class="d-flex align-items-start">
    <button type="button" class="btn btn-primary" style="margin-left: 1%;"  data-toggle="modal" data-target="#uploadModal">
        เพิ่มรูปภาพ
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header" style="background-color:#c4e6d2">
        <h5 class="modal-title" id="uploadModalLabel">อัปโหลดรูปด้านล่าง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    <form class="form-group" method="post" action="/api/img/upload" id="upload" enctype="multipart/form-data">
        Owner Id: <br><br> <input type="text" name="owner_id"><br><br>
        ชื่ออัลบั้ม <br><br> <input type="text" name="name" placeholder="Please provide album name"><br><br>
        <input type="file" name="file[]" multiple><br><br>
        <button type="submit" class="btn btn-primary" >อัปโหลด</button>
    </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
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

        }
    }

</script>
@show
