<?php

namespace Controllers;

use Models\DbContext;
use Models\UnifyItem;

class SelectCategoryController
{
    private array $categories;
    private array $nonCategoriesProgram;
    private array $existsMaps;
    private UnifyItem $unifyItem;

    public function __construct()
    {
        $db = new DbContext();
        $this->unifyItem = new UnifyItem();
        $this->categories = $db->GetCategories();
        $this->nonCategoriesProgram = $db->GetNonCategoriesPrograms();

        if (isset($_GET['unifyId']))
        {
            $this->unifyItem = $db->GetUnifyItem($_GET['unifyId']);
            $this->existsMaps = $db->CheckExistsMap($this->unifyItem->ShortProgramName);
        }
    }

    public function GetCategories(): array
    {
        return $this->categories;
    }

    public function GetNonCategoriesProgram(): array
    {
        return $this->nonCategoriesProgram;
    }

    public function GetExistsMaps(): array
    {
        return $this->existsMaps;
    }

    public function GetFullName(): string
    {
        return $this->unifyItem->FullProgramName;
    }

    public function GetShortName(): string
    {
        return $this->unifyItem->ShortProgramName;
    }

    public function GetDescription(): string
    {
        return $this->unifyItem->Description;
    }

    public function IsMapAlreadyExists(): bool
    {
        return !empty($this->existsMaps);
    }
}