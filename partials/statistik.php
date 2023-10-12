<?php
    include_once('includes/articles.php');

    // Instantiate the Article class and get all available articles
    $oArticle = new \Article\oArticle();
    $aArticles = $oArticle->aGetArticleStatistics();
?>

<?php if (count($aArticles)) : ?>
    <div class="col-12">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>Nummern-Bereich</th>
                    <th>Anzahl Artikel</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aArticles as $aSingleArticle) : ?>
                    <tr>
                        <td>
                            <?php echo $aSingleArticle['article_number_range'] ?>
                        </td>
                        <td>
                            <?php echo $aSingleArticle['article_number_range_count'] ?>
                        </td>
                        <td>
                            <a href="?type=suche&begriff=<?php echo $aSingleArticle['article_number_range'] ?>" class="btn btn-outline-primary">Alle Artikel ansehen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="echarts" data-echarts='<?php echo json_encode($aArticles) ?>'></div>
    </div>
<?php else : ?>
    <div class="col-12 col-md-6 mx-auto text-center">
        <div class="alert alert-danger">
            Es gibt noch keine Artikel, daher gibt es auch keine Statistik.
        </div>
    </div>
<?php endif; ?>