<?php

if ($_FILES["fileUpdate"]["error"] > 0) {
    echo "Error: " . $_FILES["fileUpdate"]["error"];
} else {
    echo "檔案名稱: " . $_FILES["fileUpdate"]["name"] . "<br/>";
    echo "檔案類型: " . $_FILES["fileUpdate"]["type"] . "<br/>";
    echo "檔案大小: " . ($_FILES["fileUpdate"]["size"] / 1024) . " Kb<br />";
    echo "暫存名稱: " . $_FILES["fileUpdate"]["tmp_name"];
    echo '<br>';

    move_uploaded_file($_FILES["fileUpdate"]["tmp_name"], 'U/' . $_FILES["fileUpdate"]["name"]);
}
