<?php
// Проверяет наличие ключа в массиве, при успехе возвращает ключ
function getArrVal($array, $key)
{
	if (is_array($array)) {
		if (array_key_exists($key, $array)) {
			return $array[$key];
		} else {
			return '';
		}
	} else {
		return '';
	}
}

// Проверяет наличие ключа в массиве, при успехе возвращает checked
function getChecked($array, $key)
{
	if (is_array($array)) {
		if (array_key_exists($key, $array)) {
			return "checked";
		} else {
			return '';
		}
	} else {
		return '';
	}
}

function checkMail($email) // функция, проверяющая реальность email адреса
{
	if (preg_match("/^[_\.0-9a-z-]+@([0-9a-z][-0-9a-z\.]+)\.([a-z]{2,3}$)/", $email)) return true;
	return false;
}

// проверка коректности phone регуляркой
function checkPhone($phone)
{
	$pattern = '/((\+)?\b(8|38)?(0[\d]{2}))([\d-]{5,8})([\d]{2})/ius';
	if (preg_match($pattern, $phone)) {
		return true;
	} else {
		return false;
	}
}
