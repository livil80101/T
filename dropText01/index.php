<?php ?>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="dropzone.js"></script>

    </head>
    <body>
        <div id="dropz" style="width: 400px;height: 300px; background-color: gainsboro">
<!--            <form action="f.php" method="post" enctype="multipart/form-data" style="display: none;">
                <input type="file" name="file">
            </form>-->
        </div>
        <p id="pp"></p>
        <p id="pp2"></p>
                
        <script>
            $(document).ready(function () {
                var dropz = new Dropzone('#dropz', {
                    url: 'f.php',
                    thumbnailWidth: 120,
                    thumbnailHeight: 120,
                    maxFilesize: 10,
                    addRemoveLinks: true
                });
                dropz.on("totaluploadprogress", function (progress) {
                    $('#pp').html(progress + '%');
                });
                dropz.on("uploadprogress", function (data, progress, bytesSent) {
                    $('#pp2').html(progress + '%');
                });
                dropz.on("success", function () {
                    $('.dz-error-mark').hide();
                });
            });
        </script>

    </body>
</html>