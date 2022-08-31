<?php 
session_start();
if (!empty($_POST["as"]))
{
if (!empty($_POST["ok"]))
{
    setcookie("eula","true",time() +2147483647);
    header("Location: ./");
    exit;
}
else{
    $_SESSION["eula"]="<p style=\"color:red;\">規約に同意できない場合利用できません</p>";
 header("Location: ./eula.php");
 exit;
}
}
?>
<!DOCTYPE html>

<html lang="ja">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--ワード-->
    <!--タイトル-->
    <title>INRC利用規約</title>
    <script type="text/javascript" src="post.js"></script>
    <link rel="stylesheet" type="text/css" href="rc.css">

    </head>
    <body>
    <div class="wrapper">
    
<div class="waku">
    <!--タイトル-->
<h1>INRC利用規約</h1>
<p class="date">2021/11/26</p>
<hr>

<!--本文-->
<p>INRCは、ブラウザ上から対象のPCを遠隔操作します。<br>以下の利用規約に同意できない場合、利用できません。</p>
<h2>1.禁止事項</h2>
<p>以下の行為は絶対にしないでください。
</p>
<p>1.INRCを他人のPC上で無断で実行する行為。</p>
<p>2.法律や憲法に反する行為。</p>
<p>3.誰かに迷惑をかける行為。</p>
<p>4.INRCを用いて事故が起こった場合、私に責任を追及する行為。</p>
<h2>2.免責事項</h2>
<p>INRCを用いて発生した損害について、製作者である私は一切責任を負いません。
</p>
<p>お遊びソフトウェア感覚でお使いください()</p>
<?php 
if (!empty($_SESSION["eula"]))
{
echo $_SESSION["eula"];
unset($_SESSION["eula"]);
}
?>
<form method="POST">
<label><input type="checkbox" name="ok[]">規約に同意する</label><br>
<input type="submit" value="送信" class="name" name="as">
</form>

</div>
    </div>
</body>

    </html>