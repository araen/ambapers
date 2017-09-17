<?
header('Content-Type: text/html; charset=utf-8');
$host = $_SERVER['HTTP_HOST'];
setlocale(LC_TIME, "id_ID");
date_default_timezone_set('Asia/Jakarta');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Selamat datang di <? print $host; ?>! Hostinger web hosting gratis dengan PHP, MySQL.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://cdn.rawgit.com/hostinger/banners/master/hostinger_welcome/css/site.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="main">
    <div id="content">
        <div class="header">
        </div>
        <div class="content">
            <h1>Website Ambapers.Co.Id Sedang dalam Pengembangan <h1>
<p>Kunjungi <a href=http://www.ambapers.com> Ambapers.com </a>untuk informasi lebih jauh tentang Ambapers</h1>
   </p>    
            <div class="clear"></div>
        </div>
        <div class="footer"></div>
        <div class="clear"></div>
    </div>
    <div id="footer">

    </div>
</div>
</body>
</html>