<?php
    include_once('includes/articles.php');

    // Instantiate the Article class and get all available articles
    $oArticle = new \Article\oArticle();
    $aArticles = $oArticle->aGetArticles();
?>

<?php if (count($aArticles)) : ?>
    <div class="col-12">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Name des Artikels</th>
                    <th>Artikelnummer</th>
                    <th>Preis</th>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="col-12 col-md-6 mx-auto text-center">
        <div class="alert alert-danger">
            Es wurden noch keine Artikel hinzugef&uuml;gt.
        </div>
    </div>
<?php endif; ?>