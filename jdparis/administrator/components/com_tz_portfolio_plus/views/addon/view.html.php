<?php
/*------------------------------------------------------------------------

# TZ Portfolio Plus Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2015 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// No direct access
defined('_JEXEC') or die('Restricted access');

JLoader::register('TZ_Portfolio_PlusHelperAddon_Datas', COM_TZ_PORTFOLIO_PLUS_ADMIN_HELPERS_PATH
    .DIRECTORY_SEPARATOR.'addon_datas.php');

class TZ_Portfolio_PlusViewAddon extends JViewLegacy
{
    protected $item;
    protected $addonItem;
    protected $form;
    protected $state;
    protected $addonItems;
    protected $return_link;
    protected $itemsServer;
    protected $paginationServer;
    public    $filterForm;

    public function display($tpl = null)
    {
        $this->state                = $this->get('State');
        $this->item                 = $this->get('Item');
        $this -> return_link        = $this -> get('ReturnLink');
        $canDo	                    = TZ_Portfolio_PlusHelper::getActions(COM_TZ_PORTFOLIO_PLUS, 'addon', $this -> item -> id);
        $this -> canDo	= $canDo;

        if($this -> getLayout() == 'manager') {
            $this->addonItem = $this->get('AddonItem');
        }

        $this -> form       = $this -> get('form');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        if($this -> getLayout() == 'upload') {
            $this -> itemsServer       = $this -> get('ItemsFromServer');
            $this -> paginationServer   = $this -> get('PaginationFromServer');
            $this -> filterForm   = $this -> get('FilterForm');
			
            TZ_Portfolio_PlusHelper::addSubmenu('addons');
            $this->sidebar = JHtmlSidebar::render();
        }

        $this->addToolbar();

        parent::display($tpl); // TODO: Change the autogenerated stub
    }

    protected function addToolbar(){
        JFactory::getApplication()->input->set('hidemainmenu', true);

        $user		= JFactory::getUser();
        $userId		= $user->get('id');

        $canDo = JHelperContent::getActions('com_tz_portfolio_plus');
        $checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $userId);

        $text   = JText::_($this->item->name);

        if($this -> getLayout() == 'upload'){
            $text   = JText::_('COM_TZ_PORTFOLIO_PLUS_UPLOAD_AND_INSTALL_ADDON');
        }
        if($this -> getLayout() == 'manager'){
            $text   = JText::_($this->item->name).': Manager Data';
        }

        JToolBarHelper::title(JText::sprintf('COM_TZ_PORTFOLIO_PLUS_ADDONS_MANAGER_TASK',$text),'puzzle');

        if($this -> getLayout() == 'edit'){
            // If not checked out, can save the item.
            if (!$checkedOut) {
                if ($canDo->get('core.edit')) {
                    JToolBarHelper::apply('addon.apply');
                    JToolBarHelper::save('addon.save');
                }
            }
        }

        if($this -> getLayout() == 'edit' && $this -> item -> data_manager){
            JToolbarHelper::link(JRoute::_(TZ_Portfolio_PlusHelperAddon_Datas::getRootURL($this -> item -> id)),
                JText::_('COM_TZ_PORTFOLIO_PLUS_ADDON_DATA_MANAGER'),'book');
        }

        if($this -> getLayout() != 'manager') {
            JToolBarHelper::cancel('addon.cancel', JText::_('JTOOLBAR_CLOSE'));
        }else{
            JToolbarHelper::custom('addon.cancel','puzzle','', JText::_('COM_TZ_PORTFOLIO_PLUS_ADDONS_MANAGER'), false);
        }

        JToolBarHelper::help('JHELP_CONTENT_ARTICLE_MANAGER',false,
            'https://www.tzportfolio.com/document/add-ons/28-installation.html?tmpl=component');

        TZ_Portfolio_PlusToolbarHelper::customHelp('https://www.youtube.com/channel/UCrLN8LMXTyTahwDKzQ-YOqg/videos'
            ,'COM_TZ_PORTFOLIO_PLUS_VIDEO_TUTORIALS', 'youtube', 'youtube');
    }
}