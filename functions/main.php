<?php 

// Функціі загального призначення

/**
 * Добавление $_GET-переменной к url.
 */
function addGetParam (string $url, string $paramName, string $paramValue) {
	$getParams = []; $tempArr = []; $newUrl = WWW ."/". StrQuery;

	if (($pos = strpos($url, "?")) !== false) {
		$tempArr = explode("?", $url);
		$baseUrl = $tempArr[0];
	}
	else {
		$baseUrl = $url;
	}

	$tempGetParams = [];

	if ($tempArr !== []) {
		$tempGetParams = explode("&", $tempArr[1]);

		for ($i = 0; $i < count($tempGetParams); $i++) {
			$temp = explode("=", $tempGetParams[$i]);
			$getParams[$temp[0]] = $temp[1];
		}
	}

	$getParams[$paramName] = $paramValue;

	$i = 0;
	foreach ($getParams as $key => $value) {
		if ($i === 0) {
			if ($key === $paramName) {
				$newUrl .= "?". $paramName ."=". $paramValue;
			}
			else {
				$newUrl .= "?". $key ."=". $value;
			}
		}
		else {
			if ($key === $paramName) {
				$newUrl .= "&". $paramName ."=". $paramValue;
			}
			else {
				$newUrl .= "&". $key ."=". $value;
			}
		}
		$i++;
	}

	return $newUrl;
}