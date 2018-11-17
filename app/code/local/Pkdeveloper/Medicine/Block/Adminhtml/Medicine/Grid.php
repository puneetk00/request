<?php

class Pkdeveloper_Medicine_Block_Adminhtml_Medicine_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("medicineGrid");
				$this->setDefaultSort("entity_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("medicine/medicine")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("entity_id", array(
				"header" => Mage::helper("medicine")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "entity_id",
				));
                
				$this->addColumn("name", array(
				"header" => Mage::helper("medicine")->__("Name"),
				"index" => "name",
				));
				$this->addColumn("email", array(
				"header" => Mage::helper("medicine")->__("E mail"),
				"index" => "email",
				));
				$this->addColumn("phone", array(
				"header" => Mage::helper("medicine")->__("Phone Number"),
				"index" => "phone",
				));
					$this->addColumn('create_at', array(
						'header'    => Mage::helper('medicine')->__('Date'),
						'index'     => 'create_at',
						'type'      => 'datetime',
					));
						$this->addColumn('status', array(
						'header' => Mage::helper('medicine')->__('Status'),
						'index' => 'status',
						'type' => 'options',
						'options'=>Pkdeveloper_Medicine_Block_Adminhtml_Medicine_Grid::getOptionArray5(),				
						));
						
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('entity_id');
			$this->getMassactionBlock()->setFormFieldName('entity_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_medicine', array(
					 'label'=> Mage::helper('medicine')->__('Remove Medicine'),
					 'url'  => $this->getUrl('*/adminhtml_medicine/massRemove'),
					 'confirm' => Mage::helper('medicine')->__('Are you sure?')
				));
			return $this;
		}
			
		static public function getOptionArray5()
		{
            $data_array=array(); 
			$data_array[0]='No';
			$data_array[1]='Yes';
            return($data_array);
		}
		static public function getValueArray5()
		{
            $data_array=array();
			foreach(Pkdeveloper_Medicine_Block_Adminhtml_Medicine_Grid::getOptionArray5() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}