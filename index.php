<?php

// inisialisasi variabel
$pswd = "";
$code = "";
$error = "";
$valid = true;

// jika formulir dikirimkan
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// mendeklarasikan fungsi enkripsi dan dekripsi
	require_once('vigenere.php');
	
	// set the variables
	$pswd = $_POST['pswd'];
	$code = $_POST['code'];
	
	// periksa apakah kata sandi disediakan
	if (empty($_POST['pswd']))
	{
		$error = "Please enter a password!";
		$valid = false;
	}
	
	// periksa apakah teks disediakan
	else if (empty($_POST['code']))
	{
		$error = "Please enter some text or code to encrypt or decrypt!";
		$valid = false;
	}
	
	// periksa apakah kata sandi alfanumerik
	else if (isset($_POST['pswd']))
	{
		if (!ctype_alpha($_POST['pswd']))
		{
			$error = "Password should contain only alphabetical characters!";
			$valid = false;
		}
	}
	
	// masukan valid
	if ($valid)
	{
		// jika tombol enkripsi diklik
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($pswd, $code);
			$error = "Text encrypted successfully!";
			$color = "#526F35";
		}
			
		// jika tombol dekripsi diklik
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($pswd, $code);
			$error = "Code decrypted successfully!";
			$color = "#526F35";
		}
	}
}

?>

<html>
	<head>
		<title>Rifqi Achmad Fadhilla - Vigenere Cipher</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="Script.js"></script>
	</head>
	<body>
		<br><br><br>
		<form action="index.php" method="post">
			<table cellpadding="5" align="center" cellpadding="2" border="7">
				<caption><hr><b>Vigenere Cipher</b><hr></caption>
				<tr>
					<td align="center">Key: <input type="text" name="pswd" id="pass" value="<?php echo htmlspecialchars($pswd); ?>" /></td>
				</tr>
				<tr>
					<td align="center"><textarea id="box" name="code"><?php echo htmlspecialchars($code); ?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" name="encrypt" class="button" value="Encode" onclick="validate(1)" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="decrypt" class="button" value="Decode" onclick="validate(2)" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>