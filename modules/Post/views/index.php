<?php echo "Handersen"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Listagem de Posts</title>
</head>
<body>
<h1>Posts</h1>
<?php /** @var Array $data */
foreach($data['posts'] as $post): ?>
    <article>
        <h2><?php echo $post['title']; ?></h2>
        <p><?php echo $post['body']; ?></p>
    </article>
<?php endforeach; ?>
</body>
</html>
