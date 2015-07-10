<?php
$Fid1 = '100002081915136';
$Fid2 = '770155016415644';
$Fid3 = '1443080862668883';
$Fid4 = '1452185815073770';
$Fid5 = '611549135612396';
?>
<html>
    <head>
        <link href="css/c1.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

        <script src="js/t1.js"></script>
    </head>
    <body>
        <div class="imageMake">
            <div id="show">
                <div class="view view_fp" d-type='FB_P' d-fid="100002081915136" style=""></div>
                <div class="view" im="../image/DD.png" style="top: 20px; left: 300px; height: 500px; width: 400px;" d-type='P'></div>
                <div class="view view_w" d-type='W' content="我想對你說"></div>
                <!--<div class="view view_fn" d-type='FB_N' d-display="對象名字" d-fid="100002081915136"></div>-->

            </div>
            <div id="controller" style="">
                <div>
                    <table border="0">
                        <thead>
                        <td>圖層</td>
                        <td>類型</td>
                        <td colspan="4">內容</td>

                        </thead>
                        <tbody>

                            <tr class="c_view" id="cv_1" v_x="13" v_y="202" >
                                <td class="zIndex">1</td>
                                <td class="d_type" d-type='FB_P'>對象照片</td>
                                <td class="content"><input disabled value="100002081915136"></td>
                                <td><button class="btn_up">上移</button></td>
                                <td><button class="btn_down">下移</button></td>
                                <td><button class="btn_del">刪除</button></td>
                            </tr>
                            <tr class="c_view" id="cv_2"  v_x="-13" v_y="-15" >
                                <td class="zIndex">2</td>
                                <td class="d_type" d-type='P'>圖片</td>
                                <td class="content"><input disabled value="http://127.0.0.1/T/image/DD.png"></td>
                                <td><button class="btn_up">上移</button></td>
                                <td><button class="btn_down">下移</button></td>
                                <td><button class="btn_del">刪除</button></td>
                            </tr>
                            <tr class="c_view" id="cv_3" v_x="465" v_y="93"  >
                                <td class="zIndex">3</td>
                                <td class="d_type" d-type='W'>文字</td>
                                <td class="content"><input disabled value="我想對你說"></td>
                                <td><button class="btn_up">上移</button></td>
                                <td><button class="btn_down">下移</button></td>
                                <td><button class="btn_del">刪除</button></td>
                            </tr>

                        </tbody>
                    </table>
                    <div id="addNewPic">
                        <select name="sel">
                            <option value="W" selected>文字</option>
                            <option value="P">圖片</option>                            
                            <!--<option value="FB_N">臉書名字</option>-->
                            <option value="FB_P">臉書照片</option>
                        </select>                    
                        <input id="inp" type="text" accept=".jpg,.jpeg,.png,.bmp">
                        <button id="view_add">加入</button>
                    </div>
                </div>
                <button id="make">MAKE</button>
                <hr>
                <div id="output">

                </div>
                <div>

                </div>
            </div>
        </div>


    </body>
</html>