<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Blog MVC</title>
    <!-- incluir a CDN do Bootstrap para estilos e componentes -->
</head>
<body>
<div class="container mt-4">
    <h1>Postagens Recentes</h1>
    <div class="row">
        <!-- Verifique se temos posts e liste-os -->
        <?php if (!empty($data['posts'])): ?>
            <?php foreach ($data['posts'] as $post): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h5>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                            <a href="/post/view/<?php echo $post['id']; ?>" class="btn btn-primary">Ler mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Não há postagens para mostrar.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts do Bootstrap -->
</body>
</html>
