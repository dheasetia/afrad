<?php namespace App\Classes;

class Abaharabic
{

	public function __construct()
	{
		require('Arabic.php');
		var_dump('Abaharabic class initializing');
	}

	public function customize()
	{
		var_dump('Trying Abaharabic custom class');
	}
}