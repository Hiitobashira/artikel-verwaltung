<?php
session_start();

unset($_SESSION['aPostData']);
unset($_SESSION['sMessage']);
unset($_SESSION['aErrorFields']);

$aPostData = $_POST;

if (!isset($aPostData['type'])) {
    $_SESSION['sMessage'] = 'Es ist ein Fehler aufgetreten.';
    return header('Location: /');
}

include_once('includes/articles.php');

$sType = $aPostData['type'];
unset($aPostData['type']);
$aErrorFields = false;
[$aPostData, $aErrorFields] = sanitizePostData($aPostData);

if (count($aErrorFields)) {
    $_SESSION['aErrorFields'] = $aErrorFields;
    $_SESSION['aPostData'] = $aPostData;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

switch ($sType) {
    case 'erstellen':
        $oArticle = new \Article\oArticle();

        $bSucceed = $oArticle->bAddOrUpdateArticle($aPostData, 'add');
        break;
    case 'bearbeiten':
        $oArticle = new \Article\oArticle();

        $bSucceed = $oArticle->bAddOrUpdateArticle($aPostData, 'update');
        break;
    case 'loeschen':
        $oArticle = new \Article\oArticle();

        $bSucceed = $oArticle->bDeleteArticle($aPostData);
        break;
    case 'uebersicht':
    default:
        exit('Übersicht');
}

if (!$bSucceed) {
    $_SESSION['aPostData'] = $_POST;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

header('Location: /');
exit;

/**
 * Sanitize post data
 * 
 * @param array $aPostData
 * 
 * @return array
 */
function sanitizePostData($aPostData)
{
    $aErrorFields = [];

    foreach ($aPostData as $sFieldName => &$vEntry) {
        $vEntry = trim($vEntry);
        $vEntry = strip_tags($vEntry);
        $vEntry = htmlspecialchars($vEntry);
        if (!$vEntry) {
            $aErrorFields []= $sFieldName;
        }
    }

    return [
        $aPostData,
        $aErrorFields
    ];
}
