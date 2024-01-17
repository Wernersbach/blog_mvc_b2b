<!-- modules/User/views/index.php -->
<?php if (!empty($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<!-- modules/User/views/login.php -->
<form action="/login_post" method="post">
    <input type="text" name="username" placeholder="Nome de usuário" required>
    <input type="password" name="password" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>
