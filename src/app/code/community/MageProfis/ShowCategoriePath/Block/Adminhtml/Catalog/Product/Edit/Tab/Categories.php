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
     * get All Parent Categorie Ids
     * 
     * @return array
     */
    protected function _getSelectedCategoriesPathIds()
    {
        if (is_null($this->_categoriePathes))
        {
            $categoryIds = $this->getCategoryIds();
            if (empty($categoryIds)) {
                $this->_categoriePathes = array();
                return $this->_categoriePathes;
            }
            $collection = Mage::getResourceModel('catalog/category_collection');
            $collection->addFieldToSelect(array('path'))
                    ->addFieldToFilter('entity_id', array('in' => $categoryIds));

            $ids = array();
            foreach ($collection as $item) {
                $_ids = $item->getPathIds();
                // remove the first and the last one from array
                array_shift($_ids);
                array_pop($_ids);
                $ids = array_merge($ids, $_ids);
            }
            $ids = array_unique($ids);
            $this->_categoriePathes = $ids;
        }
        return $this->_categoriePathes;
    }
}
