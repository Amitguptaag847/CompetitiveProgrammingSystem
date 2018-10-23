<?php

function getOutputJava($input,$time_limit,$sleep,$path){
	$compiler="javac";
	$filename_code="main.java";
	$filename_input="input.txt";
  $filename_language = "language.txt";
  $filename_lastcode = "code.txt";
	$filename_error="error.txt";
	$executable_file="test";
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
