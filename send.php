<?php
    error_reporting(0);
    $name = $_POST["name"];//从input里面传过来的name
    //看用户是否提交了新留言，如果提交了，则写入表message
    if( $name != ""){
        $content = $_POST["content"];
        //下面的代码用于获得当前日期和时间
        $addtime = date("Y-m-d h:i:s");//得到日期
        $link = mysqli_connect("localhost","root","123456");//PHP连接数据库
        mysqli_select_db($link,"gbook");
        $insert = "insert into message(author,addtime,content,reply) values('$name','$addtime','$content','')";
        mysqli_query($link,$insert);
        mysqli_close($link);
        echo "<script language=javascript>alert('可以了');location.href='index1.php';</script>";
    }
   
 
 ?>
 <?php
//php防注入和XSS攻击通用过滤. 
$_GET     && SafeFilter($_GET);
$_POST    && SafeFilter($_POST);
$_COOKIE  && SafeFilter($_COOKIE);
  
function SafeFilter (&$arr) 
{
     
   $ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');
     
   if (is_array($arr))
   {
     foreach ($arr as $key => $value) 
     {
        if (!is_array($value))
        {
          if (!get_magic_quotes_gpc())//不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
          {
             $value  = addslashes($value); //给单引号（'）、双引号（"）、反斜线（\）与NUL（NULL字符）加上反斜线转义
          }
          $value       = preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
          $arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为HTML实体
        }
        else
        {
          SafeFilter($arr[$key]);
        }
     }
   }
}
?>
<html>
 
<head>
    <title>.</title>
</head>
 
<body>

    <table border=1 cellspacing=0 cellspadding=0 style="border-collapse:collapse" align=center width=400 bordercolor=black>
        <tr>
            <td height=100 bgcolor=#6c6c6c>
                <font style="font-size:30px" color=#ffffff face="黑体">您是要留言🐎</font>
            </td>
        </tr>
        <tr>
            <td height=25>
                 <a href=send.php>[我要写留言]</a> 
                 <a href=sqls.php>[管理留言]</a>
            </td>
        </tr>
        <tr>
            <td height=200>
                <form method="POST" action="send.php">
                    <table border="1" width="95%" id="table1" cellspacing="0" cellpadding="0" bordercolor="#808080" style="border-collapse:collapse" height="265">
                        <tr>
                            <td colspan="2" height="29">
                                <p align="center">那您留个言⑧</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="32%">
                                <p align="right">你的名字</p>
                            </td>
                            <td width="67%">
                                <input type="text" name="name" size="20">
                            </td>
                        </tr>
                        <tr>
                            <td width="32%">
                                <p>留言内容</p>
                            </td>
                            <td width="67%">
                                <textarea rows="10" name="content" cols="31"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="99%" colspan="2">
                                <p align="center">
                                    <input type="submit" value="提交" name="B1">
                                </p>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
        <tr>
            <td height=80 bgcolor=black align=center>
               
            </td>
        </tr>
    </table>
 
</body>
 
</html>
