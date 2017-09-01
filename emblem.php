<?php

set_time_limit(120);
header('content-type: text/plane; charset=utf-8');

$url_base = 'https://lounge.synchronica.jp';

// 通信
$url = 'CrownList-genre1.html';

$dom = new DOMDocument('1.0', 'UTF-8');
@$dom->loadHTMLFile($url);
$xpath = new DOMXPath($dom);

// パース
$list = $xpath->query('//table[@id="search_grid"]/tbody/tr/td[1]');

$count = 0;

$type_str = ['A', 'B', 'C'];

foreach ($list as $li) {

	// 
	$song = $xpath->query('div[@class="song"]', $li)->item(0)->nodeValue;

	$imgsrc = $url_base . $xpath->query('ul[@class="motif"]/li[1]/div/img[1]/@src', $li)->item(0)->nodeValue;

	// 
	parse_str(parse_url($imgsrc, PHP_URL_QUERY), $query);
	$file = base64_decode($query['f']);

	preg_match('(/reward/5/([0-9]+.png))u', $file, $match);
	$png = $match[1];

	$file_base  = '/motif/base/'  . $png;
	$file_front = '/motif/front/' . $png;

	$imgsrc_base  = $url_base . '/imgsrc.php?f=' . base64_encode($file_base) ;
	$imgsrc_front = $url_base . '/imgsrc.php?f=' . base64_encode($file_front);

	// 表示
	$type = $count % 6;
	if ( 0 <= $type && $type < 3 && 86 * 6 <= $count) { // 087 「恋愛裁判」～
		$imgname = sprintf('%03d_%s_%s', $count / 6 + 1, $song, $type_str[$type]);
		
		echo $imgname . '.png' . PHP_EOL;
		echo $imgname . '_1.png' . PHP_EOL;
		echo $imgname . '_2.png' . PHP_EOL;
		echo $imgsrc       . PHP_EOL;
		echo $imgsrc_base  . PHP_EOL;
		echo $imgsrc_front . PHP_EOL;
		
		$imgname = mb_convert_encoding($imgname, 'CP932', 'UTF-8'); // Windows
		
		$data = file_get_contents($imgsrc);
		file_put_contents('png/' . $imgname . '.png', $data);
		$data = file_get_contents($imgsrc_base);
		file_put_contents('png/' . $imgname . '_1.png', $data);
		$data = file_get_contents($imgsrc_front);
		file_put_contents('png/' . $imgname . '_2.png', $data);
	}

	// 
	$count++;

	if ( $count == 17 * 6 ) $count += 6; // 018 サヨナラ曲「starship.6」
	if ( $count == 25 * 6 ) $count += 6; // 026 サヨナラ曲「夜の踊り子」
	if ( $count == 76 * 6 ) $count += 6; // 077 解禁曲「お願い！シンデレラ」

}

?>
