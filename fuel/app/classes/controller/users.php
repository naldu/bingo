<?php

use Model\User;
use Model\Card;
use Model\Cardrows;

class Controller_Users extends Controller
{
	public function action_index()
	{
		return Response::forge(View::forge('welcome/index'));
	}

	public function action_create_test_users()
	{
		for($i=0; $i<500; $i++){
			$user = User::forge(array(
			    'name' => 'John'.$i
			));
			//$user->save();
			//Card::generate($user->id, 1);
			//Card::save();
			//print_r(Card());
		}
	}
}
