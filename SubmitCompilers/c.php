<?php

$user_id = $_POST['user_id'];
$question_number = $_POST['question_number'];
$path="data/users/".$user_id;
if(!file_exists($path)){
  if (!mkdir($path, 0777, true)) {
      die('Failed to create folders...');
  }
}
exec("chmod 777 ".$path);
$path="data/users/".$user_id."/".$question_number;
if(!file_exists($path)){
  if (!mkdir($path, 0777, true)) {
      die('Failed to create folders...');
  }
}
exec("chmod 777 ".$path);
$path = $path."/";

  function PsExecute($command, $timeout = 10, $sleep = 2,$pathcmd) {
    // First, execute the process, get the process ID

    $pid = PsExec($command,$pathcmd);

    if( $pid === false )
        return false;

    $cur = 0;
    // Second, loop for $timeout seconds checking if process is running
    while( $cur < $timeout ) {
        sleep($sleep);
        $cur += $sleep;
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



	$compiler="gcc";
	$code=$_POST["code"];
	$input=$_POST["input"];
	$filename_code="main.c";
	$filename_input="input.txt";
	$filename_error="error.txt";
	$executable_file="main.o";
	$command=$compiler." -o ".$path.$executable_file." ".$path.$filename_code;
	$command_error=$command." 2>".$path.$filename_error;


	$file_code=fopen($path.$filename_code,"w+");
	fwrite($file_code,$code);
	fclose($file_code);
	$file_in=fopen($path.$filename_input,"w+");
	fwrite($file_in,$input);
	fclose($file_in);

	shell_exec($command_error);
	$error=file_get_contents($path.$filename_error);

	if(trim($error)=="")
	{
    if(trim($input)=="")
		{
			if(PsExecute("./".$path.$executable_file,10,1,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		else
		{
			if(PsExecute("./".$path.$executable_file." < ".$path.$filename_input,10,1,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		echo $output;
	}
	else if(!strpos($error,"error"))
	{
    if(trim($input)=="")
		{
			if(PsExecute("./".$path.$executable_file,10,1,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		else
		{
			if(PsExecute("./".$path.$executable_file." < ".$path.$filename_input,10,1,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}

		echo $error.$output;
	}
	else
	{
		echo $error;
	}

?>
