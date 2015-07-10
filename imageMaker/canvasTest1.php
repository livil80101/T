<?php ?>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                var img = document.getElementById('im');
                var cav = document.getElementById('cav');

                var ctx = cav.getContext('2d');

//                ctx.drawImage(img, 0, 0);
//                ctx.drawImage(img, 0, 0, 256, 133, 0, 0, 256, 123);
                ctx.font = "72px 新細明體";
                ctx.fillText("AAAAA", 0, 0);
                ctx.fillText("BBBBB", 0, 72);

                var img_output = document.getElementById('im_output');

//                img_output.src = cav.toDataURL("image/png");

            });
        </script>
    </head>
    <body>
        <canvas id="cav" width="800" height="600"></canvas>
        <img id="im" src="../image/R.png">
        <img id="im_output">
    </body>
</html>
