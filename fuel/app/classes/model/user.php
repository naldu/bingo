<?php

namespace Model;

class User extends \Model_Crud
{
	protected static $_table_name = 'users';
	protected static $_has_many = array('card_rows');
}

