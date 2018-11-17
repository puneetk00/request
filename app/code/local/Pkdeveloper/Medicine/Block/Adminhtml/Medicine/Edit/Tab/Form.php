<?php
class Pkdeveloper_Medicine_Block_Adminhtml_Medicine_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("medicine_form", array("legend"=>Mage::helper("medicine")->__("Item information")));

				
						$fieldset->addField("name", "text", array(
						"label" => Mage::helper("medicine")->__("Name"),
						"name" => "name",
						));
					
						$fieldset->addField("email", "text", array(
						"label" => Mage::helper("medicine")->__("E mail"),
						"name" => "email",
						));
					
						$fieldset->addField("phone", "text", array(
						"label" => Mage::helper("medicine")->__("Phone Number"),
						"name" => "phone",
						));
					
						$dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(
							Mage_Core_Model_Locale::FORMAT_TYPE_SHORT
						);

						$fieldset->addField('create_at', 'date', array(
						'label'        => Mage::helper('medicine')->__('Date'),
						'name'         => 'create_at',
						'time' => true,
						'image'        => $this->getSkinUrl('images/grid-cal.gif'),
						'format'       => $dateFormatIso
						));				
						 $fieldset->addField('status', 'select', array(
						'label'     => Mage::helper('medicine')->__('Status'),
						'values'   => Pkdeveloper_Medicine_Block_Adminhtml_Medicine_Grid::getValueArray5(),
						'name' => 'status',
						));

				if (Mage::getSingleton("adminhtml/session")->getMedicineData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getMedicineData());
					Mage::getSingleton("adminhtml/session")->setMedicineData(null);
				} 
				elseif(Mage::registry("medicine_data")) {
				    $form->setValues(Mage::registry("medicine_data")->getData());
				}
				return parent::_prepareForm();
		}
}
