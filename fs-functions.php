<?php

function getFiles($path = "E:\Vids\\", $typeOfFiles = "/.mp4$/") {
	$r = opendir($path);
	$filesArray = array();
	while (($file = readdir($r)) !== false) {
		if (!is_dir($file)) {
			if (preg_match($typeOfFiles, $file)) {
				echo $file."<br>";
			}
		}
	}
	return $filesArray;
}

function replaceFile($file, $path, $newdir) {
	$expl = explode('.', $file);
	$copy = copy($path.$file, $path.$newdir.'\\'.$file);

	if ($copy) {
		unlink($path.$file);
	} else {
		echo "Ошибка при копировании $file<br>";
	}
}
