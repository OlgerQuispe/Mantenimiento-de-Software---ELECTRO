<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: /php-login-copia');
  exit;
}

require 'database.php';

$message = '';

if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
  if ($_POST['new_password'] === $_POST['confirm_password']) {
    // Hash the new password
    $hashed_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Update the password in the database
    $update_stmt = $conn->prepare('UPDATE usuarios SET password = :password WHERE id = :id');
    $update_stmt->bindParam(':password', $hashed_password);
    $update_stmt->bindParam(':id', $_SESSION['user_id']);
    if ($update_stmt->execute()) {
      $message = 'Contraseña actualizada correctamente';
    } else {
      $message = 'Hubo un problema al actualizar la contraseña';
    }
  } else {
    $message = 'Las contraseñas no coinciden';
  }
}

?>

<!-- HTML para mostrar el formulario y el mensaje -->

<!DOCTYPE html>
	<html lang="es">
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cambio de contraseña</title>
	</head>
	<body>
	<h1>Cambio de contraseña</h1>
	<?php if (!empty($message)) : ?>
		<p><?php echo $message; ?></p>
	<?php endif; ?>
	<form action="" method="post">
		<label for="new_password">Nueva contraseña:</label><br>
		<input type="password" id="new_password" name="new_password" required><br>
		<label for="confirm_password">Confirmar contraseña:</label><br>
		<input type="password" id="confirm_password" name="confirm_password" required><br>
		<button type="submit">Cambiar contraseña</button>
	</form>
	</body>
</html>
