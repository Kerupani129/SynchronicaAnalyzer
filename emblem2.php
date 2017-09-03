<?php

set_time_limit(120);
header('content-type: text/plane; charset=utf-8');

$url_base = 'https://lounge.synchronica.jp/imgsrc.php?f=';

$song = '000_王様プリン';
$id   = 349; // 265～, 345～

for ($i = 0; $i < 12; $i++) {
	$file       = sprintf('/reward/5/%04d.png'   , $id); // 5: エンブレム, 2: 曲
	$file_base  = sprintf('/motif/base/%04d.png' , $id);
	$file_front = sprintf('/motif/front/%04d.png', $id);
	$imgsrc       = $url_base . base64_encode($file);
	$imgsrc_base  = $url_base . base64_encode($file_base);
	$imgsrc_front = $url_base . base64_encode($file_front);

	$imgname = sprintf('%s_%c', $song, ord('A') + $i);

	echo $imgname . '.png'   . PHP_EOL;
	echo $imgname . '_1.png' . PHP_EOL;
	echo $imgname . '_2.png' . PHP_EOL;
	echo $imgsrc       . PHP_EOL;
	echo $imgsrc_base  . PHP_EOL;
	echo $imgsrc_front . PHP_EOL;

	$imgname = mb_convert_encoding($imgname, 'CP932', 'UTF-8'); // Windows

	$data = file_get_contents($imgsrc);
	file_put_contents('png/' . $imgname . '.png'  , $data);
	$data = file_get_contents($imgsrc_base);
	file_put_contents('png/' . $imgname . '_1.png', $data);
	$data = file_get_contents($imgsrc_front);
	file_put_contents('png/' . $imgname . '_2.png', $data);

	$id += 2;
}

?>
