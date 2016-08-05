<?php

function isValidId($book_id)
{
	if(is_array($book_id)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $book_id) ? true : false;
}

function isValidType($type)
{
	if(is_array($type)){return false;}
	return preg_match("/^(rec|mem|occ|fbi|fi|sfs|cas|ess|hpg|spb|sse|tcm|zlg|bul)$/", $type) ? true : false;
}

function isValidCheck($check)
{
	for($i=0;$i<sizeof($check);$i++)
	{
		if(is_array($check[$i])){return false;}
		if(!(preg_match("/^(rec|mem|occ|fbi|fi|sfs|cas|ess|hpg|spb|sse|tcm|zlg|bul)$/", $check[$i])))
		{
			return false;
		}
	}
	return true;
}

function isValidTitle($title)
{
	return is_array($title) ? false : true;
}
function isValidLetter($letter)
{
	return is_array($letter) ? false : true;
}
function isValidVolume($vol)
{
	if(is_array($vol)){return false;}
	return preg_match("/^[0-9][0-9][0-9]$/", $vol) ? true : false;
}

function isValidPart($part)
{
	if(is_array($part)){return false;}
	return preg_match("/([0-9][0-9]\-[0-9][0-9])||([0-9][0-9])/", $part) ? true : false;
}

function isValidYear($year)
{
	if(is_array($year)){return false;}
	return preg_match("/^([0-9][0-9][0-9][0-9]|[0-9][0-9][0-9][0-9]\-[0-9][0-9])$/", $year) ? true : false;
}

function isValidFeature($feature)
{
	return is_array($feature) ? false : true;
}

function isValidFeatid($featid)
{
	if(is_array($featid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $featid) ? true : false;
}

function isValidAuthid($authid)
{
	if(is_array($authid)){return false;}
	return preg_match("/^[0-9][0-9][0-9][0-9][0-9]$/", $authid) ? true : false;
}

function isValidAuthor($author)
{
	return is_array($author) ? false : true;
}

function isValidText($text)
{
	return is_array($text) ? false : true;
}

function entityReferenceReplace($term)
{
	if(is_array($term))
	{
		$term = "$term";
	}
	
	$term = preg_replace("/<i>/", "", $term);
	$term = preg_replace("/<\/i>/", "", $term);
	$term = preg_replace("/\;/", "&#59;", $term);
	$term = preg_replace("/</", "&#60;", $term);
	$term = preg_replace("/=/", "&#61;", $term);
	$term = preg_replace("/>/", "&#62;", $term);
	$term = preg_replace("/\(/", "&#40;", $term);
	$term = preg_replace("/\)/", "&#41;", $term);
	$term = preg_replace("/\:/", "&#58;", $term);
	$term = preg_replace("/Drop table|Create table|Alter table|Delete from|Desc table|Show databases|iframe/i", "", $term);
	
	return($term);
}

function getYearMonth($volume, $part)
{
	include("connect.php");

	$query = "select distinct year,month from article where volume='$volume' and part='$part'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
		return($row);
	}
	else
	{
		$row['year'] = '';
		$row['month'] = '';
		return($row);
	}
}

function getmaasa($volume, $part)
{
	include("connect.php");

	$query = "select distinct maasa, samvatsara from article where volume='$volume' and part='$part'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$row = $result->fetch_assoc();
		return($row);
	}
	else
	{
		$row['maasa'] = '';
		$row['samvatsara'] = '';
		return($row);
	}
}

function getYear($volume)
{
	include("connect.php");

	$query = "select distinct year from article where volume='$volume'";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;
	if($num_rows > 0)
	{
		$year = '';
		while($row = $result->fetch_assoc())
		{
			$year = $year . '-' . $row['year'];
		}
		$year = preg_replace('/^\-/', '', $year);
		$year = preg_replace('/\-[0-9][0-9]([0-9][0-9])/', '-$1', $year);
		return( $year );
	}
	else
	{
		return( '' );
	}
}

function getMonth($month)
{
	$month = preg_replace('/01/', 'ಜನವರಿ', $month);
	$month = preg_replace('/02/', 'ಫೆಬ್ರವರಿ', $month);
	$month = preg_replace('/03/', 'ಮಾರ್ಚ್', $month);
	$month = preg_replace('/04/', 'ಏಪ್ರಿಲ್', $month);
	$month = preg_replace('/05/', 'ಮೇ', $month);
	$month = preg_replace('/06/', 'ಜೂನ್', $month);
	$month = preg_replace('/07/', 'ಜುಲೈ', $month);
	$month = preg_replace('/08/', 'ಆಗಸ್ಟ್', $month);
	$month = preg_replace('/09/', 'ಸೆಪ್ಟೆಂಬರ್', $month);
	$month = preg_replace('/10/', 'ಅಕ್ಟೋಬರ್', $month);
	$month = preg_replace('/11/', 'ನವೆಂಬರ್', $month);
	$month = preg_replace('/12/', 'ಡಿಸೆಂಬರ್', $month);
	
	return $month;
}
function getTeluguMonth($month)
{
	$month = preg_replace('/01/', 'జనవరి', $month);
	$month = preg_replace('/02/', 'ఫిబ్రవరి', $month);
	$month = preg_replace('/03/', 'మార్చ్', $month);
	$month = preg_replace('/04/', 'ఏప్రిల్', $month);
	$month = preg_replace('/05/', 'మే', $month);
	$month = preg_replace('/06/', 'జూన్', $month);
	$month = preg_replace('/07/', 'జులై', $month);
	$month = preg_replace('/08/', 'ఆగష్టు', $month);
	$month = preg_replace('/09/', 'సెప్టెంబర్', $month);
	$month = preg_replace('/10/', 'అక్టోబర్', $month);
	$month = preg_replace('/11/', 'నవంబర్', $month);
	$month = preg_replace('/12/', 'డిసెంబర్', $month);
	
	return $month;
}
function toKannada($value)
{
	$value = preg_replace('/0/', '೦', $value);
	$value = preg_replace('/1/', '೧', $value);
	$value = preg_replace('/2/', '೨', $value);
	$value = preg_replace('/3/', '೩', $value);
	$value = preg_replace('/4/', '೪', $value);
	$value = preg_replace('/5/', '೫', $value);
	$value = preg_replace('/6/', '೬', $value);
	$value = preg_replace('/7/', '೭', $value);
	$value = preg_replace('/8/', '೮', $value);
	$value = preg_replace('/9/', '೯', $value);
	
	return $value;
}
function toTelugu($value)
{
	$value = preg_replace('/0/', '౦', $value);
	$value = preg_replace('/1/', '౧', $value);
	$value = preg_replace('/2/', '౨', $value);
	$value = preg_replace('/3/', '౩', $value);
	$value = preg_replace('/4/', '౪', $value);
	$value = preg_replace('/5/', '౫', $value);
	$value = preg_replace('/6/', '౬', $value);
	$value = preg_replace('/7/', '౭', $value);
	$value = preg_replace('/8/', '౮', $value);
	$value = preg_replace('/9/', '౯', $value);
	
	return $value;
}
/*
isValidTitle, isValidFeature, isValidAuthor, isValidText
*/
?>
