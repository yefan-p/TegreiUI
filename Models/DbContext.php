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
            'SELECT ui.Id, Name
             FROM SoftResults sr
             INNER JOIN UnifyItems ui ON ui.Id = sr.UnifyItemId
             WHERE IsCategoryMapExists = 0 
                AND IsFileAlreadyExists = 0
                AND ui.Id NOT IN (
                    SELECT srs.UnifyItemId
                    FROM SoftResults srs
                    WHERE srs.UnifyItemId = ui.Id AND IsCategoryMapExists = 1)
             ORDER BY sr.Created DESC';
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
        $sql = 'SELECT * FROM SoftCategoryMaps WHERE Map LIKE :Map + \'%\'';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute([':Map' => $map]);

        return $sqlState->fetchAll();
    }

    public function SaveNewMap(string $map): void
    {
        $sql = 'INSERT INTO SoftCategoryMaps (Map) VALUES (:Map)';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute([':Map' => $map]);
    }

    public function SaveNewCategory(int $mapId, int $categoryId): void
    {
        $sql =
            'INSERT INTO SoftCategorySoftCategoryMap (SoftCategoryId, SoftCategoryMapId)
            VALUES (:CategoryId, :MapId)';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute([':MapId' => $mapId, ':CategoryId' => $categoryId]);
    }

    public function MarkCategoryExists(string $map): void
    {
        $sql =
            'UPDATE SoftResults
            SET IsCategoryMapExists = 1
            WHERE IsCategoryMapExists = 0 
	        AND UnifyItemId IN 
		        (SELECT Id
		        FROM UnifyItems
		        WHERE Name LIKE :Map + \'%\')';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute([':Map' => $map]);
    }

    public function GetCategoryMapId(string $map): int
    {
        $sql = 'SELECT TOP 1 Id FROM SoftCategoryMaps WHERE Map LIKE :Map + \'%\'';
        $sqlState = $this->dbContext->prepare($sql);
        $sqlState->execute([':Map' => $map]);

        return $sqlState->fetchAll()[0]['Id'];
    }
}