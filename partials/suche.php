<?php
include_once('includes/articles.php');

$sBegriff = strip_tags($_GET['begriff']);

// Instantiate the Article class and get all available articles
$oArticle = new \Article\oArticle();
$aArticles = $oArticle->aGetArticlesByTerm($sBegriff);
?>

<?php if (count($aArticles)) : ?>
    <div class="col-12">
        <div class="text-primary text-center mb-5">
            Zu dem Begriff <strong>"<?php echo $sBegriff ?>"</strong> wurden <?php echo count($aArticles) ?> Ergebnis(se) gefunden.
        </div>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Name des Artikels</th>
                    <th>Artikelnummer</th>
                    <th>Preis</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aArticles as $aSingleArticle) : ?>
                    <tr>
                        <td>
                            <?php echo $aSingleArticle['article_name'] ?>
                        </td>
                        <td>
                            <?php echo $aSingleArticle['article_number'] ?>
                        </td>
                        <td>
                            <?php echo $aSingleArticle['article_price'] ?> &euro;
                        </td>
                        <td>
                            <a href="?type=bearbeiten&id=<?php echo $aSingleArticle['id'] ?>" class="btn btn-outline-primary">Artikel bearbeiten</a>
                            <a href="?type=loeschen&id=<?php echo $aSingleArticle['id'] ?>" class="btn btn-outline-danger">Artikel löschen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="col-12 col-md-6 mx-auto text-center">
        <div class="text-danger">
            Die Suche nach dem Begriff <strong>"<?php echo $sBegriff ?>"</strong> liefert keine Ergebnisse. Bitte versuchen Sie es mit einem anderen Begriff.
        </div>
    </div>
<?php endif; ?>
