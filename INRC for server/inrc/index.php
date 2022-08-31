<?php 

session_start();
if (empty($_SERVER['HTTPS'])) {
    header("Location: https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
    exit;
    }
//post arで初期化、sでPC送信、rでクライアント送信
$aaa=file_get_contents("./user/status.txt");
$bbb=file_get_contents("./user/warning.txt");


if (!empty($_POST["send"]))
{
  if (empty($aaa))
  {
        setcookie("key",$_POST["key"],time() +2147483647);        
        $status=null;

    $sor=null;
    $key=$_POST["key"];
    $cmd=$_POST["cmd"];
    $sor=$_POST["sor"];
    $sendfile="./user/send".$key.".txt";
    if ($sor=="s"&&file_exists($sendfile))
    {
        file_put_contents($sendfile,$cmd);
        $_SESSION["status"]="ok";
    }
    else{
        $_SESSION["status"]="no";
    }
    if (!empty($bbb))
    {
        $_SESSION["status1"]="info";
    $_SESSION["info1"]=$bbb;
    
    }
}
    elseif (!empty($aaa))
    {
        $_SESSION["status"]="stop";
    $_SESSION["info"]=$aaa;
    
    }
    
 header   ("Location:./#form");
    exit;
}
else
{ 
    $key=$_POST["key"];
    $cmd=$_POST["cmd"];
    $sor=$_POST["sor"];
    $receivefile="./user/receive".$key.".txt";
    $sendfile="./user/send".$key.".txt";
    if ($sor=="ar"&&file_exists($sendfile))
    {
        file_put_contents($sendfile,"");
    }
    elseif ($_POST["sor"]=="r"&&file_exists($receivefile))
    {
        file_put_contents($receivefile,$cmd);
        
    }
}
if ($_COOKIE["eula"]=="true")
{

}
else
{
    header("Location: ./eula.php");
    exit;
}
?> 
<!DOCTYPE html>

<html lang="ja">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--ワード-->
    <script>
        window.onload = function(){
            newURL();
        setInterval("reload()", 1000);
        
    }
    let element = document.getElementById('check');

        function reload(){
            if (check.checked)
            {
            }
            else
            {
            document.getElementById("com").contentWindow.location.reload(true);
            }
}
function newURL()
{
    let element = document.getElementById('key');

document.getElementById("com").src = "./user/receive"+element.value+".txt";


}
    </script>
    <!--タイトル-->
    <title>遠隔操作</title>
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
        line-height: 20px;
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
        line-height: 20px;
        }
        .messeage-i{
            width: 90%;
            border: 1px solid blue;
        padding: 10px;
        margin: 10px;
        border-radius:20px;
        color:blue;
        line-height: 20px;
        }
        .messeage-i p{
            line-height: 15px;

        }
        .messeage-e p{
            line-height: 15px;

        }
        .aa{
        font-family:"ＭＳ Ｐゴシック","MS PGothic","Mona","mona-gothic-jisx0208.1990-0",sans-serif;
        font-size:10px;
        line-height:14px;
        border: 1px solid #eeeeee;
        padding: 10px;
        margin: 10px;
        width: 100%;
        height: 600px;
}
    </style>
    </head>
    <body>
    <div class="wrapper">
    
<div class="waku">
    <!--タイトル-->
<h1>遠隔操作</h1>
<p style="line-height: 20px;"><a href="hakkou.php">KEY発行と削除</a></p>
<hr>

<!--本文-->
<?php 
if ($_SESSION["status1"]=="info")
{
    echo '<div class="messeage-i" id="form"><p>情報:'.$_SESSION["info1"].'</p></div>';
    unset($_SESSION["status1"]);

}
if ($_SESSION["status"]=="ok")
{
    echo '<div class="messeage" id="form"><p>送信成功</p></div>';

}
elseif ($_SESSION["status"]=="no")
{
    echo '<div class="messeage-e" id="form"><p>送信失敗-キーが間違っているか登録されていません</p></div>';


}elseif ($_SESSION["status"]=="stop")
{
    echo '<div class="messeage-e" id="form"><p>エラー:'.$_SESSION["info"].'</p></div>';

}

unset($_SESSION["status"]);

?>
<form method="POST">
    <input type="text" name="cmd" placeholder="コマンド内容を入力" class="keyandcmd name">
    <input type="hidden" name="sor" value="s">
    <input type="text" name="key" class="keyandcmd name" placeholder="キーを入力" id="key" width="100%" value="<?php echo $_COOKIE["key"] ?>">
    <input type="hidden" name="scroll_top" value="">

    <input type="submit" value="送信" name="send" class="btn btn--orange">
</form>
<label><input type="checkbox" id="check">1秒ごとに更新しない</label>
<iframe src="" width="100%" height="600" id="com"></iframe>
</div>
   </div>
</body>

    </html>