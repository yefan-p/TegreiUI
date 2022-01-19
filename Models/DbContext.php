<?php

namespace Models;

use PDO;
use Utils\AppSettings;

class DbContext
{
    private PDO $dbContext;

    function __construct()
    {
        $this->dbContext = new PDO(AppSettings::$ConnectionString, AppSettings::$UserName, AppSettings::$Password);
        $this->dbContext->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function GetCategories(): array
    {
        $sql = 'SELECT * FROM SoftCategories';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute();

        return $sqlState->fetchAll();
    }

    public function GetNonCategoriesPrograms(): array
    {
        $sql =
            'SELECT UnifyItems.Id, Name
            FROM SoftResults
            INNER JOIN UnifyItems ON UnifyItems.Id = SoftResults.UnifyItemId
            WHERE IsCategoryMapExists = 0 AND IsFileAlreadyExists = 0
            ORDER BY SoftResults.Created DESC';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute();

        return $sqlState->fetchAll();
    }

    public function GetUnifyItem(): array
    {
        $sql = 'SELECT * FROM UnifyItems WHERE Id=:Id';
        $sqlState = $this->dbContext->prepare($sql);
        if (isset($_GET['unifyId']))
            $sqlState->execute([':Id' => $_GET['unifyId']]);

        return $sqlState->fetchAll();
    }
}