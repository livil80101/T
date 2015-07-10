<?php ?>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            var parent_l = 0;
            var parent_t = 0;

            var _show;

            var drag = {
                elem: null,
                x: 0,
                y: 0,
                state: false
            };
            var delta = {
                x: 0,
                y: 0
            };
//            $(document).ready(function () {
//                parent_l = $('.show').offset().left;
//                parent_t = $('.show').offset().top;
//
//                _show = $('.show');
//
//                _show.mousedown(function (e) {
//                    if (!drag.state) {
//                        drag.elem = this;
//                        this.style.backgroundColor = '#f00';
//                        drag.x = e.pageX;
//                        drag.y = e.pageY;
//                        drag.state = true;
//                    }
//                    return false;
//                });
//
//                $(document).mousemove(function (e) {
//                    if (drag.state) {
//                        drag.elem.style.backgroundColor = '#f0f';
//
//                        delta.x = e.pageX - drag.x;
//                        delta.y = e.pageY - drag.y;
//
//                        var cur_of = $(drag.elem).offset();
//
//                        $(drag.elem).offset({
//                            left: (cur_of.left + delta.x),
//                            top: (cur_of.top + delta.y)
//                        });
//
//                        drag.x = e.pageX;
//                        drag.y = e.pageY;
//
//                    }
//                });
//
//                $(document).mouseup(function () {
//                    if (drag.state) {
//                        drag.elem.style.backgroundColor = '#808';
//                        drag.state = false;
//                    }
//                });
//            });
            $(function () {

                parent_l = $('.show').offset().left;
                parent_t = $('.show').offset().top;

                _show = $('.show');

                _show.mousedown(function (e) {
                    if (!drag.state) {
                        drag.elem = this;
                        this.style.backgroundColor = '#f00';
                        drag.x = e.pageX;
                        drag.y = e.pageY;
                        drag.state = true;
                    }
                    return false;
                });

                $(document).mousemove(function (e) {
                    if (drag.state) {
                        drag.elem.style.backgroundColor = '#f0f';

                        delta.x = e.pageX - drag.x;
                        delta.y = e.pageY - drag.y;

                        var cur_of = $(drag.elem).offset();

                        $(drag.elem).offset({
                            left: (cur_of.left + delta.x),
                            top: (cur_of.top + delta.y)
                        });

                        drag.x = e.pageX;
                        drag.y = e.pageY;

                    }
                });

                $(document).mouseup(function () {
                    if (drag.state) {
                        drag.elem.style.backgroundColor = '#808';
                        drag.state = false;
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="show" style="width: 150px;height: 150px;background-color: yellow ;position: absolute; top: 50px;"></div>
        <div class="show" style="width: 150px;height: 150px;background-color: blue ;position: absolute;"></div>
    </body>
</html>