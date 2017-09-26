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

function dirCreator($file, $path) {
	$expl1 = explode('.', $file);
	$expl2 = preg_split("/_/", $expl1[0]);
	array_pop($expl2);
	replaceFile($file, $path, $expl2[0]);
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
