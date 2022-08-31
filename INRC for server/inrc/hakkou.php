<?php
session_start();
mb_language("Japanese");
mb_internal_encoding("UTF-8");
$to=$_POST["mail"];
$key=$_POST["key"];
$keyd=$_POST["keyd"];
$headers="From:" .mb_encode_mimeheader("no-reply-inrc");
if (!empty($_POST["sen"]))
{
$sendname="./user/send".$key.".txt";
$receivename="./user/receive".$key.".txt";
if (!file_exists($sendname)&&!empty($to))
{
   if (8<mb_strlen($key,"UTF-8"))
   {
touch($sendname);
touch($receivename);
$ip=$_SERVER["REMOTE_ADDR"];
$title="とーろく完了";
$message="inrei810の遠隔操作キーを発行しました。\r\nKEY:${key}\r\nIP:${ip}\r\n※このメールに心当たりがない場合は無視して削除してください。";

if (mb_send_mail($to, $title, $message, $headers))
{
    $_SESSION["safe"]="登録しました。KEYはメールで送信されました。";
    $_SESSION["safe1"]="ok";

}
else{
    $_SESSION["safe"]="メールの送信に失敗しましたが、keyは${key}で発行できました。";
    $_SESSION["safe1"]="no";
}
}
else{
    $_SESSION["safe"]="Keyは8文字以上にしてください";
    $_SESSION["safe1"]="no";
}
}
elseif (empty($to))
{
    $_SESSION["safe"]="メール欄が空ですorz";
    $_SESSION["safe1"]="no";
}
else{
    $_SESSION["safe"]="登録できませんでしたorz";
    $_SESSION["safe1"]="no";
}

header("Location: ./hakkou.php");
exit;
}
elseif (!empty($_POST["ran"]))
{
    $rand=random(16);
    $sendname="./user/send".$rand.".txt";
    $receivename="./user/receive".$rand.".txt";

    if (!file_exists($sendname)&&!empty($to))
    {
    touch($sendname);
    touch($receivename);
    $_SESSION["safe"]="登録しました。KEYは${rand}です。";
    $_SESSION["safe1"]="ok";
    $ip=$_SERVER["REMOTE_ADDR"];
    $title="とーろく完了";
    $message="inrei810の遠隔操作キーを発行しました。\r\nKEY:${rand}\r\nIP:${ip}\r\n※このメールに心当たりがない場合は無視して削除してください。";
    if (mb_send_mail($to, $title, $message, $headers))
    {
        $_SESSION["safe"]="登録しました。KEYはメールで送信されました。";
        $_SESSION["safe1"]="ok";
    
    }
    else{
        $_SESSION["safe"]="メールの送信に失敗しましたが、keyは${key}で発行できました。";
        $_SESSION["safe1"]="no";
    }

    }
    elseif (empty($to))
{
    $_SESSION["safe"]="メール欄が空ですorz";
    $_SESSION["safe1"]="no";
}
    else{
        $_SESSION["safe"]="登録できませんでしたorz";
        $_SESSION["safe1"]="no";

    
    }
    header("Location: ./hakkou.php");
exit;
}
elseif ($_POST["del"])
{
    
$sendname="./user/send".$keyd.".txt";
$receivename="./user/receive".$keyd.".txt";
if(unlink($sendname)&&unlink($receivename))
{
    $_SESSION["safe"]="削除しました";
    $_SESSION["safe1"]="ok";
}
else
{
    $_SESSION["safe"]="登録されていないか失敗しました";
        $_SESSION["safe1"]="no";
}
header("Location: ./hakkou.php");
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
    <title>登録</title>
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
<h1>登録フォーム</h1>
<p class="date"></p>
<hr>
<!--本文-->
<p>INRCの設定を開き、サーバーアドレス欄に<br>
<?php echo dirname((empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>
<br>
と入れてください
</p>
<?php 

if ($_SESSION["safe1"]=="ok")
{
    echo '<div class="messeage"><p>'.$_SESSION["safe"].'</p></div>';
    unset($_SESSION["safe1"]);
}
elseif ($_SESSION["safe1"]=="no")
{
    echo '<div class="messeage-e"><p>'.$_SESSION["safe"].'</p></div>';
    unset($_SESSION["safe1"]);
}else{}
?>
<form method="POST">
    <p>メールが届かん場合は迷惑メールを確認してください</p>
<input type="text" class="name" name="mail" placeholder="メールアドレスを入力" style="width: 100%;">
<hr>
<p>キー名を指定しない場合</p>

    <input type="submit" class="btn btn--orange" name="ran" value="ランダムキー発行＆登録">
    <hr>
    <p>キー名を指定する場合</p>
<input type="text" class="name" name="key" style="width: 100%;" placeholder="希望するキー名を入力"><br>
    <input type="submit" class="btn btn--orange" name="sen" value="キー指定で発行＆登録">
    <hr>
    <p>キーを削除する</p>
    <input type="text" class="name" name="keyd" style="width: 100%;" placeholder="削除するキー名を入力"><br>
    <input type="submit" class="btn btn--orange" name="del" value="削除">
</form>
<!--コメント欄-->

</div>

</body>

    </html>