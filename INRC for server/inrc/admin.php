<?php
session_start();
if (!empty($_POST["sen"]))
{
$key=$_POST["key"];
$sendname="./user/send".$key.".txt";
$receivename="./user/receive".$key.".txt";

if (!file_exists($sendname))
{
touch($sendname);
touch($receivename);
$_SESSION["safe"]="登録しました。KEYは${key}です。";
$_SESSION["safe1"]="ok";
}
else{
    $_SESSION["safe"]="登録できませんでしたorz";
    $_SESSION["safe1"]="no";

}
header("Location:".basename(__FILE__));
exit;
}
elseif (!empty($_POST["ran"]))
{
    $rand=random(8);
    $sendname="./user/send".$rand.".txt";
    $receivename="./user/receive".$rand.".txt";

    if (!file_exists($sendname))
    {
    touch($sendname);
    touch($receivename);
    $_SESSION["safe"]="登録しました。KEYは${rand}です。";
    $_SESSION["safe1"]="ok";


    }
    else{
        $_SESSION["safe"]="登録できませんでしたorz";
        $_SESSION["safe1"]="no";

    
    }
    header("Location:".basename(__FILE__));
exit;
}
elseif (!empty($_POST["st"]))
{
    file_put_contents("./user/status.txt",$_POST["status"]);
    $_SESSION["safe"]="変更しました";
    $_SESSION["safe1"]="ok";
    header("Location:".basename(__FILE__));
    exit;
}
elseif (!empty($_POST["wa"]))
{
    file_put_contents("./user/warning.txt",$_POST["war"]);
    $_SESSION["safe"]="変更しました";
    $_SESSION["safe1"]="ok";
    header("Location:".basename(__FILE__));
    exit;
}
elseif ($_POST["del"])
{
$keyd=$_POST["keyd"];
$sendname="./user/send".$keyd.".txt";
$receivename="./user/receive".$keyd.".txt";
if(unlink($sendname)&&unlink($receivename))
{
    $_SESSION["safe"]="削除しました";
    $_SESSION["safe1"]="ok";
}
else
{
    $_SESSION["safe"]="登録されていません";
        $_SESSION["safe1"]="no";
}
header("Location:".basename(__FILE__));
exit;
}
function random($length = 8)
{
    return substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, $length);
}
?>
<!DOCTYPE html>

<html lang="ja">
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--ワード-->
    <!--タイトル-->
    <title>管理</title>
    <script type="text/javascript" src="post.js"></script>
    <link rel="stylesheet" type="text/css" href="rc.css">
<style>
        .keyandcmd{
            width: 100%;
        }
        .messeage{
            width: 90%;
            border: 1px solid #48b400;
        padding: 10px;
        margin: 10px;
        border-radius:20px;
        color:#48b400;
        }
        .messeage p{
            line-height: 15px;
        }
        .messeage-e{
            width: 90%;
            border: 1px solid red;
        padding: 10px;
        margin: 10px;
        border-radius:20px;
        color:red;
        }
        .messeage-e p{
            line-height: 15px;

        }
    </style>    </head>
    <body>
    <div class="wrapper">
    
<div class="waku">
    <!--タイトル-->
<h1>管理</h1>
<hr>
<!--本文-->
<?php 

if ($_SESSION["safe1"]=="ok")
{
    echo '<div class="messeage"><p>'.$_SESSION["safe"].'</p></div>';
unset($_SESSION["safe1"]);
}
if ($_SESSION["safe1"]=="no")
{
    echo '<div class="messeage-e"><p>'.$_SESSION["safe"].'</p></div>';
    unset($_SESSION["safe1"]);


}else{}
?>
<form method="POST">
    <input type="submit" class="btn btn--orange" name="ran" value="ランダムキー発行＆登録">
    <hr>
<input type="text" class="name" name="key">
    <input type="submit" class="btn btn--orange" name="sen" value="キー指定で発行＆登録">
    <hr>    <input type="text" class="name" name="keyd">
    <input type="submit" class="btn btn--orange" name="del" value="キー削除"><hr>
    <textarea name="status" style="width: 98%;" rows="4"></textarea>
    <input type="submit" class="btn btn--orange" name="st" value="ステータス変更">
    <hr>
    <textarea name="war" style="width: 98%;" rows="4"></textarea>
    <input type="submit" class="btn btn--orange" name="wa" value="情報変更">


</form>
<!--コメント欄-->

</div>
  </div>
</body>

    </html>