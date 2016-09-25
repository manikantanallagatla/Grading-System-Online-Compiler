<html>
<body>

<?php
//echo $_POST["code"];
//echo $_POST["testcases"];
$output = "";
$code = $_GET["code"];
$testcases = $_GET["testcases"];

$file = "code.txt"; // cannot be an online resource
$Saved_File = fopen($file, 'w');
fwrite($Saved_File, $code);
fclose($Saved_File);

$file = "testcases.txt"; // cannot be an online resource
$Saved_File = fopen($file, 'w');
fwrite($Saved_File, $testcases);
fclose($Saved_File);

$data = array('dummy');

$pythonScript = "/opt/lampp/htdocs/tryFolder/runme.py";
$cmd = array("python", $pythonScript, escapeshellarg(json_encode($data)));
$cmdText = implode(' ', $cmd);

echo "Running command: " . $cmdText . "\n";
echo "<br/>";
$result = shell_exec($cmdText);

echo "Got the following result:\n";
echo "<br/>";
echo $result;

//$resultData = json_decode($result, true);

?>

</body>
</html>
