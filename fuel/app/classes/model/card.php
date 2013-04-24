<?php

namespace Model;

use Model\Cardrows;

abstract class Card
{

	protected static $_user_id = 0;
	protected static $_round = 1;

	public static $_rows = 5;
	public static $_max = 48;

	public static $horizontal = array();
	public static $vertical = array();
	public static $diagonal = array();

	public static function generate($user_id, $round = 1) 
	{
		static::$_user_id = $user_id;
		static::$_round = $round;
		$_total = static::$_rows * static::$_rows;
		$_range = range(1, static::$_max);
		shuffle($_range);
		$_unique = array_slice($_range, 1, static::$_max);
		$_index = 0;
		for($column = 0; $column < static::$_rows; $column++) 
		{
			for($row = 0; $row < static::$_rows; $row++) 
			{
				$number = $_unique[$_index];
				static::$horizontal[$column][$row] = $number;
				static::$vertical[$row][$column] = $number;
				if($row == $column) 
				{
					static::$diagonal[0][$column] = $number;				
				}
				if($row+$column == static::$_rows-1)
				{
					static::$diagonal[1][$column] = $number;									
				}
				$_index++;
			}
		}
	}

	public static function save() {
		$card_rows = array(
			'horizontal' => static::$horizontal,
			'vertical' => static::$vertical,
			'diagonal' => static::$diagonal,
		);
		foreach ($card_rows as $row => $values) {
			foreach ($values as $key => $value) {
				$card_row = Cardrows::forge(array(
					'user_id' => static::$_user_id,
					'round' => static::$_round,
					'row' => $row,
					'row_number' => $key+1,
					'value' => implode(",", $value),
				));
				$card_row->save();
			}
		}
	}
}
