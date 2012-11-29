<?php

require(dirname(__FILE__).'/../lib/Profiler.php');

////////////////////////////////////////////////////////////////////////////////

$p = new Profiler;

//--------------------------------------

$size  = $loops = 1e3;

$data = new SplFixedArray($size);
$results = new SplFixedArray($size);
for ($i = 0; $i < $size; ++$i)
{
	$data[$i] = (rand(0, 1) === 0 ? null : true);
	$results[$i] = true;
}

////////////////////////////////////////////////////////////////////////////////

$p->start('!isset($val)');
for ($i = 0; $i < $loops; ++$i)
{
	foreach ($data as $j => $entry)
	{
		$results[$j] = !isset($entry);
	}
}
unset($j, $entry);
$p->stop();

//--------------------------------------

$p->start('$val === null');
for ($i = 0; $i < $loops; ++$i)
{
	foreach ($data as $j => $entry)
	{
		$results[$j] = ($entry === null);
	}
}
unset($j, $entry);
$p->stop();

//--------------------------------------

$p->start('is_null($val)');
for ($i = 0; $i < $loops; ++$i)
{
	foreach ($data as $j => $entry)
	{
		$results[$j] = is_null($entry);
	}
}
unset($j, $entry);
$p->stop();

////////////////////////////////////////////////////////////////////////////////

$p->present();
