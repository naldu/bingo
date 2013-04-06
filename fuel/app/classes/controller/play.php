<?php

use Model\User;
use Model\Card;
use Model\Cardrows;

class Controller_Play extends Controller
{
	public function action_index()
	{
	}

	public function action_test()
	{
		$test_rounds_played = 12;
		$test_range = range(1, Card::$_max);
		shuffle($test_range);
		$played_numbers = array_slice($test_range, 1, $test_rounds_played);
		$card_rows = Cardrows::find_all();
		foreach ($card_rows as $card_row) 
		{
			$card_row->score = 0;
			$card_row->save();
			$card_row_values = explode(",",$card_row->value);
			foreach ($card_row_values as $row_value) 
			{
				if(in_array($row_value, $played_numbers))
				{
					$card_row->score++;
					$card_row->save();
					if($card_row->score > 4)
					{
						$user = User::find_by_pk($card_row->user_id);
						echo "GEWONNEN:<br />";
						echo $user->name."<br />";
					}
				}
			
			}
		}

		print_r($played_numbers);
	}
}
