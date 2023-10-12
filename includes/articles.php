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
     * @param int $iArticleNumber
     * 
     * @return object
     */
    public function oFindByArticleNumber($iArticleNumber)
    {
        $sQuery = 'SELECT * FROM ' . $this->sTableName . ' WHERE article_number = ' . $iArticleNumber;
        $oArticle = $this->oConnection->query($sQuery)->fetchObject();
        if (!$oArticle) {
            return false;
        }
        return $oArticle;
    }

    /**
     * Get articles by term
     * 
     * @param string $sTerm
     * 
     * @return array
     */
    public function aGetArticlesByTerm($sTerm)
    {
        $sQuery = 'SELECT * FROM ' . $this->sTableName . ' WHERE article_name LIKE "%' . $sTerm . '%" OR article_number LIKE "%' . $sTerm . '%"';

        return $this->oConnection->query($sQuery)->fetchAll();
    }

    /**
     * Get article by id
     * 
     * @param int $iID
     * 
     * @return object
     */
    public function oGetArticleById($iID)
    {
        $sQuery = 'SELECT * FROM ' . $this->sTableName . ' WHERE id = ' . $iID;

        return $this->oConnection->query($sQuery)->fetchObject();
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
            $this->oConnection->prepare($sQuery)->execute($aPostData);
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
        $sQuery = 'DELETE FROM ' . $this->sTableName . ' WHERE id = ' . $aPostData['id'];
        
        try {
            $this->oConnection->beginTransaction();
            $this->oConnection->query($sQuery)->execute();
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