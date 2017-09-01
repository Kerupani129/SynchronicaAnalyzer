<?php

set_time_limit(120);
header('content-type: text/plane; charset=utf-8');

// 取得
$info = [];

for ($area = 1; $area <= 7; $area++) {

	// 通信
	$url = 'https://bandainamcoent.co.jp/am/vg/Synchronica/ranking/detail.php?area=' . $area;

	$dom = new DOMDocument('1.0', 'UTF-8');
	@$dom->loadHTMLFile($url);
	$xpath = new DOMXPath($dom);

	// パース
	$list = $xpath->query('//div[@class="rate"]/dl');

	foreach ($list as $li) {
		
		// 取得
		$src    = $xpath->query('dt/img/@src', $li)->item(0)->nodeValue;
		$rating = (float) $xpath->query('dd', $li)->item(0)->nodeValue;

		preg_match('(./img/([1-7])_rank.png)u', $src, $match);
		$rank = (int) $match[1];

		// 反映
		if ( ! isset($info[$rank]['min']) || $rating < $info[$rank]['min'] )
			$info[$rank]['min'] = $rating;
		if ( ! isset($info[$rank]['max']) || $rating > $info[$rank]['max'] )
			$info[$rank]['max'] = $rating;
		
	}

}

// 表示
ksort($info);

for ($rank = 1; $rank <= 7; $rank++) {
	$min = isset($info[$rank]['min']) ? sprintf('%.2f', $info[$rank]['min']) : '不明';
	$max = isset($info[$rank]['max']) ? sprintf('%.2f', $info[$rank]['max']) : '不明';
	printf("☆%d : %s ～ %s\n", $rank, $min, $max);
}

?>
