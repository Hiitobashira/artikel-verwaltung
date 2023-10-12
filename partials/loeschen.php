<?php
include_once('includes/articles.php');

// Instantiate the Article class and get all available articles
$oArticle = new \Article\oArticle();
$oArticle = $oArticle->oGetArticleById($_GET['id']);

if (!$oArticle) {
    $_SESSION['sMessage'] = 'Artikel wurde nicht gefunden.';
    header('Location: /');
    exit;
}
?>

<div class="col-12 col-md-6">
    <p><strong>Name des Artikels:</strong> <?php echo $oArticle->article_name; ?></p>
    <p><strong>Artikelnummer:</strong> <?php echo $oArticle->article_number; ?></p>
    <p><strong>Preis:</strong> <?php echo $oArticle->article_price; ?></p>
</div>

<div class="alert alert-danger">
    <p>Bist du dir sicher, dass du diesen Artikel l&ouml;schen möchtest? Die L&ouml;schung ist endg&uuml;ltig!</p>
    <form action="crud.php" method="post" class="d-inline-block">
        <input type="hidden" name="type" value="loeschen">
        <input type="hidden" name="id" value="<?php echo $oArticle->id; ?>">
        <button type="submit" class="btn btn-danger">Artikel l&ouml;schen</button>
    </form>
    <a href="javascript:history.back();" class="btn btn-primary">Abbrechen</a>
</div>