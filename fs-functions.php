<?php

function replaceFile($file, $path, $newdir) {
	$expl = explode('.', $file);
	$copy = copy($path.$file, $path.$newdir.'\\'.$file);

	if ($copy) {
		unlink($path.$file);
	} else {
		echo "Ошибка при копировании $file<br>";
	}
}
