<?php

namespace Controllers;

use Models\DbContext;

class SaveCategoryController
{
    private array $existsMaps;

    public function __construct()
    {
        $db = new DbContext();

        if (isset($_POST['newMap']))
        {
            $newMap = $_POST['newMap'];
            $this->existsMaps = $db->CheckExistsMap($newMap);

            if (empty($this->existsMaps))
            {
                $db->SaveNewMap($newMap);
                $selectedCategories = $_POST;
                unset($selectedCategories['newMap']);

                $mapId = $db->GetCategoryMapId($newMap);
                foreach ($selectedCategories as $key => $item)
                {
                    $db->SaveNewCategory($mapId, $key);
                }
                $db->MarkCategoryExists($newMap);
            }
        }
    }

    public function IsMapExists(): bool
    {
        return !empty($this->existsMaps);
    }

    public function GetExistsMaps(): array
    {
        return $this->existsMaps;
    }
}