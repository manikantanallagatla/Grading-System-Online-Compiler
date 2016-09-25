<?php 

error_reporting(E_ERROR | E_PARSE);   //while debugging remove this as ll warnings lost!! 

?>
<html>
<head>
	<title>
		Manikanta Online Compiler
	</title>
</head>
<body>
<h1>
I am Manikanta. I am a SAM Fan!!
</h1>
<form method="post">
Select language:
<select name = "lang" id = "lang" value="<?php echo $_POST["lang"];?>">
  <option <?php if ($_POST["lang"] == '5') { ?>selected="true" <?php }; ?> value='5'>Python</option>
  <option <?php if ($_POST["lang"] == '2') { ?>selected="true" <?php }; ?> value='2'>c++</option>
  <option <?php if ($_POST["lang"] == '3') { ?>selected="true" <?php }; ?> value='3'>Java</option>
  <option <?php if ($_POST["lang"] == '14') { ?>selected="true" <?php }; ?> value='14'>Bash</option>
  <option <?php if ($_POST["lang"] == '1') { ?>selected="true" <?php }; ?> value='1'>C</option>
  <option <?php if ($_POST["lang"] == '9') { ?>selected="true" <?php }; ?> value='9'>Csharp</option>
  <option <?php if ($_POST["lang"] == '10') { ?>selected="true" <?php }; ?> value='10'>MySql</option>
  <option <?php if ($_POST["lang"] == '11') { ?>selected="true" <?php }; ?> value='11'>Oracle</option>
  <option <?php if ($_POST["lang"] == '6') { ?>selected="true" <?php }; ?> value='6'>Perl</option>
  <option <?php if ($_POST["lang"] == '7') { ?>selected="true" <?php }; ?> value='7'>Php</option>
  <option <?php if ($_POST["lang"] == '8') { ?>selected="true" <?php }; ?> value='8'>Ruby</option>
  <option <?php if ($_POST["lang"] == '15') { ?>selected="true" <?php }; ?> value='15'>Scala</option>
</select>
<br>
Code:
<br>
<textarea type = "text" rows="200" cols="100" id = "1" name = "code" style="resize: none;max-height:150px;min-height:150px;">
<?php if(isset($_POST['code'])) { 
         echo htmlentities ($_POST['code']); }?>
</textarea>
<br>
Test cases:
<br>
<textarea type = "text" rows="200" cols="100" id = "2" name = "testcases" style="resize: none;max-height:150px;min-height:150px;">
<?php if(isset($_POST['testcases'])) { 
         echo htmlentities ($_POST['testcases']); }?>
</textarea> 
<br>

<input type="submit">
</form>

</body>
</html>
<?php

// if(isset($_POST['submit'])) {
//echo $_POST["code"];
//echo $_POST["testcases"];
$code = $_POST["code"];
$testcases = $_POST["testcases"];
$language_no = $_POST["lang"];
// echo $language_no;
// document.getElementById("1").innerHTML = $code;
// document.getElementById("2").innerHTML = $testcases;
// echo "code is :" . $code . "\n";
// echo "<br/>";
// echo "testcases is :" . $testcases . "\n";
// echo "<br/>";
$file = "code.txt"; 
$Saved_File = fopen($file, 'w');
fwrite($Saved_File, $code);
fclose($Saved_File);

$file = "testcases.txt"; 
$Saved_File = fopen($file, 'w');
fwrite($Saved_File, $testcases);
fclose($Saved_File);

$data = array('dummy');

$pythonScript = "/opt/lampp/htdocs/tryFolder/runme.py $language_no";
// echo $pythonScript;
$cmd = array("python", $pythonScript, escapeshellarg(json_encode($data)));
$cmdText = implode(' ', $cmd);

// echo "Running command: " . $cmdText . "\n";
// echo "<br/>";
$result = shell_exec($cmdText);
// $arr = json_decode($result);
$lines = explode("\n", $result);
if($lines[0] === "[]"){
	$lines[0] = "[error]";
}
echo "Compile message:<br><textarea rows='2' cols='100' name = 'resultbox' style='resize: none;max-height:50px;min-height:50px;'>$lines[0]</textarea><br>";
?>
Output:
<br>
<textarea rows="200" cols="100" name = "testcases" style="resize: none;max-height:150px;min-height:150px;">
<?php
$output_print = $lines[1];
$output_print = str_replace("[","",$output_print);
$output_print = str_replace("]","",$output_print);
$output_print = str_replace("'","",$output_print);

$token = strtok($output_print, "\\n");

while ($token !== false)
{
echo "$token". "\xA";;
// echo "<br>";
$token = strtok("\\n");
// } 
}
// echo $output_print;
?>
</textarea>
<script type="text/javascript">
 $(this).data('code', <?php echo $code ?>);
</script>
