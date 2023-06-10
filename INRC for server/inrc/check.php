<?php

//ここからを編集してください

//ファイルを改造した場合、あなたの名前（公開されます）（改造していない場合空欄）
$arname="";
//ファイルを改造していない場合、あなたの名前（公開されます）（改造した場合空欄）
$raname="inrei810";
//INRC for server バージョン
$ver="v1.0";

//編集ここまで

//ユーザーに表示する画面のため、変更しないこと
$key=$_GET["key"];
if(!empty($key))
{
    if(!file_exists("./user/send${key}.txt")&&!file_exists("./user/receive${key}.txt"))
    {
        
        echo"0,キーが登録されていません！";
        exit;
    }
}

echo "1,inrc for server バージョン情報\r\n";
if($arname=="")
{    echo "INRC for server $ver\r\noriginal:inrei810\r\nprovider:$raname\r\nThis is original.";

}
else{
    echo "INRC for server $ver\r\noriginal:inrei810\r\nprovider:$arname\r\nThis has been improved or changed.";

}
echo "\r\n\r\nこのメッセージは、接続成功を意味します。"
?>
