
function Json2Image(src) {
    var json = JSON.parse(src);

    //生成畫布
//    var c = document.createElement('canvas');
//    var ctx = c.getContext('2d');



//    var arr_base64 = [];



// console.log(json.picList);


//    var arr_base64_i = 0;

    $.each(json.picList, function (k, v) {

//        ctx.clearRect(0, 0, json.width, json.height);
        var c = document.createElement('canvas');
        var ctx = c.getContext('2d');

        c.height = json.height;
        c.width = json.width;

        var d_type = v.cv_DType;

        switch (d_type) {
            case 'P':

                var img_src = v.cv_con;
                var x = v.v_x,
                        y = v.v_y;
                var w = v.v_w,
                        h = v.v_h;

                var img = new Image();

                img.onload = function () {
                    ctx.drawImage(img, 0, 0, w, h, x, y, w, h);

                    var src_base64 = c.toDataURL("image/png");
                    var n_img = document.createElement('img');
                    n_img.src = src_base64;
                    $(n_img).css('z-index', v.cv_zindex);

                    $('#' + json.output).append(n_img);
                };
                img.src = img_src;

//                ctx.drawImage(img, 0, 0, w, h, x, y, w, h);
//
//                var src_base64 = c.toDataURL("image/png");
//
//                var img = document.createElement('img');
//                img.src = src_base64;
//                $('#output').append(img);

                break;
            case 'W':

                var x = v.v_x,
                        y = v.v_y;
                var w = v.v_w,
                        h = v.v_h;
                var w_y = Number(y) + Number(h);

                ctx.font = v.font_size + "px 新細明體";
                ctx.fillText(v.cv_con, x, w_y);

                var src_base64 = c.toDataURL("image/png");
//                arr_base64[arr_base64_i] = src_base64;
                var n_img = document.createElement('img');
                n_img.src = src_base64;
                $(n_img).css('z-index',v.cv_zindex);

                $('#' + json.output).append(n_img);

                break;
            case 'FB_N':

                break;
            case 'FB_P':

                var Fid = v.cv_con;
                var x = v.v_x,
                        y = v.v_y;
                var w = v.v_w,
                        h = v.v_h;
                var FB_pic = 'http://graph.facebook.com/' + Fid + '/picture?width=' + w + '&height=' + h;
//
                var img = new Image();
                img.crossOrigin = '*';
                img.onload = function () {
                    ctx.drawImage(img, 0, 0, w, h, x, y, w, h);

                    var src_base64 = c.toDataURL("image/png");
                    var n_img = document.createElement('img');
                    $(n_img).css('z-index', v.cv_zindex);
                    n_img.src = src_base64;

                    $('#' + json.output).append(n_img);
                };
                img.src = FB_pic;



                break;
        }
//        arr_base64_i++;
    });

//    console.log(arr_base64);
//-------------------------------
//    var c = document.createElement('canvas');
//    var ctx = c.getContext('2d');
//
//    c.height = json.height;
//    c.width = json.width;
//
//    for (var i = 0; i < arr_base64.length; i++) {
//
//        if (arr_base64[i]) {
//            var img = new Image();
//            img.src = arr_base64[i];
//            ctx.drawImage(img, 0, 0);
//        }
//    }


//    var src_base64 = c.toDataURL("image/png");
//    var n_img = document.createElement('img');
//    n_img.src = src_base64;
//    $('body').append(n_img);
}
