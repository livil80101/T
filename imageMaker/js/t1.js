var token = 'CAAF3ZBpHSQFwBAHJ3e4NdPZBhOp0Yaj0smfsDgRtFT6PoObaYgNbMmIeYPmJqZCJJZBhIQZCZBWOKZBf5Je8umrWTuHfi3lCwuesHzpeqOkIrvFvZBBjp5KUiEXU3PgTboNHEa0Xx0Ir8PMHqZBtAqk9ZC3NPGzZCsh0ixYDJ8M5i4Xlu47mgRbVg2v3ZC8UGslp7ZAZAWspblMW3XGNBLzmvmv3im';

var parent_l = 0;
var parent_t = 0;

$(document).ready(function () {
//    reSetView();
    reSetView_control();
    reSetMouseEvent();
    reSetBtnEvent();

    parent_l = $('#show').offset().left;
    parent_t = $('#show').offset().top;




    //-------------------------------------------


});

function createJson() {
    var c_Canvas = new Object();

    c_Canvas.width = 800;
    c_Canvas.height = 600;
    c_Canvas.picList = [];
    c_Canvas.output = 'output';
//    c_Canvas.picList.push({a: 10});
    $('.c_view').each(function () {
        var _c_v = $(this);
        var _id = _c_v.attr('id');
//        console.log(_id);

        var cv_zindex = _c_v.find('.zIndex').html();
//        console.log(cv_zindex);
        var cv_DType = _c_v.find('.d_type').attr('d-type');
        var cv_con = _c_v.find('.content input').val();
        var v_x = _c_v.attr('v_x');
        var v_y = _c_v.attr('v_y');

        var v_w = $('.view[for="' + _id + '"]').width();
        var v_h = $('.view[for="' + _id + '"]').height();



        c_Canvas.picList.push(
                {
                    cv_zindex: cv_zindex,
                    cv_DType: cv_DType,
                    cv_con: cv_con,
                    v_x: v_x, v_y: v_y,
                    v_w: v_w, v_h: v_h,
                    font_size: 72
                }
        );
    });

    return JSON.stringify(c_Canvas);

}
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
                $(n_img).css('z-index', v.cv_zindex);

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

function j_cImage() {

}

function T_action() {
    var t = document.createElement('div');
    t.innerHTML = "YYYYYYYYYY";

    var body = document.getElementById('show');
    body.appendChild(t);

    var c = document.createElement('canvas');
    var ctx = c.getContext('2d');

    var img = new Image();
    img.onload = function () {
        ctx.drawImage(img, 0, 0);
    };
    img.src = '../image/BG01.jpeg';

    body.appendChild(c);
}
function makeImage(src) {
    var c = document.createElement('canvas');
    var ctx = c.getContext('2d');

    c.height = 600;
    c.width = 800;

    var img_src = $(src).attr('im');
    var l = $(src).offset().left - parent_l;
    var t = $(src).offset().top - parent_t;
    var w = $(src).width();
    var h = $(src).height();

    var img = new Image();
    img.src = img_src;
    ctx.drawImage(img, 0, 0, w, h, l, t, w, h);
    var src_base64 = c.toDataURL("image/png");
    //輸出base64

//    $('#t').attr('src', src_base64);
    var n_img = document.createElement('img');
    n_img.src = src_base64;


    $('#output').append(n_img);
}
function makeWordImage(src) {
    var c = document.createElement('canvas');
    var ctx = c.getContext('2d');

    c.height = 600;
    c.width = 800;

    var w_src = $(src).attr('content');
    var l = $(src).offset().left - parent_l;
    var t = $(src).offset().top - parent_t;
    var w = $(src).width();
    var h = $(src).height();


    ctx.font = "72px 新細明體";
    ctx.fillText(w_src, l, t + h);


    var src_base64 = c.toDataURL("image/png");
    //輸出base64

//    $('#t').attr('src', src_base64);
    var n_img = document.createElement('img');
    n_img.src = src_base64;

    $('#output').append(n_img);
}

function makeFB_P(src) {
    var c = document.createElement('canvas');
    var ctx = c.getContext('2d');
    c.height = 600;
    c.width = 800;

    var fid = $(src).attr('d-fid');
    var l = $(src).offset().left - parent_l;
    var t = $(src).offset().top - parent_t;
    var w = $(src).width();
    var h = $(src).height();
    var FB_pic = 'http://graph.facebook.com/' + fid + '/picture?width=' + w + '&height=' + h;

    var img = new Image();
    img.crossOrigin = '*';
    img.onload = function () {
        ctx.drawImage(img, 0, 0);

        var src_base64 = c.toDataURL("image/png");
        var n_img = document.createElement('img');
        n_img.src = src_base64;


        $('#output').append(n_img);
    };
    img.src = FB_pic;
}

function reSetView() {
//    console.log('rsv');
    $('.view').each(function () {
        var d_type = $(this).attr('d-type');
//        console.log(d_type);

        $('.view').each(function () {
            var d_type = $(this).attr('d-type');
//            console.log(d_type);
            switch (d_type) {
                case 'P':
                    var _view = $(this);
                    var im = _view.attr('im');
                    if (im) {
                        var img = new Image();
                        var w, h;
                        img.onload = function () {
                            w = this.width;
                            h = this.height;

                            _view.width(w);
                            _view.height(h);
                        };
                        img.src = im;
                        _view.css('background-image', 'url(' + im + ')');
                        img = null;
                    }
                    break;
                case 'W':

                    break;
                case 'FB_N':

                    break;
                case 'FB_P':
                    var _view = $(this);
                    var fid = _view.attr('d-fid');
                    h = _view.height();
                    w = _view.width();

                    if (fid) {
                        _view.css('background-image', 'url(' + 'http://graph.facebook.com/' + fid + '/picture?width=' + w + '&height=' + h + ')');
                    }

                    img = null;
                    break;
            }

//            makeImage(this);

        });



    });
}
function reSetView_control() {
    //-------------------------------
    reSetTable();
    //-------------------------------

    $('#show').html('');

//    var z_i_limit=10;

    $('#controller div table tbody .c_view').each(function () {
        var _v_c = $(this);

        var z_i = _v_c.find('.zIndex').html();
        var d_t = _v_c.find('.d_type').attr('d-type');
        var v_con = _v_c.find('.content input').val();

//        console.log(v_con);
        var newDiv = document.createElement('div');
        var _newDiv = $(newDiv);
        $(_newDiv).attr('for', $(this).attr("id"));
        _newDiv.addClass('view');
        var success = 'A';
        switch (d_t) {
            case 'P':

                var img = new Image();
                var w, h;

                img.onload = function () {
                    w = this.width;
                    h = this.height;

                    console.log(w + " " + h);

                    _newDiv.width(w);
                    _newDiv.height(h);


                };
                img.onerror = function () {
                };
                img.src = v_con;

                _newDiv.css('background-image', 'url(' + v_con + ')');
                console.log(v_con);

                img = null;

                break;
            case 'W':
                _newDiv.addClass('view_w')
                _newDiv.attr('content', v_con);

                //
                break;
            case 'FB_N':

                break;
            case 'FB_P':

                var w = 300, h = 300;
                _newDiv.width(w);
                _newDiv.height(h);

                _newDiv.css('background-image', 'url(' + 'http://graph.facebook.com/' + v_con + '/picture?width=' + w + '&height=' + h + ')');

                break;
        }

//        if (success) {
//             console.log(''+success);
        var forName = '#' + _newDiv.attr('for');
        var now_x = $(forName).attr('v_x');
        var now_y = $(forName).attr('v_y');


        console.log( );

        _newDiv.css('left', now_x + 'px');
        _newDiv.css('top', now_y + 'px');


        $('#show').append(newDiv);
//        }


    });

}
//-------------------------------------------

var parent_l = 0;
var parent_t = 0;

//var _div;

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

function  reSetMouseEvent() {
//    console.log('rsme');
    parent_l = $('#show').offset().left;
    parent_t = $('#show').offset().top;

    var _div = $('.view');

    _div.mousedown(function (e) {
        if (!drag.state) {
            drag.elem = this;
//            this.style.backgroundColor = '#f00';
            drag.x = e.pageX;
            drag.y = e.pageY;
            drag.state = true;
        }
        return false;
    });
    $(document).mousemove(function (e) {
        if (drag.state) {
//            drag.elem.style.backgroundColor = '#f0f';

            delta.x = e.pageX - drag.x;
            delta.y = e.pageY - drag.y;

            var cur_of = $(drag.elem).offset();

            $(drag.elem).offset({
                left: (cur_of.left + delta.x),
                top: (cur_of.top + delta.y)
            });

            var for_cv = $(drag.elem).attr('for');

            $('#' + for_cv).attr("v_x", cur_of.left + delta.x - parent_l);
            $('#' + for_cv).attr("v_y", cur_of.top + delta.y - parent_t);

            drag.x = e.pageX;
            drag.y = e.pageY;

        }
    });

    $(document).mouseup(function () {
        if (drag.state) {
//            drag.elem.style.backgroundColor = '#808';
            drag.state = false;
        }
    });
}
function reSetTable() {
    $('.c_view').each(function () {
        var _index = $('.c_view').index(this);

        $(this).find('.zIndex').html(_index + 1);
        
        $(this).attr('id','cv_'+_index + 1)
    });
}

function  reSetBtnEvent() {

    //----------------------
    //取消所有按鈕點擊事件
    $('button').off('click');
    //取消檔案上傳事件
    $(':file').off('change');
    //----------------------

    //--------------------------------------------------------------------------
    //生成JSON並丟給JS

    $('#make').click(function () {
        $('#output').html('');

        var myString = createJson();
        console.log(myString);

        Json2Image(myString);
    });
    //--------------------------------------------------------------------------

    $('#inp').change(function () {
        var type = $(this).attr('type');
        console.log('XXXXXXXXXXXX');

        var data = this.files[0];
        var fd = new FormData();
        fd.append('file', data);

        $.ajax({
            url: "./fileUp.php",
            dataType: 'JSON',
            contentType: false,
            processData: false,
            type: 'POST',
            data: fd,
            success: function (data, textStatus, jqXHR) {
                console.log(data.result);
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.log('XXXXXXXXXXXX');
            }
        });

    });

    $('#view_add').click(function () {

        if ($('.c_view').length <= 6 && $('#addNewPic input').val().length > 0) {
            var s_type = $('#addNewPic select').val();
            var s_text = $('#addNewPic select :selected').text();

            var n_tr = document.createElement('tr');
            n_tr.id = 'cv_' + ($('.c_view').length + 1);
            $(n_tr).attr('v_x', '0');
            $(n_tr).attr('v_y', '0');
            $(n_tr).addClass('c_view');

            var n_td1 = document.createElement('td');
            $(n_td1).html($('.c_view').length + 1);
            $(n_td1).addClass('zIndex');

            var n_td2 = document.createElement('td');
            $(n_td2).addClass('d_type');
            $(n_td2).attr('d-type', s_type);
            $(n_td2).html(s_text);

            var n_td3 = document.createElement('td');
            $(n_td3).addClass('content');
            var t3i = document.createElement('input');
            $(t3i).attr('disabled', true);
//            if (s_type === 'P') {
//                var _file = document.getElementById('inp').files[0];
//                var fr = new FileReader();
//                fr.onload = function () {
//                    $(t3i).val(fr.result);
////                    console.log(fr.result);
//
//                    var img = new Image();
//                    var w, h;
//                    img.onload = function () {
//                        w = this.width;
//                        h = this.height;
//
//                        $('.view[for="' + n_tr.id + '"]').width(w);
//                        $('.view[for="' + n_tr.id + '"]').height(h);
//
//                        console.log('OK');
//
//                        $('.view[for="' + n_tr.id + '"]').css('background-image', 'url(' + fr.result + ')');
//
//                    };
//                    img.src = fr.result;
//                };
//                fr.readAsDataURL(_file);
//            } else {
            $(t3i).val($('#addNewPic input').val());
//            }

            //歸零動作
            $('#addNewPic input').val('');

            $(n_td3).append(t3i);

            var n_td4 = document.createElement('td');
            var t4b = document.createElement('button');
            $(t4b).addClass('btn_up');
            $(t4b).html('上移');
            $(n_td4).append(t4b);

            var n_td5 = document.createElement('td');
            var t5b = document.createElement('button');
            $(t5b).addClass('btn_down');
            $(t5b).html('下移');
            $(n_td5).append(t5b);

            var n_td6 = document.createElement('td');
            var t6b = document.createElement('button');
            $(t6b).addClass('btn_del');
            $(t6b).html('刪除');
            $(n_td6).append(t6b);

            $(n_tr).append(n_td1);
            $(n_tr).append(n_td2);
            $(n_tr).append(n_td3);
            $(n_tr).append(n_td4);
            $(n_tr).append(n_td5);
            $(n_tr).append(n_td6);

//            console.log();

            $('#controller div table tbody').append(n_tr);

            reSetView_control();
            reSetMouseEvent();
            reSetBtnEvent();


        } else {
//            alert('');
        }
    });
    //--------------------------------------------------------------------------
    // 選擇與改變
    //--------------------------------------------------------------------------
    $('#addNewPic select').change(function () {

        //--------------------------------------------------
        //先取消上傳的指令
//        return;
        //--------------------------------------------------

        var _sel = $(this);

        var _val = _sel.val();

        var _inp = $('#addNewPic input');
        switch (_val) {
            case 'W':
                _inp.attr('type', 'text');


                break;
            case 'P':
                _inp.attr('type', 'file');


                break;
            case 'FB_P':
                _inp.attr('type', 'text');

                break;

        }
        _inp.val('');


    });
    $('.btn_up').click(function () {
        var _n_btn = $('.btn_up');
//        console.log('run');
        var tr_index = _n_btn.index(this);

        if (tr_index > 0) {
            //----------------------------------
            var _td = $(this).parent();
            var _tr = $(_td).parent();
//            $(_tr).remove();

            $('.c_view').eq(tr_index - 1).insertAfter(_tr);
            //----------------------------------

            reSetView_control();
            reSetMouseEvent();
            reSetBtnEvent();
        } else {
//            alert('NO');
        }
    });

    $('.btn_down').click(function () {
        var _n_btn = $('.btn_down');
        var tr_index = _n_btn.index(this);

        if (tr_index < _n_btn.length - 1) {
            var _td = $(this).parent();
            var _tr = $(_td).parent();

            $('.c_view').eq(tr_index + 1).insertBefore(_tr);

            reSetView_control();
            reSetMouseEvent();
            reSetBtnEvent();
        } else {

        }

    });

    $('.btn_del').click(function () {
        var _td = $(this).parent();
        var _tr = $(_td).parent();
        $(_tr).remove();

        reSetView_control();
        reSetMouseEvent();
        reSetBtnEvent();
    });
}