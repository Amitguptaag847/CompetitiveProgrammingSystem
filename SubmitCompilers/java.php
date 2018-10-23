<?php

$code = $_POST['code'];
$user_id = $_POST['user_id'];
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
$path="data/users/".$user_id."/".$questionlevel_number."/submittedCode";
if(!file_exists($path)){
  if (!mkdir($path, 0777, true)) {
      die('Failed to create folders...');
  }
}
exec("chmod 777 ".$path);
$path = $path."/";

  function PsExecute($command, $timeout = 10, $sleep = 1,$pathcmd) {
    // First, execute the process, get the process ID
    $sleep = $sleep*1000000;
    $pid = PsExec($command,$pathcmd);

    if( $pid === false )
        return false;

    $cur = 0;
    // Second, loop for $timeout seconds checking if process is running
    while( $cur < $timeout ) {
        usleep($sleep);
        $temp_time = $sleep/1000000;
        $cur += $temp_time;
        // If process is no longer running, return true;-

        if( !PsExists($pid) )
            return true; // Process must have exited, success!
    }

    // If process is still running after timeout, kill the process and return false
    PsKill($pid);
    return false;
  }

  function PsExec($commandJob,$pathcmd) {
      $command = $commandJob.' > '.$pathcmd.'output.txt 2>&1 & echo $!';
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


function getOutput($input,$code,$time_limit,$sleep,$path,$language){
	$compiler="javac";
	$filename_code="main.java";
	$filename_input="input.txt";
  $filename_language = "language.txt";
  $filename_lastcode = "code.txt";
	$filename_error="error.txt";
	$executable_file="test";
	$command=$compiler." ".$path.$filename_code;
	$command_error=$command." 2>".$path.$filename_error;

	$file_code=fopen($path.$filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
  $file_language=fopen($path.$filename_language,"w+");
	fwrite($file_language,$language);
	fclose($file_language);
  $file_runlanguage=fopen($path."../".$filename_language,"w+");
	fwrite($file_runlanguage,$language);
	fclose($file_runlanguage);
  $file_lastcode=fopen($path.$filename_lastcode,"w+");
	fwrite($file_lastcode,$code);
	fclose($file_lastcode);
  $file_last_runcode=fopen($path."../".$filename_lastcode,"w+");
	fwrite($file_last_runcode,$code);
	fclose($file_last_runcode);
	$file_in=fopen($path.$filename_input,"w+");
	fwrite($file_in,$input);
	fclose($file_in);

	shell_exec($command_error);
	$error=file_get_contents($path.$filename_error);

	if(trim($error)=="")
	{
    if(trim($input)=="")
		{
			if(PsExecute("java -cp ".$path." ".$executable_file,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		else
		{
			if(PsExecute("java -cp ".$path." ".$executable_file." < ".$path.$filename_input,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		return $output;
	}
	else if(!strpos($error,"error"))
	{
    if(trim($input)=="")
		{
			if(PsExecute("java -cp ".$path." ".$executable_file,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		else
		{
			if(PsExecute("java -cp ".$path." ".$executable_file." < ".$path.$filename_input,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}

		return $output;
	}
	else
	{
		return "Compilation error   ".$error;
	}
}

?>
