<?
function setvalue ($postvalue) {
	if (isset($_POST[$postvalue])) {
		$postvalue2 = preg_replace('/<\/textarea>/', '2142156754235678432', $_POST[$postvalue]);
		return $postvalue2;
	} else {
		return "";
	}

}
?>
<form name='blah' method=post action='regextester.php'>





Regex-input<br>
<textarea name=regex rows=10 cols=100><? echo setvalue('regex') ?></textarea>
<br>
String<br>
<textarea name=data rows=10 cols=100><? echo setvalue('data') ?></textarea>
<br>
Options:<input type=text value='<? echo setvalue('options') ?>' name=options>
Type:<select name=regextype><option>match</option><option>match_all</option><option>replace</option></select>
Replace String:<input type='text' name='replace_string' size=50 value='<? echo setvalue('replace_string')?>'>

<br>
<input type=submit>
</form>
<br>
<script language='javascript'>
	document.getElementsByName('regex')[0].value = document.getElementsByName('regex')[0].value.replace(/2142156754235678432/g, '<\/textarea>');
	document.getElementsByName('data')[0].value = document.getElementsByName('data')[0].value.replace(/2142156754235678432/g, '<\/textarea>');
	document.getElementsByName('replace_string')[0].value = document.getElementsByName('replace_string')[0].value.replace(/2142156754235678432/g, '<\/textarea>');
</script>
<?
if (isset($_POST['regex'], $_POST['data'], $_POST['regextype'], $_POST['options'], $_POST['replace_string'])) {
	$regex = $_POST['regex'];
	$mydata = $_POST['data'];
	$regex = "/".$regex."/".$_POST['options'];

	if ($_POST['regextype'] == "match") {
		preg_match($regex, $mydata, $data);
		echo "Number of matches: ".count($data)."<br>";
		echo "Matches starting:<br>";
		for ($i=0; $i < count($data); $i++) {
			if ($i==0) {
				echo "Match:".$i."<textarea rows=8 cols=200>".$data[$i]."</textarea><br>\n";
			} else {
				echo "Match:".$i."<textarea rows=1 cols=200>".$data[$i]."</textarea><br>\n";
			}
		}
	} elseif ($_POST['regextype'] == "match_all") {
		preg_match_all($regex, $mydata, $data, PREG_SET_ORDER);
		echo "Number of base matches: ".count($data)."<br>";
		for ($a=0; $a < count($data); $a++) {
			for($b=0; $b < count($data[$a]); $b++) {
				if ($b == '0') {
					echo "Match:".$a."-".$b."<textarea rows=4 cols=200>".$data[$a][$b]."</textarea><br>\n";
				} else {
					echo "&nbsp;&nbsp;&nbsp;Match:".$a."-".$b."<textarea rows=1 cols=200>".$data[$a][$b]."</textarea><br>\n";
				}
			}
		}
	} elseif ($_POST['regextype'] == "replace") {
		$data = preg_replace($regex, $_POST['replace_string'], $mydata);
		echo "Output: <textarea rows1 cols=200>".$data."</textarea>";
	}
	echo "<script language='javascript'>document.getElementsByName('regextype')[0].value = '".$_POST['regextype']."';</script>";
}
	


?>
