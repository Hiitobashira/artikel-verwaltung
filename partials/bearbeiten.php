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

<div class="col-12">
    <form class="row gy-3" action="crud.php" method="post">
        <input type="hidden" name="type" value="bearbeiten">
        <input type="hidden" name="id" value="<?php echo $oArticle->id ?>">
        <div class="col-12 col-md-4">
            <div class="form-floating">
                <input type="text"
                       class="form-control"
                       name="article_name"
                       id="article_name"
                       placeholder="Name des Artikels*"
                       required
                       oninvalid="this.setCustomValidity('Bitte einen Artikelnamen eingeben')"
                       oninput="this.setCustomValidity('')"
                       value="<?php echo $oArticle->article_name ?>"
                >
                <label for="article_name">Name des Artikels*</label>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-floating">
                <input type="text"
                       class="form-control"
                       title="test"
                       name="article_number"
                       id="article_number"
                       placeholder="Artikelnummer*"
                       pattern="[0-9]*"
                       inputmode="numeric"
                       required
                       oninvalid="this.setCustomValidity('Bitte eine Artikelnummer eingeben.')"
                       oninput="this.setCustomValidity('')"
                       value="<?php echo $oArticle->article_number ?>"
                >
                <label for="article_number">Artikelnummer*</label>
                <div id="articleNumberHelp" class="form-text">Die Artikelnummer darf maximal 15 Stellen lang sein.</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-floating">
                <input type="number"
                       min="0.00"
                       step="0.01"
                       class="form-control"
                       name="article_price"
                       id="article_price"
                       placeholder="Preis*"
                       required
                       oninvalid="this.setCustomValidity('Bitte einen Preis eingeben.')"
                       oninput="this.setCustomValidity('')"
                       value="<?php echo $oArticle->article_price ?>"
                >
                <label for="floatingInput">Preis*</label>
                <div id="articleNumberHelp" class="form-text">Der Preis kann bis zu 2 Nachkommastellen haben.</div>
            </div>
        </div>
        <div class="col-12">
            <small>* Pflichtfeld</small>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Artikel aktualisieren</button>
            <a href="javascript:history.back();" class="btn btn-outline-primary">Abbrechen</a>
        </div>
    </form>
</div>