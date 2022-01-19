<?php

namespace Controllers;

use Models\DbContext;

class SelectCategoryController
{
    private DbContext $db;

    private array $categories;
    private array $nonCategoriesProgram;
    private array $unifyItem;

    private string $fullProgramName;
    private string $shortProgramName;
    private string $description;

    public function __construct()
    {
        $this->db = new DbContext();

        $this->categories = $this->db->GetCategories();
        $this->nonCategoriesProgram = $this->db->GetNonCategoriesPrograms();
        $this->unifyItem = $this->db->GetUnifyItem();

        if ((isset($this->unifyItem[0]['Name'])))
        {
            $this->fullProgramName = $this->unifyItem[0]['Name'];
            $this->shortProgramName = (string)preg_replace('/.\d.*/', '', $this->fullProgramName);
        }
        else
        {
            $this->fullProgramName = '';
            $this->shortProgramName = '';
        }

        if (isset($this->unifyItem[0]['Description']))
        {
            $this->description = $this->unifyItem[0]['Description'];
        }
        else
        {
            $this->description = '';
        }
    }

    public function GetCategories() : array
    {
        return $this->categories;
    }

    public function GetNonCategoriesProgram() : array
    {
        return $this->nonCategoriesProgram;
    }

    public function GetFullName() : string
    {
        return $this->fullProgramName;
    }

    public function GetShortName() : string
    {
        return $this->shortProgramName;
    }

    public function GetDescription() : string
    {
        return $this->description;
    }
}