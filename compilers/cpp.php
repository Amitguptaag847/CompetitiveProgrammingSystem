<?php

$questionlevel_number = $_POST['questionlevel_number'];
$path="data/users/".$user_id;
if(!file_exists($path)){
  if (!mkdir($path, 0777, true)) {
      die('Failed to create folders...');
  }
}
exec("chmod 777 ".$path);
$path="data/users/".$user_id."/".$questionlevel_number;
if(!file_exists($path)){
  if (!mkdir($path, 0777, true)) {
      die('Failed to create folders...');
  }
}
exec("chmod 777 ".$path);
$path = $path."/";

  function PsExecute($command, $timeout, $sleep,$pathcmd) {
    // First, execute the process, get the process ID
    $sleep = $sleep * 1000000;

    $pid = PsExec($command,$pathcmd);

    if( $pid === false )
        return false;

    $cur = 0;
    // Second, loop for $timeout seconds checking if process is running
    while( $cur < $timeout ) {
        usleep($sleep);
        $temp_time = $sleep/1000000;
        $cur += $temp_time;
        //echo $cur."   ".$timeout;
        // If process is no longer running, return true;-

        if( !PsExists($pid) ){
            return true; // Process must have exited, success!
          }
    }

    // If process is still running after timeout, kill the process and return false
    PsKill($pid);
    return false;
  }

  function PsExec($commandJob,$pathcmd) {
      $command = $commandJob.' > '.$pathcmd.'output.txt 2> '.$pathcmd.'output.txt & echo $!';

      exec($command ,$op);
      $pid = (int)$op[0];

      if($pid!="") return $pid;

      return false;
  }

  function PsExists($pid) {

      exec("ps ax | grep $pid 2>&1", $output);

      while( list(,$row) = each($output) ) {

              $row_array = explode(" ", $row);
              $check_pid = $row_array[0];

              if($pid == $check_pid) {
                      return true;
              }

      }

      return false;
  }

  function PsKill($pid) {
      exec("kill -9 $pid", $output);
  }


  $time_limit = 30; // 30 second is the maximum time of execution
  $sleep = 0.2; // Sleep for 0.2 second
	$compiler="g++";
	$code=$_POST["code"];
	$input=$_POST["input"];
	$filename_code="main.cpp";
	$filename_input="input.txt";
  $filename_language = "language.txt";
  $filename_lastcode = "code.txt";
	$filename_error="error.txt";
	$executable_file="main";
	$command=$compiler." -o ".$path.$executable_file." ".$path.$filename_code." -lm";
	$command_error=$command." 2>".$path.$filename_error;

	$file_code=fopen($path.$filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
  $file_language=fopen($path.$filename_language,"w+");
	fwrite($file_language,$language);
	fclose($file_language);
  $file_lastcode=fopen($path.$filename_lastcode,"w+");
	fwrite($file_lastcode,$code);
	fclose($file_lastcode);
	$file_in=fopen($path.$filename_input,"w+");
	fwrite($file_in,$input);
	fclose($file_in);

	shell_exec($command_error);
	$error=file_get_contents($path.$filename_error);

	if(trim($error)=="")
	{
    if(trim($input)=="")
		{
			if(PsExecute("./".$path.$executable_file,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
        if($output == ""){
          $output = "Core Dump OR Segmentation Fault OR You have not printed any value";
        }
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		else
		{
			if(PsExecute("./".$path.$executable_file." < ".$path.$filename_input,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
        if($output == ""){
          $output = "Core Dump OR Segmentation Fault OR You have not printed any value";
        }
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
    $queueDb->dqueue($user_id,'run');//Check compile.php
		echo $output;
	}
	else if(!strpos($error,"error"))
	{
    if(trim($input)=="")
		{
			if(PsExecute("./".$path.$executable_file,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
        if($output == ""){
          $output = "Core Dump OR Segmentation Fault OR You have not printed any value";
        }
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		else
		{
			if(PsExecute("./".$path.$executable_file." < ".$path.$filename_input,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
        if($output == ""){
          $output = "Core Dump OR Segmentation Fault OR You have not printed any value";
        }
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
    $queueDb->dqueue($user_id,'run');//Check compile.php
		echo $output;
	}
	else
	{
    $queueDb->dqueue($user_id,'run');//Check compile.php
		echo "Compilation error".$error;
	}

?>
