<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
        <div class="container">
            <div class="row">
        <div class="card row-d-flex justify-content-center text-center" style="width: 28rem;"  >
            <div class="card-header">
                <h4>Laravel ajax file upload</h4>
            </div>
                <div class="card-body">
                    <input id="FileID" class="form-control mb-4" type="file">
                    <button onclick="touch()"  id="uploadId" class="btn-block btn-primary mt-4 p-1">Upload</button>
                   <h3 id="UploadPercentageID"></h3>
                </div>
         </div>
          <div class="col-md-4 card text-center p-3 m-4">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>No</td>
                            <td>Download</td>
                        </tr>
                        </thead>

                        <tbody class="tableData">

                        </tbody>
                    </table>

                </div>
        </div>

    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript">
        getFileList();
        function getFileList(){
            axios.get('/fileList').then(function (response) {
                let jsonData= response.data;
                $.each(jsonData,function(i) {
                    $('<tr>').html(
                        "<td>"+jsonData[i].id+"</td> " +
                        "<td><button data-path="+jsonData[i].file_path+"class='btn downloadBtn btn-primary'>Download</button></td>"
                    ).appendTo('.tableData');
                });
            }).catch(function (error) {
            })
        }





        function touch(){
           // let spinner="<div class='spinner-border spinner-border-sm' role='status' ></div>";
           // $('#uploadId').html(spinner);
            let myFile= document.getElementById('FileID').files[0];
            let fileName=myFile.name;
            let fileSize=myFile.size;
            let fileFormat=fileName.split('.').pop();

            let fileData= new FormData();
            fileData.append('fileKey', myFile)
            let config={
                headers:{'content-type':'multiple/form-data'},
                onUploadProgress:function (progressEvent) {
                    let UploadPercentage=  (Math.round(progressEvent.loaded * 100)/progressEvent.total)
                    $('#UploadPercentageID').html(UploadPercentage + "%")
                }




            };
            let url='/fileUp';

            axios.post(url, fileData, config)
            .then(function (response) {
                if(response.status==200){
                    $('#UploadPercentageID').html('Upload Success');
                    setTimeout(function () {
                        $('#UploadPercentageID').html(" ");
                    },3000)
                }else{
                    $('#UploadPercentageID').html('Upload Fail');
                    setTimeout(function () {
                        $('#UploadPercentageID').html(' ');
                    },3000)
                }

            }).catch(function (error) {
                $('#UploadPercentageID').html('Upload Fail');
                setTimeout(function () {
                    $('#UploadPercentageID').html(' ');
                },3000)

            });

        }

    </script>
</body>
    </html>

