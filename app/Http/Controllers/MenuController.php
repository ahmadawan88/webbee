<?php


namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Routing\Controller as BaseController;

class MenuController extends BaseController
{

    public function getMenuItems() {
        // All Parent Menu Items
        $menuItems = MenuItem::with('children')->whereNull('parent_id')->get();
    
        // Get Childs of each Parent
        return $this->getChilds($menuItems);
    }
    
    protected function getChilds($parent) {
        return $parent->map(function ($menuItem) {
            $children = $this->getChilds($menuItem->children);
            $menuItem = $menuItem->toArray();
            $menuItem['children'] = $children;
            return $menuItem;
        });
    }
}
