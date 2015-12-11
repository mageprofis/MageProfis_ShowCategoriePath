<?php

class MageProfis_ShowCategoriePath_Block_Adminhtml_Catalog_Product_Edit_Tab_Categories
extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Categories
{

    protected $_categoriePathes = null;

    /**
     * Returns array with configuration of current node
     *
     * @param Varien_Data_Tree_Node $node
     * @param int                   $level How deep is the node in the tree
     * @return array
     */
    protected function _getNodeJson($node, $level = 1)
    {
        $item = parent::_getNodeJson($node, $level);
        if (!isset($item['expanded']) && isset($item['id']))
        {
            if(in_array($item['id'], $this->_getSelectedCategoriesPathIds()))
            {
                $item['expanded'] = true;
            }
        }
        return $item;
    }

    /**
     * just run this model one time
     * @see getSelectedCategoriesPathIds
     * 
     * @return array
     */
    protected function _getSelectedCategoriesPathIds()
    {
        if (is_null($this->_categoriePathes))
        {
            $this->_categoriePathes = $this->getSelectedCategoriesPathIds();
        }
        return $this->_categoriePathes;
    }
}