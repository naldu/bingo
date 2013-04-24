<?php

use Model\User;
use Model\Card;
use Model\Cardrows;

class Controller_Play extends Controller
{

	public function action_index()
	{	
		$this->data['users'] = User::find_all(100);
		foreach($this->data['users'] as $_user){
			$_user->horizontal = Cardrows::find_by(array('user_id' => $_user->id, 'row' => 'horizontal'));
			$_user->vertical = Cardrows::find_by(array('user_id' => $_user->id, 'row' => 'vertical'));
			$_user->diagonal1 = Cardrows::find_by(array('user_id' => $_user->id, 'row' => 'diagonal', 'row_number' => 1));
			$_user->diagonal2 = Cardrows::find_by(array('user_id' => $_user->id, 'row' => 'diagonal', 'row_number' => 2));
		}
		//print_r($this->data['users']);
		View::set_global($this->data);
		return Response::forge(View::forge('admin/dashboard'));
	}

	public function action_test()
	{
		$test_rounds_played = 18;
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
