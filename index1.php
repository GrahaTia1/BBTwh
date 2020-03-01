<?php
session_start();
 
if(isset($_SESSION['views']))
{
    $_SESSION['views']=$_SESSION['views']+1;
}
else
{
    $_SESSION['views']=1;
}
echo "浏览量：". $_SESSION['views'];
?>
<?php

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>进来就昏睡x</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="div.css" charset="utf-8">
    <script type="text/javascript">
    function isHidden(oDiv){
        var vdiv = document.getElementById(oDiv);
        vdiv.style.display =(vdiv.style.display == 'none')?'block':'none';
    }
    </script>
    <script type="text/ecmascript">
    /*改变原始宽度（0）*/
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }
    /*恢复原始宽度0*/
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    </script>
    <script type="text/javascript">
        var TurnToLogin = () => {
            document.getElementById('loginback').style.display = "block";
            document.getElementById('registback').style.display = "none";
        }
        var TurnToRegister = () => {
            document.getElementById('registback').style.display = "block";
            document.getElementById('loginback').style.display = "none";
        }

        function postLogin(argUserName, argUserPass) {
            //创建一个XMLHttpRequest 对象
            var xhr = new XMLHttpRequest();
            //准备发送请求的数据：url
            var url = "https://www.cbfgo.cn/bbt/test/login";
            //使用HTTP POST请求与服务器交互数据
            xhr.open("POST", url, true);
            //设置发送数据的请求格式
            xhr.setRequestHeader('content-type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 3) {
                    //Popup
                } else if (xhr.readyState == 4) {
                    //CLOSE Popup
                    //根据服务器的响应内容格式处理响应结果
                    if (xhr.getResponseHeader('content-type') === 'application/json') {
                        console.log(xhr.responseText);
                        var resultJSON = JSON.parse(xhr.responseText);
                        if (resultJSON.errorcode === 0) {
                            alert("登入成功!"); //进入主页面
                        } else {
                            alert(resultJSON.errmsg);
                        }
                    } else {
                        console.log(xhr.responseText);
                        alert("服务器返回结果格式不是JSON");
                    }
                }
            }

            var sendData = {
                "username": argUserName,
                "password": argUserPass
            };
            //将用户输入值序列化成字符串
            console.log(JSON.stringify(sendData));
            xhr.send(JSON.stringify(sendData));

        }

        function login() {
            var username = document.getElementById("user").value;
            var password = document.getElementById("password").value;
            console.log("用户输入:", username, password)
            postLogin(username, password);

        }



        function postRegist(argUserName, argUserPass) {
            //创建一个XMLHttpRequest 对象
            var xhr = new XMLHttpRequest();
            //准备发送请求的数据：url
            var url = "https://www.cbfgo.cn/bbt/test/register";
            //使用HTTP POST请求与服务器交互数据
            xhr.open("POST", url, true);
            //设置发送数据的请求格式
            xhr.setRequestHeader('content-type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 3) {
                    //Popup
                } else if (xhr.readyState == 4) {
                    //CLOSE Popup
                    //根据服务器的响应内容格式处理响应结果
                    if (xhr.getResponseHeader('content-type') === 'application/json') {
                        console.log(xhr.responseText);
                        var resultJSON = JSON.parse(xhr.responseText);
                        if (resultJSON.errorcode === 0) {
                            alert("注册成功!"); //返回登录界面
                        } else {
                            alert(resultJSON.errmsg);
                        }
                    } else {
                        console.log(xhr.responseText);
                        alert("服务器返回结果格式不是JSON");
                    }
                }
            }

            var sendData = {
                "username": argUserName,
                "password": argUserPass
            };
            //将用户输入值序列化成字符串
            console.log(JSON.stringify(sendData));
            xhr.send(JSON.stringify(sendData));

        }

        function regist() {
            var registUser = document.getElementById("registUser").value;
            var registPassword1 = document.getElementById("registPassword1").value;
            var registPassword2 = document.getElementById("registPassword2").value;
            console.log("用户输入:", registUser, registPassword1)
            postRegist(registUser, registPassword1);
            if (user == name1 && password == password1) {
                 alert("登入成功!");
                    window.location.href = "register.html"; //在这里进行页面跳转
             } else {
                 alert("用户名或密码错误!");
                 //这里可以跳转到错误提示页面，或者不跳转
             }
        }
    </script>

</head>

<body>

    <div class="wenzi">欢迎来到昏睡红茶留言板！</div>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="register.html" )>Register</a>
         <a href="javascript:openLogin();">Login</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>
  
    <input type="text">
        <input type="submit" value="提交"></div>
    <script>
    function openLogin(){
       document.getElementById("win").style.display="";
    }
    function closeLogin(){
       document.getElementById("win").style.display="none";
    }
    </script>
    
    <span style="font-size:30px; cursor:pointer" onclick="openNav()">&#9776; 打开</span>
    <div id="loginback" class="loginback">
        <div class="title">
            
        </div>
        <div class="login">
            <div class="name">
                <label for="user">用户名</label>
                <div>
                    <form>
                        <input id="user" class="text" type="text" name="user" placeholder="请输入用户名" />
                    </form>
                </div>
            </div>
            <div class="password">
                <label for="password">密码</label>
                <div>
                    <form>
                        <input id="password" class="text" type="password" name="password" placeholder="请输入密码" />
                    </form>
                </div>
            </div>
            <div class="submit">
                <form>
                    <input class="btn1" type="submit" value="登录" onclick="login()">
                </form>
               
            </div>
        </div>
    </div>
    
    <div id="datetime">
    <script>
        setInterval("document.getElementById('datetime').innerHTML=new Date().toLocaleString();", 1000);
    </script>
    </div>
     <table border=1 cellspacing=0 cellspadding=0 style="border-collapse:collapse" align=center width=400 bordercolor=black height=382>
        <tr>
            <td height=100 bgcolor=#6c6c6c style="font-size:30px;line-height:30px">
                <font color=#ffffff face="黑体">昏睡留言板</font>
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
                
                <?php
                    error_reporting(0);
                    $link = mysqli_connect("localhost","root","123456");
                    mysqli_select_db($link,"gbook");
                    $query = "select * from message";
                    $result = mysqli_query($link,$query);
                    if( mysqli_num_rows($result) < 1){
                        echo " 目前数据表中还没有任何留言!";
                    }else{
                        $totalnum = mysqli_num_rows($result);//获取数据库中所有数据条数
                        $pagesize = 7;//每页显示7条
                        $page = $_GET["page"];
                        if( $page == ""){
                            $page = 1;
                        }
                        $begin = ($page-1)*$pagesize;
                        $totalpage = ceil($totalnum/$pagesize);
                        //输出分页信息
                        echo "<table border=0 width=95%><tr><td>";
                        $datanum = mysqli_num_rows($result);
                        echo "共有".$totalnum."条留言，每页".$pagesize."条，共".$totalpage."页。<br>";
                        //输出页码
                        for( $i = 1; $i <= $totalpage; $i++){
                            echo "<a href=index.php?page=".$i.">[".$i."] </a>";
                        }
                        echo "<br>";
                        //从message表中查询当前页面所要显示的留言，并根据时间排序
                        $query = "select * from message order by addtime desc limit $begin,$pagesize";
                        $result = mysqli_query($link,$query);
                        $datanum = mysqli_num_rows($result);
                     
                        for( $i = 1; $i <= $datanum; $i++){//$datanum???
                            $info = mysqli_fetch_array($result);
                            echo "->[".$info['author']."]于".$info['addtime']."说:<br>";
                            echo "  ".$info['content']."<br>";
                            if( $info['reply'] != ""){
                               
                                echo "<b>管理员回复:</b>".$info['reply']."<br>";
                            }
                            echo "<hr>";
                        }
                        echo "</td></tr></table>";
                    }
                    mysqli_close($link)
                 ?>
            </td>
        </tr>
        <tr>
            
        </tr>
    </table>

</body>

</html>
