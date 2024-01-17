<!-- modules/User/views/register.php -->
<?php if (!empty($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<form action="/register_post" method="post">
    <input type="text" name="username" placeholder="Nome de usuário" required>
    <input type="password" name="password" placeholder="Senha" required>
    <input type="password" name="password_confirm" placeholder="Confirme a senha" required>
    <button type="submit">Registrar</button>
</form>
