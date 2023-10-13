<?php

namespace Article;

include('includes/database.php');

class oArticle
{
    private $sTableName = 'articles';
    private $oConnection = null;

    public function __construct()
    {
        $oDB = new \Database\oDB();
        $this->oConnection = $oDB->oGetConnection();
    }

    /**
     * Get all articles
     * 
     * @return array
     */
    public function aGetArticles()
    {
        // $this->vStartConnection();
        $sQuery = 'SELECT * FROM ' . $this->sTableName;

        return $this->oConnection->query($sQuery)->fetchAll();
    }

    /**
     * Get an article by article number
     * 
     * @param string $sArticleNumber
     * 
     * @return object
     */
    public function oFindByArticleNumber(string $sArticleNumber)
    {
        $sQuery = 'SELECT * FROM ' . $this->sTableName . ' WHERE article_number = ?';
        $oQuery = $this->oConnection->prepare($sQuery);
        $oQuery->bindValue(1, $sArticleNumber, \PDO::PARAM_STR);

        if (!$oQuery->execute()) {
            return false;
        }
        return $oQuery->fetchObject();
    }

    /**
     * Get articles by term
     * 
     * @param string $sTerm
     * 
     * @return array
     */
    public function aGetArticlesByTerm(string $sTerm)
    {
        $sQuery = 'SELECT * FROM ' . $this->sTableName . ' WHERE article_name LIKE :sTerm OR article_number LIKE :sTerm';
        $oQuery = $this->oConnection->prepare($sQuery);
        $oQuery->bindValue(':sTerm', "%{$sTerm}%", \PDO::PARAM_STR);

        $bResult = $oQuery->execute();

        if ($bResult) {
            return $oQuery->fetchAll();
        }

        return [];
    }

    /**
     * Get article by id
     * 
     * @param int $iID
     * 
     * @return object
     */
    public function oGetArticleById(int $iID)
    {
        $sQuery = 'SELECT * FROM ' . $this->sTableName . ' WHERE id = ?';

        $oQuery = $this->oConnection->prepare($sQuery);
        $oQuery->bindValue(1, $iID, \PDO::PARAM_INT);

        $bResult = $oQuery->execute();

        if ($bResult) {
            return $oQuery->fetchObject();
        }

        return null;
    }

    /**
     * Add or update an article
     * 
     * @param array $aPostData
     * @param string $sType
     * 
     * @return bool
     */
    public function bAddOrUpdateArticle($aPostData, $sType = 'add')
    {

        if ($sType == 'add') {
            $sQuery = 'INSERT INTO ' . $this->sTableName . ' (article_name, article_number, article_price) VALUES (:article_name, :article_number, :article_price)';
        }
        else if ($sType == 'update') {
            $sQuery = 'UPDATE ' . $this->sTableName . ' SET article_name = :article_name, article_number = :article_number, article_price = :article_price WHERE id = :id';
        }

        try {
            $this->oConnection->beginTransaction();
            $oArticle = $this->oFindByArticleNumber($aPostData['article_number']);
            if ($oArticle && $oArticle->id != $aPostData['id']) {
                throw new \Exception('Artikel mit der Artikelnummer ' . $aPostData['article_number'] . ' existiert bereits.');
            }

            $oQuery = $this->oConnection->prepare($sQuery);
            $oQuery->bindValue(':article_name', $aPostData['article_name'], \PDO::PARAM_STR);
            $oQuery->bindValue(':article_number', $aPostData['article_number'], \PDO::PARAM_STR);
            $oQuery->bindValue(':article_price', $aPostData['article_price'], \PDO::PARAM_INT);

            if ($aPostData['id']) {
                $oQuery->bindValue(':id', $aPostData['id'], \PDO::PARAM_INT);
            }

            $bResult = $oQuery->execute();

            if (!$bResult) {
                throw new \Exception('Bei der Ausführung ist ein Fehler aufgetreten.');
            }
            $this->oConnection->commit();
        } catch (\Exception $oException) {
            $this->oConnection->rollBack();
            $_SESSION['sMessage'] = $oException->getMessage();

            return false;
        }

        return true;
    }

    /**
     * Delete an article
     * 
     * @param array $aPostData
     * 
     * @return bool
     */
    public function bDeleteArticle($aPostData)
    {

        $oArticle = $this->oGetArticleById($aPostData['id']);
        if ($oArticle && $oArticle->id != $aPostData['id']) {
            $_SESSION['sMessage'] = 'Artikel mit der ID ' . $aPostData['id'] . ' existiert nicht.';
            return false;
        }

        
        try {
            $sQuery = 'DELETE FROM ' . $this->sTableName . ' WHERE id = :id';
            $this->oConnection->beginTransaction();
            $oQuery = $this->oConnection->prepare($sQuery);
            $oQuery->bindValue(':id', $aPostData['id'], \PDO::PARAM_INT);

            $bResult = $oQuery->execute();

            if (!$bResult) {
                throw new \Exception('Bei der Ausführung ist ein Fehler aufgetreten.');
            }

            $this->oConnection->commit();
        } catch (\Exception $oException) {
            $this->oConnection->rollBack();
            $_SESSION['sMessage'] = $oException->getMessage();
            return false;
        }

        return true;
    }

    public function aGetArticleStatistics()
    {
        $sQuery = 'SELECT substr(convert(article_number, CHAR), 1, 2) AS article_number_range, Count(*) AS article_number_range_count FROM ' . $this->sTableName . ' GROUP BY substr(convert(article_number, CHAR), 1, 2)';

        return $this->oConnection->query($sQuery)->fetchAll();
    }
}

?>
