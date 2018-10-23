<?php

function getOutputPython($input,$time_limit,$sleep,$path){
	$compiler="python3";
	$filename_code="main.py";
	$filename_input="input.txt";
  $filename_language = "language.txt";
  $filename_lastcode = "code.txt";
	$filename_error="error.txt";
	$command=$compiler." ".$path.$filename_code;
	$command_error=$command." 2>".$path.$filename_error;

	$file_in=fopen($path.$filename_input,"w+");
	fwrite($file_in,$input);
	fclose($file_in);

	shell_exec($command_error);
	$error=file_get_contents($path.$filename_error);

	if(trim($error)=="")
	{
    if(trim($input)=="")
		{
			if(PsExecute($command,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		else
		{
			if(PsExecute($command." < ".$path.$filename_input,$time_limit,$sleep,$path)){
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
			if(PsExecute($command,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}
		else
		{
			if(PsExecute($command." < ".$path.$filename_input,$time_limit,$sleep,$path)){
        $output = file_get_contents($path."output.txt");
      } else {
        $output = "TIME_LIMIT_EXCEED";
      }
		}

		return $output;
	}
	else
	{
		return "Compilation error".$error;
	}
}

?>
