<?php  
if ($_GET['name'] != null)
{
	$douban = $_GET['name'];
	$api='https://api.douban.com/v2/movie/search?q='.$douban.'&start=0&count=1';
    $raw=file_get_contents($api);
	echo $raw;

}
if ($_GET['id'] != null)
{
	$douban = $_GET['id'];
	$api='http://feifeicms.tianqi.cc/douban/?id='.$douban;
	echo(file_get_contents($api));
}
