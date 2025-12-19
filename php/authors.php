<?php include("../inc/include_header.php");?>
<main class="container-fluid maincontent">
		<div class="row justify-content-center gapAboveLarge">
			<div class="col-sm-12 col-md-8">
				<div class="extra-info-bar fixed-top">	
					<h1 class="clr1 pt-5">రచయితలు</h1>
					<div class="alphabet">
						<span class="letter"><a href="authors.php?letter=అ">అ</a></span>
					<span class="letter"><a href="authors.php?letter=ఆ">ఆ</a></span>
					<span class="letter"><a href="authors.php?letter=ఇ">ఇ</a></span>
					<span class="letter"><a href="authors.php?letter=ఈ">ఈ</a></span>
					<span class="letter"><a href="authors.php?letter=ఉ">ఉ</a></span>
					<span class="letter"><a href="authors.php?letter=ఊ">ఊ</a></span>
					<span class="letter"><a href="authors.php?letter=ఋ">ఋ</a></span>
					<span class="letter"><a href="authors.php?letter=ఎ">ఎ</a></span>
					<span class="letter"><a href="authors.php?letter=ఏ">ఏ</a></span>
					<span class="letter"><a href="authors.php?letter=ఐ">ఐ</a></span>
					<span class="letter"><a href="authors.php?letter=ఒ">ఒ</a></span>
					<span class="letter"><a href="authors.php?letter=ఓ">ఓ</a></span>
					<span class="letter"><a href="authors.php?letter=ఔ">ఔ</a></span>
					<span class="letter"><a href="authors.php?letter=క">క</a></span>
					<span class="letter"><a href="authors.php?letter=ఖ">ఖ</a></span>
					<span class="letter"><a href="authors.php?letter=గ">గ</a></span>
					<span class="letter"><a href="authors.php?letter=ఘ">ఘ</a></span>
					<span class="letter"><a href="authors.php?letter=చ">చ</a></span>
					<span class="letter"><a href="authors.php?letter=ఛ">ఛ</a></span>
					<span class="letter"><a href="authors.php?letter=ద">ద</a></span>
					<span class="letter"><a href="authors.php?letter=ధ">ధ</a></span>
					<span class="letter"><a href="authors.php?letter=త">త</a></span>
					<span class="letter"><a href="authors.php?letter=థ">థ</a></span>
					<span class="letter"><a href="authors.php?letter=ద">ద</a></span>
					<span class="letter"><a href="authors.php?letter=ధ">ధ</a></span>
					<span class="letter"><a href="authors.php?letter=న">న</a></span>
					<span class="letter"><a href="authors.php?letter=ప">ప</a></span>
					<span class="letter"><a href="authors.php?letter=ఫ">ఫ</a></span>
					<span class="letter"><a href="authors.php?letter=బ">బ</a></span>
					<span class="letter"><a href="authors.php?letter=భ">భ</a></span>
					<span class="letter"><a href="authors.php?letter=మ">మ</a></span>
					<span class="letter"><a href="authors.php?letter=య">య</a></span>
					<span class="letter"><a href="authors.php?letter=ర">ర</a></span>
					<span class="letter"><a href="authors.php?letter=ల">ల</a></span>
					<span class="letter"><a href="authors.php?letter=వ">వ</a></span>
					<span class="letter"><a href="authors.php?letter=శ">శ</a></span>
					<span class="letter"><a href="authors.php?letter=ష">ష</a></span>
					<span class="letter"><a href="authors.php?letter=స">స</a></span>
					<span class="letter"><a href="authors.php?letter=హ">హ</a></span>
					<span class="letter"><a href="authors.php?letter=ళ">ళ</a></span>
					<span class="letter"><a href="authors.php?letter=other">#</a></span>
					</div>
					<?php include("include_secondary_nav.php");?>
				</div>
			</div>
			<div class="col-sm-12 col-md-8 gapAbove gapBelowLargeSpecial">
				<p class="mb-sm-5">&nbsp;</p>
			</div>
		</div>			
		<div class="row justify-content-center">	
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['letter']))
{
	$letter=$_GET['letter'];

	if(!(isValidLetter($letter)))
	{
		echo '<span class="aFeature clr2">Invalid URL</span>';
		echo '</div>';
		echo '</div>';
		echo '</main>';
		include("include_footer.php");

		exit(1);
	}

	($letter == '') ? $letter = 'అ' : $letter = $letter;
}
else
{
	$letter = 'అ';
}

//~ $query = 'select * from author where authorname like \'' . $letter . '%\' order by authorname';
if($letter == 'other')
{
	$query = "SELECT * FROM author WHERE authorname REGEXP '^[A-Za-z]'";
}
else
{
	$query = "select * from author where authorname like '$letter%'  union select * from author where authorname like '\"$letter%' union select * from author where authorname like '\'$letter%' order by TRIM(BOTH '\'' FROM TRIM(BOTH '\"' FROM authorname))";
}

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
$firstEntry = true;

if($num_rows > 0)
{

	while($row = $result->fetch_assoc())
	{
		{
		echo '<div class="author text-left">';
		echo '	<span class="aAuthor"><a href="auth.php?authid=' . $row['authid'] . '&amp;author=' . urlencode($row['authorname']) . '">' . $row['authorname'] . '</a> ';
		echo '</div>';
	}
	}
}
else
{
	// echo '<p class="sml mt-5 text-center clr2">ಇಲ್ಲಿ \'' . $letter . '\' ಅಕ್ಷರದಿಂದ ಪ್ರಾರಂಭವಾಗುವ ಹೆಸರಿನ ಲೇಖಕರಿಲ್ಲ</p>';
	echo '<p class="sml mt-5 text-center clr2">ఇక్కడ \'' . $letter . '\' అక్షరంతో ప్రారంభమయ్యే పేర్లు ఉన్న రచయితలు ఎవరూ లేరు.';
}

if($result){$result->free();}
$db->close();

?>
		</div> 
	</main> 
<?php include("../inc/include_footer.php");?>
