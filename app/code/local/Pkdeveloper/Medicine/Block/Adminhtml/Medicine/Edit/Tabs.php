<?php
class Pkdeveloper_Medicine_Block_Adminhtml_Medicine_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("medicine_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("medicine")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("medicine")->__("Item Information"),
				"title" => Mage::helper("medicine")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("medicine/adminhtml_medicine_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
