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

    public function GetUnifyItem(string $id): UnifyItem
    {
        $sql = 'SELECT * FROM UnifyItems WHERE Id = :Id';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute([':Id' => $id]);

        $result = $sqlState->fetchAll();

        $item = new UnifyItem();
        $item->Id = $result[0]['Id'];
        $item->FullProgramName = $result[0]['Name'];
        $item->ShortProgramName = (string)preg_replace('/.\d.*/', '', $item->FullProgramName);
        $item->Description = $result[0]['Description'];

        return $item;
    }

    public function CheckExistsMap(string $map): array
    {
        $sql = 'SELECT * FROM SoftCategoryMaps WHERE Map LIKE  :Map + \'%\'';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute([':Map' => $map]);

        return $sqlState->fetchAll();
    }
}