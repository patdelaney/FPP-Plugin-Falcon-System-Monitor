<?php
//$DEBUG=true;

$skipJSsettings = 1;
//include_once '/opt/fpp/www/config.php';
include_once '/opt/fpp/www/common.php';

$pluginName = "FalconSystemMonitor";

$pluginUpdateFile = $settings['pluginDirectory']."/".$pluginName."/"."pluginUpdate.inc";


include_once 'functions.inc.php';
include_once 'commonFunctions.inc.php';

include_once 'version.inc';

$myPid = getmypid();

$gitURL = "https://github.com/LightsOnHudson/FPP-Plugin-Falcon-System-Monitor.git";

//arg0 is  the program
//arg1 is the first argument in the registration this will be --list
//$DEBUG=true;
$logFile = $settings['logDirectory']."/".$pluginName.".log";
$sequenceExtension = ".fseq";

logEntry("plugin update file: ".$pluginUpdateFile);

//logEntry("open log file: ".$logFile);



$DEBUG = false;

if(isset($_POST['updatePlugin']))
{
	$updateResult = updatePluginFromGitHub($gitURL, $branch="master", $pluginName);
	
	echo $updateResult."<br/> \n";
}

if(isset($_POST['submit']))
{
	

	
	
	//$ENABLED=$_POST["ENABLED"];

	//	echo "Writring config fie <br/> \n";


//	WriteSettingToFile("PROJ_PASSWORD",urlencode($_POST["PROJ_PASSWORD"]),$pluginName);

	

} 


	
	
	//$ENABLED = ReadSettingFromFile("ENABLED",$pluginName);
	$ENABLED = urldecode($pluginSettings['ENABLED']);
	
	
	//test variables
	$IP_ADDRESS = "10.0.0.106";
?>

<html>
<head>
</head>

<div id="plugin" class="settings">
<fieldset>
<legend>Falcon System Monitor Support/Install Instructions</legend>

<p>Known Issues:
<ul>
<li>NONE</li>
</ul>


<p>Configuration:
<ul>
<li></li>
</ul>

<form method="post" action="http://<? echo $_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT']?>/plugin.php?plugin=ProjectorControl&page=plugin_setup.php">
<br>
<p/>

<?

echo "VER: ".$VERSION;
echo "<br/> \n";

echo "ENABLE PLUGIN: ";

//if($ENABLED == "on" || $ENABLED == 1) {
//	echo "<input type=\"checkbox\" checked name=\"ENABLED\"> \n";
	PrintSettingCheckbox($pluginName, "ENABLED", $restart = 0, $reboot = 0, "ON", "OFF", $pluginName = $pluginName, $callbackName = "");
//} else {
//	echo "<input type=\"checkbox\"  name=\"ENABLED\"> \n";
//}
echo "<p/>\n";

//get a list of falcon controllers
echo "<table border=\1\" cellspacing=\"3\" cellpadding=\"3\"> \n";

echo "<th colspan=\"4\"> \n";
echo "Falcon System Monitoring \n";
echo "</th> \n";
echo "<tr> \n";

echo "<td> \n";
PrintFalconSystemsSelect();
echo "</td> \n";
echo "<td> \n";
echo "hostname: \n";
echo "</td> \n";
echo "<td> \n";
echo gethostbyaddr($_SERVER[$IP_ADDRESS]);
echo "</td> \n";
echo "<td> \n";
echo "Processor Temp: \n";
echo "</td> \n";

$temp_processor = getProcessorTemp($IP_ADDRESS);
$farenheight_temp_processor = celciusToFarenheight($temp_processor);
echo "<td> \n";
echo "<input type=\"text\" size=\"15\" name=\"temp_processor\" value=\"".$temp_processor."\"> \n";
echo "</td> \n";
echo "<td> \n";
echo "Farenheight: \n";
echo "</td> \n";
echo "<td> \n";
echo $farenheight_temp_processor;
echo "</td> \n";
echo "</tr> \n";

echo "</table> \n";


?>
<p/>
<input id="submit_button" name="submit" type="submit" class="buttons" value="Save Config">
</form>


<p>To report a bug, please file it against the  plug-in project on Git: <? echo $gitURL;?>
<form method="post" action="http://<? echo $_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT']?>/plugin.php?plugin=<?echo $pluginName;?>&page=plugin_setup.php">
<?
 if(file_exists($pluginUpdateFile))
 {
 	//echo "updating plugin included";
	include $pluginUpdateFile;
}
?>
</form>
</fieldset>
</div>
<br />
</html>
