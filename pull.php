<?php
//header('Access-Control-Allow-Origin:*');
$valid_token = '70d44775b3f04004e25d2ebd039959226b2413d9';
$path = $_POST['path']; //项目路径
//$valid_ip = array('115.200.255.118');      //指定可调用ip，若失效重新设置为本地外网ip
$branch = $_POST['branch'];
$client_ip = $_SERVER['REMOTE_ADDR'];

if ($valid_token !== base64_decode($_POST['token'])) {
	die('<pre>密码错误，PASSWORD IS NOT CORRECT</pre>');
}
//if (!in_array($client_ip, $valid_ip)) die('Ip mismatch!');
$output = shell_exec("
date '+%Y-%m-%d %H:%M:%S';
cd {$path};echo -n '进入路径：cd ';pwd;
echo '执行拉取：git pull origin {$branch}';
echo '-----------------------执行拉取------------------------';
git pull origin {$branch};
echo '-----------------------推送日志------------------------';
git log -n2;
echo '-----------------------查看状态------------------------';
git status;
echo '-----------------------文件列表------------------------';
ls -lah;
");
echo "<pre>$output</pre>";
?>