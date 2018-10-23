<?php

function getOutputCpp($input,$time_limit,$sleep,$path){
	$compiler="g++";
	$filename_code="main.cpp";
	$filename_input="input.txt";
  $filename_language = "language.txt";
  $filename_lastcode = "code.txt";
	$filename_error="error.txt";
	$executable_file="main";
	$command=$compiler." -o ".$path.$executable_file." ".$path.$filename_code." -lm";
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
		return $output;
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

		return $output;
	}
	else
	{
		return "Compilation error".$error;
	}
}

?>
