<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1">లేఖనములు</h1>
 				<div class="alphabet gapBelowSmall gapAboveSmall"> 
					<span class="letter"><a href="articles.php?letter=అ">అ</a></span>
					<span class="letter"><a href="articles.php?letter=ఆ">ఆ</a></span>
					<span class="letter"><a href="articles.php?letter=ఇ">ఇ</a></span>
					<span class="letter"><a href="articles.php?letter=ఈ">ఈ</a></span>
					<span class="letter"><a href="articles.php?letter=ఉ">ఉ</a></span>
					<span class="letter"><a href="articles.php?letter=ఊ">ఊ</a></span>
					<span class="letter"><a href="articles.php?letter=ఋ">ఋ</a></span>
					<span class="letter"><a href="articles.php?letter=ఎ">ఎ</a></span>
					<span class="letter"><a href="articles.php?letter=ఏ">ఏ</a></span>
					<span class="letter"><a href="articles.php?letter=ఐ">ఐ</a></span>
					<span class="letter"><a href="articles.php?letter=ఒ">ఒ</a></span>
					<span class="letter"><a href="articles.php?letter=ఓ">ఓ</a></span>
					<span class="letter"><a href="articles.php?letter=ఔ">ఔ</a></span>
					<span class="letter"><a href="articles.php?letter=క">క</a></span>
					<span class="letter"><a href="articles.php?letter=ఖ">ఖ</a></span>
					<span class="letter"><a href="articles.php?letter=గ">గ</a></span>
					<span class="letter"><a href="articles.php?letter=ఘ">ఘ</a></span>
					<span class="letter"><a href="articles.php?letter=చ">చ</a></span>
					<span class="letter"><a href="articles.php?letter=ఛ">ఛ</a></span>
					<span class="letter"><a href="articles.php?letter=ద">ద</a></span>
					<span class="letter"><a href="articles.php?letter=ధ">ధ</a></span>
					<span class="letter"><a href="articles.php?letter=త">త</a></span>
					<span class="letter"><a href="articles.php?letter=థ">థ</a></span>
					<span class="letter"><a href="articles.php?letter=ద">ద</a></span>
					<span class="letter"><a href="articles.php?letter=ధ">ధ</a></span>
					<span class="letter"><a href="articles.php?letter=న">న</a></span>
					<span class="letter"><a href="articles.php?letter=ప">ప</a></span>
					<span class="letter"><a href="articles.php?letter=ఫ">ఫ</a></span>
					<span class="letter"><a href="articles.php?letter=బ">బ</a></span>
					<span class="letter"><a href="articles.php?letter=భ">భ</a></span>
					<span class="letter"><a href="articles.php?letter=మ">మ</a></span>
					<span class="letter"><a href="articles.php?letter=య">య</a></span>
					<span class="letter"><a href="articles.php?letter=ర">ర</a></span>
					<span class="letter"><a href="articles.php?letter=ల">ల</a></span>
					<span class="letter"><a href="articles.php?letter=వ">వ</a></span>
					<span class="letter"><a href="articles.php?letter=శ">శ</a></span>
					<span class="letter"><a href="articles.php?letter=ష">ష</a></span>
					<span class="letter"><a href="articles.php?letter=స">స</a></span>
					<span class="letter"><a href="articles.php?letter=హ">హ</a></span>
					<span class="letter"><a href="articles.php?letter=ళ">ళ</a></span>
					<span class="letter"><a href="articles.php?letter=other">#</a></span>
				</div>
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['letter']))
{
 	$letter=$_GET['letter'];
	
 	if(!(isValidLetter($letter)))
 	{
 		echo '<span class="aFeature clr2">Invalid URL</span>';
 		echo '</div> <!-- cd-container -->';
 		echo '</div> <!-- cd-scrolling-bg -->';
 		echo '</main> <!-- cd-main-content -->';
 		include("include_footer.php");

         exit(1);
 	}
	
 	($letter == '') ? $letter = 'అ' : $letter = $letter;
 }
 else
 {
 	$letter = 'అ';
 }
if($letter == 'other')
{
	$query = "SELECT * FROM article WHERE title REGEXP '^[A-Za-z]'";
}
else
{
	$query = "select * from article where title like '$letter%'  union select * from article where title like '\"$letter%' union select * from article where title like '\'$letter%' order by TRIM(BOTH '\'' FROM TRIM(BOTH '\"' FROM title))";
}

//$query = "SELECT * FROM article ORDER BY TRIM(BEGIN '\"' FROM title)";
//$query = "SELECT * FROM article ORDER BY TRIM(BOTH '\'' FROM TRIM(BOTH '\"' FROM title))";


$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$query3 = 'select feat_name from feature where featid=\'' . $row['featid'] . '\'';
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();
		$titleid = $row['titleid'];
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		$info = '';
		if($row['month'] != '')
		{
			$info = $info . getTeluguMonth($row['month']);
		}
		if($row['year'] != '')
		{
			$info = $info . ' <span class="font_size">' . toTelugu(intval($row['year'])) . '</span>';
		}
		if($row['maasa'] != '')
		{
			$info = $info . ', ' . $row['maasa'] . '&nbsp;మాసము';
		}
		if($row['samvatsara'] != '')
		{
			$info = $info . ', ' . $row['samvatsara'] . '&nbsp;సంవత్సరము';
		}
		$info = preg_replace("/^,/", "", $info);
		$info = preg_replace("/^ /", "", $info);
		
		$sumne = preg_split('/-/' , $row['page']);
		$row['page'] = $sumne[0];
		if($result3){$result3->free();}

		echo '<div class="article">';
		echo '	<div class="gapBelowSmall">';
		echo ($row3['feat_name'] != '') ? '		<span class="aFeature clr2"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span> | ' : '';
		echo '		<span class="aIssue clr5"><a href="toc.php?vol=' . $row['volume'] . '&amp;part=' . $row['part'] . '">సంపుట ' . toTelugu(intval($row['volume'])) . ', సంచికే ' . toTelugu($dpart) . ' <span class="font_resize">(' . $info . ')</span></a></span>';
		echo '	</div>';
		//~ echo '	<span class="aTitle"><a target="_blank" href="bookReader.php?volume=' . $row['volume'] . '&amp;part=' . $row['part'] . '&amp;page=' . $row['page'] . '">' . $row['title'] . '</a></span>';
		//~ DJVU link
		echo '	<span class="aTitle"><a target="_blank" href="../Volumes/djvu/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span>';
		if($row['authid'] != 0) {

			echo '<br /><span class="aAuthor">&nbsp;&nbsp;&mdash;';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a class="delim" href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">' . $authornames[$a] . '</a> ';
				$a++;
			}
			
			echo '	</span>';
		}
		echo '<br/><span class="downloadspan"><a target="_blank" href="downloadPdf.php?titleid='.$titleid.'">డౌన్లోడ్ పిడిఎఫ్</a></span>';
		echo '</div>';
	}
}
else
{
	echo '<span class="sml">ఇక్కడ \'' . $letter . '\' అక్షరనుండి ప్రారంభించె లేఖనములు దొరకలేదు';
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
