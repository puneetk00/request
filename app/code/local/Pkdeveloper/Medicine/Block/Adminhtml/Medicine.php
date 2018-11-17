<?php


class Pkdeveloper_Medicine_Block_Adminhtml_Medicine extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_medicine";
	$this->_blockGroup = "medicine";
	$this->_headerText = Mage::helper("medicine")->__("Medicine Manager");
	$this->_addButtonLabel = Mage::helper("medicine")->__("Add New Item");
	parent::__construct();
	
	}

}