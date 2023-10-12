<div class="col-12">
    <form class="row gy-3" action="crud.php" method="post">
        <input type="hidden" name="type" value="erstellen">
        <div class="col-12 col-md-4">
            <div class="form-floating">
                <input type="text"
                       class="form-control <?php echo !isset($_SESSION['aErrorFields']) ? '' : (in_array('article_name', $_SESSION['aErrorFields']) ? 'is-invalid' : 'is-valid') ?>"
                       name="article_name"
                       id="article_name"
                       placeholder="Name des Artikels*"
                       required
                       oninvalid="this.setCustomValidity('Bitte einen Artikelnamen eingeben')"
                       oninput="this.setCustomValidity('')"
                       value="<?php echo isset($_SESSION['aPostData']['article_name']) ? $_SESSION['aPostData']['article_name'] : '' ?>"
                >
                <label for="article_name">Name des Artikels*</label>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="form-floating">
                <input type="text"
                       class="form-control <?php echo !isset($_SESSION['aErrorFields']) ? '' : (in_array('article_number', $_SESSION['aErrorFields']) ? 'is-invalid' : 'is-valid') ?>"
                       name="article_number"
                       id="article_number"
                       placeholder="Artikelnummer*"
                       pattern="[0-9]*"
                       inputmode="numeric"
                       required
                       oninvalid="this.setCustomValidity('Bitte eine Artikelnummer eingeben.')"
                       oninput="this.setCustomValidity('')"
                       value="<?php echo isset($_SESSION['aPostData']['article_number']) ? $_SESSION['aPostData']['article_number'] : '' ?>"
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
                       class="form-control <?php echo !isset($_SESSION['aErrorFields']) ? '' : (in_array('article_price', $_SESSION['aErrorFields']) ? 'is-invalid' : 'is-valid') ?>"
                       name="article_price"
                       id="article_price"
                       placeholder="Preis*"
                       required
                       oninvalid="this.setCustomValidity('Bitte einen Preis eingeben.')"
                       oninput="this.setCustomValidity('')"
                       value="<?php echo isset($_SESSION['aPostData']['article_price']) ? $_SESSION['aPostData']['article_price'] : '' ?>"
                >
                <label for="floatingInput">Preis*</label>
                <div id="articleNumberHelp" class="form-text">Der Preis kann bis zu 2 Nachkommastellen haben.</div>
            </div>
        </div>
        <div class="col-12">
            <small>* Pflichtfeld</small>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Artikel erstellen</button>
        </div>
    </form>
</div>