<?php
error_reporting(0);
    $name = $_POST["name"];
    if( $name != ""){
        $password = $_POST['password'];
        $link = mysqli_connect("localhost","root","123456");
        mysqli_select_db($link,"gbook");
        $query = "select * from admin where username = '$name'";
        $result = mysqli_query($link,$query);
        if( mysqli_num_rows($result) < 1){
            echo "用户不存在<br>";
        }else{
            $info = mysqli_fetch_array($result);
            if( $info['userpass'] != $password){
                echo "密码错误<br>";
            }else{
                //如果用户名密码都正确，则注册一个session来标记其登录状态
                
                session_start();
                // $_SESSION["login"] = "YES";
                echo "<script language=javascript>alert('登录成功!');location.href='index1.php';</script>";
            }
        }
        mysqli_close($link);
    }
 ?>
 
<html>
 
<head>
    <title>admin</title>
</heda>
 
<body>
 
    <table border=1 cellspacing=0 cellspadding=0 style="border-collapse:collapse" align=center width=400 bordercolor=black height="358">
        <tr>
            <td height=100 bgcolor=#6c6c6c style="font-size:30px;line-height:30px">
                <font color=#ffffff face="黑体">admin登录</font>
            </td>
        </tr>
        <tr>
            <td height=25>
                 <a href=send.php>[我要写留言]</a> 
                 <a href=sqls.php>[管理留言]</a>
            </td>
        </tr>
        <tr>
            <td height=178>
                <form method="POST" action="sqls.php">
                    <table border="1" width="95%" id="table1" cellspcing="0" cellpadding="0" bordercolor="#808080" style="border-collapse" height="154">
                        <tr>
                            <td colspan="2" height="29">
                                <p align="center">管理员登录</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="32%">
                                <p align="center">用户名</P>
                            </td>
                            <td width="67%">
                                <input type="text" name="name" size="20">
                            </td>
                        </tr>
                        <tr>
                            <td width="32%">
                                <p align="center">密 码</p>
                            </td>
                            <td>
                                <input type="password" name="password" size="20">
                            </td>
                        </tr>
                        <tr>
                            <td width="99%" colspan="2">
                                <p align="center"><input type="submit" value="登录" name="B1"></p>
                            </td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
        
    </table>
 
</body>
 
</html>
