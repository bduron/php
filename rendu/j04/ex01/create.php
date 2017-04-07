<?php
$passwd_file = 'private/passwd';


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
	if (1) //// CHECK SI LE COMPTE EXISTE DEJA
	{
		$account[] = ['login' => $_POST['login'], 'passwd' => hash('sha256' ,$_POST['passwd'])]; 
		file_put_contents($passwd_file, serialize($account))
			or die("Can't write file\n");	
	}	
}
else 
{
	if (!file_exists('private')) 
		mkdir('private') or die("Can't create folder\n");	// quelles permissions ?
	$account[] = ['login' => $_POST['login'], 'passwd' => hash('sha512' ,$_POST['passwd'])]; 
	file_put_contents($passwd_file, serialize($account))
		or die("Can't write file\n");	
}
	
print_r($account);

?>
