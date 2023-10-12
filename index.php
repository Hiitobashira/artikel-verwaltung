<?php

session_start();

include_once('includes/page.php');

$aPageData = \Page\oPage::aGetPageData();
?>

<!doctype html>
<html lang="de">
<?php include('partials/head.php'); ?>

<body>

    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (!isset($_GET['type']) || $_GET['type'] == 'uebersicht' ? 'active' : '') ?>" aria-current="page" href="?type=uebersicht">&Uuml;bersicht</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['type']) && $_GET['type'] == 'erstellen' ? 'active' : '') ?>" aria-current="page" href="?type=erstellen">Artikel erstellen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (isset($_GET['type']) && $_GET['type'] == 'statistik' ? 'active' : '') ?>" aria-current="page" href="?type=statistik">Statistik anzeigen</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" method="get" action="?type=search">
                        <div class="input-group">
                            <input type="hidden" name="type" value="suche">
                            <input class="form-control" minlength="2" autocomplete="off" name="begriff" type="search" value="<?php echo isset($_GET['begriff']) ? $_GET['begriff'] : '' ?>" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">Suchen</button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-5">
        <div class="container">
            <div class="row gy-5">
                <div class="col-12 text-center">
                    <h1>Artikelverwaltung: <?php echo $aPageData['sTitle'] ?></h1>
                </div>

                <?php if (isset($_SESSION['sMessage'])) : ?>
                    <div class="col-12 col-md-6 mx-auto text-center">
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['sMessage']; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php include('partials/' . $aPageData['sType'] . '.php') ?>
            </div>
        </div>
    </main>

    <?php
    unset($_SESSION['sMessage']);
    unset($_SESSION['aPostData']);
    unset($_SESSION['aErrorFields']);
    ?>

    <footer>

    </footer>

    <!-- <script src="/resources/js/bootstrap.bundle.min.js"></script>
    <script src="/resources/js/main.js"></script> -->
</body>

</html>