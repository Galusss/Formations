<?php 
$pdo = new PDO('sqlite:data.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
$error = null;
$success = null;
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('UPDATE posts SET name = :name, content = :content WHERE id = :id');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ]);
        $success = 'Votre article a bien été modifier';
    }
    $query = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);
    $post = $query->fetch();
} catch (PDOException $e) {
    $error = $e->getMessage();
}
require 'elements/header.php' ?>

<div class="container mt-4">

    <p><a href="index.php">Revenir au listing</a></p>

    <?php if($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif ?>
    <?php if ($error): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php else: ?>    

    <form action="" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="<?= htmlentities($post->name) ?>">
        </div>
        <div class="form-group">
            <textarea name="content" class="form-control" value=""><?= htmlentities($post->content); ?></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Sauvegarder</button>
    </form>
    <?php endif ?>
</div>


<?php require 'elements/footer.php'; ?>