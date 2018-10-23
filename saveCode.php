<?php
  $language = $_POST['language'];
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
  $path = $path."/";

	$code=$_POST["code"];
  $filename_language = "language.txt";
  $filename_lastcode = "code.txt";

  $file_language=fopen($path.$filename_language,"w+");
	fwrite($file_language,$language);
	fclose($file_language);
  $file_lastcode=fopen($path.$filename_lastcode,"w+");
	fwrite($file_lastcode,$code);
	fclose($file_lastcode);

  echo "Success";
?>
