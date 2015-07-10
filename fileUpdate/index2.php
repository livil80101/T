<?php ?>

<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $('input[type="button"]').click(function () {

                    var f = document.getElementById('f');

                    var data = f.files[0];
                    var fd = new FormData();
                    fd.append('file', data);

                    $.ajax({
                        url: "fu_2.php",
                        contentType: false,
                        processData: false,
                        dataType: 'JSON',
                        type: 'POST',
                        data: fd,
                        success: function (data, textStatus, jqXHR) {
                            if (data.result) {

                                console.log(data.url);

                            }
                        }
                    });

                });

                $(':file').change(function () {
//                    console.log('AAAAAA');
                    var f = document.getElementById('inp_f2');

                    var data = this.files[0];
                    var fd = new FormData();
                    fd.append('file', data);
                    
                    $.ajax({
                        url: "fu_2.php", 
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,                       
                        type: 'POST',
                        data: fd,
                        error: function (jqXHR, textStatus, errorThrown) {
                            
                        },
                        success: function (data, textStatus, jqXHR) {
//                            console.log(data);
                            if (data.result) {
                                console.log(data.time);
                                $('#show').attr('src', data.url);

                            }
                        }
                    });
                });
//                $(':file').off('change');
            });
        </script>
    </head>
    <body>
        <form  method ="post" enctype="multipart/form-data" >
            <input id="f" name="file" type="file" accept=".png,.jpg,.jpeg">
            <input type="button" value="GO">
        </form>
        <form id="f2" action="fu_2.php" method="post">
            <input id="inp_f2" type="file"  accept=".png,.jpg,.jpeg">
            <input type="submit">
        </form>
        <img id="show">
    </body>
</html>