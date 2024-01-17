<!DOCTYPE html>
<html>
<head>
    <title>Página Admin</title>
</head>
<body>
<h1>Admin</h1>

<!-- Lista de usuários -->
<h2>Usuários</h2>
<ul>
    <?php foreach ($data['users'] as $user): ?>
        <li><?php echo htmlspecialchars($user['username']); ?></li>
    <?php endforeach; ?>
</ul>

<!-- Lista de posts -->
<h2>Posts</h2>
<ul>
    <?php foreach ($data['posts'] as $post): ?>
        <li><?php echo htmlspecialchars($post['title']); ?></li>
    <?php endforeach; ?>
</ul>

<!-- Botão de backup do banco de dados -->
<form action="/admin/backup" method="post">
    <button type="submit">Backup do Banco de Dados</button>
</form>
</body>
</html>
