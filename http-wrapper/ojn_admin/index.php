<?php
if(!file_exists("include/common.php"))
	header('Location: install.php');
require_once "include/common.php";

if(isset($_GET['logout'])) {
	unset($_SESSION['bunny']);
	unset($_SESSION['bunny_name']);
	unset($_SESSION['ztamp']);
	unset($_SESSION['ztamp_name']);
	unset($_SESSION['login']);
	$ojnAPI->SetToken('');
	unset($_SESSION['token']);
	header("Location: index.php");
}
if(!empty($_POST['login']) && !empty($_POST['password'])) {
	$r = $ojnAPI->loginAccount($_POST['login'], $_POST['password']);
	if(!strpos($r,"AD_")) {
		$_SESSION['login'] = $_POST['login'];
		$ojnAPI->setToken($r);
	} else {
		$_SESSION['message']['error'] = "Bad authentification.";
	}
	session_write_close();
	header("Location: index.php");
}
?>
<?php
if(isset($_SESSION['message']) && empty($_GET)) {
	if(isset($_SESSION['message']['ok'])) { ?>
	<div class="ok_msg">
	<?php	echo $_SESSION['message']['ok'];
	} else { ?>
	<div class="error_msg">
	<?php	echo $_SESSION['message']['error'];
	}
	if(empty($_GET))
		unset($_SESSION['message']);
	echo "</div>";
}
?>
<div class="three_cols">
      <h1 id="accueil">Home</h1>
      <p><?php echo _("Bienvenue sur la page de configuration de votre nabaztag sur openJabNab. Vous avez la possibilit&eacute;
         d'activer ou de d&eacute;sactiver certains plugins, afin que votre lapin r&eacute;ponde pleinement
	 &agrave; vos besoins. De plus, il est possible de planifier l'ex&eacute;cution de t&acirc;ches r&eacute;currentes.") ?></p>
</div>

<div class="three_cols">
<?php
if(isset($_SESSION['token'])) {
?>
<h1><?php echo _('D&eacute;connexion') ?></h1>
<?php  echo _('Cliquez sur le lien suivant pour vous d&eacute;connecter : <a href="index.php?logout">D&eacute;connexion') ?></a>
<?php
} else {
?>
      <h1 id="tutorial"><?php echo _('Connexion') ?></h1>
      <form method="post">
	<dl>
	<dt><?php echo _('Login') ?></dt>
	<dd><input type="text" name="login"></dd>
	<dt><?php echo _('Mot de passe') ?></dt>
	<dd><input type="password" name="password"></dd>
	</dl>
	<input type="submit" value="<?php  echo _('Se connecter') ?>">
	</form>
<?php
}
?>
</div>

<div class="three_cols">
      <h1 id="tutorial"><?php  echo _('New account') ?></h1>
<p><?php  echo _("Si vous voulez utiliser votre lapin, mais que vous n'avez pas de compte utilisateur, vous pouvez en cr&eacute;er un en cliquant sur le lien suivant :") ?> <a href="register.php"><?php  echo _("Cr&eacute;er un compte utilisateur") ?></a>.</p>
</div>
<?php
require_once("include/append.php");
?>
