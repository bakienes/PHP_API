<?php 
class mHelper
{
	static function postVeriable($value)
	{
		if(isset($_POST[$value]))
		{
			return strip_tags($_POST[$value]);
		}
		else
		{
			return "";
		}
	}
	static function postIntegerVariable($value)
	{
		if(isset($_POST[$value]))
		{
			return intval($_POST[$value]);
		}
		else
		{
			return 0;
		}
	}
	static function getIntegerVariable($value)
	{
		if(isset($_GET[$value]))
		{
			return intval($_GET[$value]);
		}
		else
		{
			return 0;
		} 
	}
}
?>
