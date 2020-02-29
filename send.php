<?php
    error_reporting(0);
    $name = $_POST["name"];//从input里面传过来的name
    //看用户是否提交了新留言，如果提交了，则写入表message
    if( $name != ""){
        $content = $_POST["content"];
        //下面的代码用于获得当前日期和时间
        $addtime = date("Y-m-d h:i:s");//得到日期
        $link = mysqli_connect("localhost","root","123456");//PHP连接数据库
        if( $link)
            echo "ok!<br>";
        else {
            echo "bad!<br>";
        }
        mysqli_select_db($link,"gbook");//选择数据库
        $insert = "insert into message(author,addtime,content,reply) values('$name','$addtime','$content','')";
        mysqli_query($link,$insert);
        mysqli_close($link);
        echo "<script language=javascript>alert('留言成功!单击确定查看留言.');location.href='index1.php';</script>";
    }
   
 
 ?>
 
<html>
 
<head>
    <title>.</title>
</head>
 
<body>
    <!-- border-collapse:collapse合并表格的边框 -->
    <table border=1 cellspacing=0 cellspadding=0 style="border-collapse:collapse" align=center width=400 bordercolor=black>
        <tr>
            <td height=100 bgcolor=#6c6c6c>
                <font style="font-size:30px" color=#ffffff face="黑体">欢迎来到×××的留言本吼吼吼</font>
            </td>
        </tr>
        <tr>
            <td height=25>
                 <a href=send.php>[我要写留言]</a> 
                 <a href=login.php>[管理留言]</a>
            </td>
        </tr>
        <tr>
            <td height=200>
                <form method="POST" action="send.php">
                    <table border="1" width="95%" id="table1" cellspacing="0" cellpadding="0" bordercolor="#808080" style="border-collapse:collapse" height="265">
                        <tr>
                            <td colspan="2" height="29">
                                <p align="center">欢迎填写你的留言</p>
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
            <td height=80 bgcolor=#6c6c6c align=center>
               
            </td>
        </tr>
    </table>
 
</body>
 
</html>
