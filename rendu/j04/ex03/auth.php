<?php
function auth($login, $passwd)
{
	$passwd_file = '../htdocs/private/passwd';
	$accounts = unserialize(file_get_contents($passwd_file));

	foreach ($accounts as $account)
		if ($account['login'] === $login 
			&& hash('whirlpool', $passwd) === $account['passwd'])
			return (true);	
	return (false);
}
?>
