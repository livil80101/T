<?php ?>

<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {

                $('button').click(function () {
                    var _file = document.getElementById('f').files[0];
                    var img=document.getElementById('img');

                    var fr = new FileReader();
                    fr.onload = function () {
//                        console.log(_file);
                        img.src=fr.result;
                    };
                    
                    fr.readAsDataURL(_file);

                });
            });
        </script>
    </head>
    <body>
        <input id="f" type="file" accept=".jpg,.jpeg,.png,.bmp">
        <button>GO</button>
        <hr>
        <img id="img" src="" alt="回傳結果">
    </body>
</html>