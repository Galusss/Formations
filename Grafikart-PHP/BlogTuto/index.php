<?php 
require 'vendor/autoload.php';
require_once 'class/Post.php';
$pdo = new PDO('sqlite:data.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
$error = null;
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' =>time()
        ]);
        header('Location: edit.php?id=' . $pdo->lastInsertId());
    }
    $query = $pdo->query('SELECT * FROM posts');
    /** @var Post[] */
    $posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');
} catch (PDOException $e) {
    $error = $e->getMessage();
}
require 'elements/header.php' ?>

<div class="container mt-4">
    <?php if ($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php else: ?>    
        
            <?php foreach ($posts as $post): ?>
               
            <h2><a href="edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name)  ?></a></h2>
            <p class="small text-muted">Ecrit le <?= $post->created_at->format('d/m/Y H:i'); ?></p>
            <p>
                <?= $post->getBody() ?>
            </p>
            <?php endforeach ?>
    

        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" value="" placeholder="Entre un nom d'article">
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" value="" placeholder="Entre votre contenu d'article"></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Sauvegarder</button>
        </form>
    <?php endif ?>
</div>

<?php require 'elements/footer.php'; ?>