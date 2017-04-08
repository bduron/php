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

if ($_POST['login'] == '' || $_POST['passwd'] == '' || $_POST['submit'] !== 'OK')
{
	echo "ERROR\n";
	return (1);
}

/******* Save the new account ********/

if (file_exists($passwd_file))
{
	$account = unserialize(file_get_contents($passwd_file));
	if (is_existing_account($account, $_POST['login']) == false)
	{
		$account[] = ['login' => $_POST['login'], 'passwd' => hash('whirlpool' ,$_POST['passwd'])]; 
		file_put_contents($passwd_file, serialize($account))
			or die("Can't write file\n");	
		echo "OK\n";	
	}
	else
		echo "ERROR\n";	
}
else 
{
	if (!file_exists('../htdocs/private')) 
		mkdir('../htdocs/private') or die("Can't create folder\n");	// quelles permissions ?
	$account[] = ['login' => $_POST['login'], 'passwd' => hash('whirlpool' ,$_POST['passwd'])]; 
	file_put_contents($passwd_file, serialize($account))
		or die("Can't write file\n");	
	echo "OK\n";	
}
?>
