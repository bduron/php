<?php
$passwd_file = '../htdocs/private/passwd'; // GOOD PATH ?

function is_existing_account($account, $login)
{
	foreach ($account as $check)
		if ($check['login'] === $login)
			return true;
	return false;
}

/******* Check _POST values ********/

if ($_POST['login'] == '' || $_POST['newpw'] == '' 
	|| $_POST['oldpw'] == '' || $_POST['submit'] !== 'OK')
{
	echo "ERROR\n";
	return (1);
}

/******* Check if oldpw == newpw ********/

if ($_POST['newpw'] == $_POST['oldpw'])
{
	echo "ERROR\n";
	return (1);
}


/******* Check if there is a passwd file ********/

if (file_exists($passwd_file) == false)
{
	echo "ERROR\n";
	return (1);
}


/******* Check if account exists ********/

$account = unserialize(file_get_contents($passwd_file));
if (is_existing_account($account, $_POST['login']) == false)
{
	echo "ERROR\n";
	return (1);
}


/******* Modify the account ********/

foreach ($account as &$user)
{
	if ($user['login'] === $_POST['login'])
		if (hash('whirlpool', $_POST['oldpw']) === $user['passwd'])
		{
			$user['passwd'] = hash('whirlpool', $_POST['newpw']);
			echo "OK\n";	
		}
		else
		{
			echo "ERROR\n";
			return (1);
		}
}

file_put_contents($passwd_file, serialize($account))
	or die("Can't write file\n");	

?>
