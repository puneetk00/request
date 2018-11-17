<?php
	
class Pkdeveloper_Medicine_Block_Adminhtml_Medicine_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "entity_id";
				$this->_blockGroup = "medicine";
				$this->_controller = "adminhtml_medicine";
				$this->_updateButton("save", "label", Mage::helper("medicine")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("medicine")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("medicine")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("medicine_data") && Mage::registry("medicine_data")->getId() ){

				    return Mage::helper("medicine")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("medicine_data")->getId()));

				} 
				else{

				     return Mage::helper("medicine")->__("Add Item");

				}
		}
}