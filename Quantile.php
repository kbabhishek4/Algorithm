<?php
/*copyright developers.hokite.com
 * Author:kbabhishek4@yahoo.in
 */
function Transform(&$a) {
	$t = array();
	foreach ($a as $k => $v) {
		foreach ($v as $k2 => $v2) {
			$t[$k2][$k] = @$a[$k][$k2];
		}
	}
	$a = $t;
}

function Ranking(array $v) {
	static $a = 0;
	$temp = array();
	$temp = $v;
	sort($temp);
	$r = array();
	foreach ($v as $key => $val) {
		$kn = array_search($val, $temp);
		$r[$key] = $kn + 1;
	}
	return $r;
}

function Quantile(array $a) {
	$rank = array();
	Transform($a);
	foreach ($a as $k => $v) {
		$rank[] = Ranking($v);
	}
	$t = array();
	foreach ($a as $k => $v) {
		sort($v);
		$t[] = $v;
	}
	$a = $t;
	Transform($a);
	foreach ($a as $key => $val) {
		$avg[] = array_sum($val) / count($val);
	}
	$avg_rank = array();
	$avg_rank = Ranking($avg);
	Transform($rank);
	$ret_res = array();
	foreach ($rank as $key => $val) {
		foreach ($val as $key2 => $val2) {
			$ret_res[$key][$key2] = $avg[array_search($val2, $avg_rank)];
		}
	}
	return $ret_res;
}

$a[0] = array(5, 4, 3);
$a[1] = array(2, 1, 4);
$a[2] = array(3, 4, 6);
$a[3] = array(4, 2, 8);
$res = Quantile($a);
echo "\n\n<pre><b>========================final result=========================\n\n";
print_r($res);
?>
