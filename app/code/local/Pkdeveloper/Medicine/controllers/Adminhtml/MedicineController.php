<?php

class Pkdeveloper_Medicine_Adminhtml_MedicineController extends Mage_Adminhtml_Controller_Action
{
		protected function _isAllowed()
		{
		//return Mage::getSingleton('admin/session')->isAllowed('medicine/medicine');
			return true;
		}

		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("medicine/medicine")->_addBreadcrumb(Mage::helper("adminhtml")->__("Medicine  Manager"),Mage::helper("adminhtml")->__("Medicine Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Medicine"));
			    $this->_title($this->__("Manager Medicine"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Medicine"));
				$this->_title($this->__("Medicine"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("medicine/medicine")->load($id);
				if ($model->getId()) {
					Mage::register("medicine_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("medicine/medicine");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Medicine Manager"), Mage::helper("adminhtml")->__("Medicine Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Medicine Description"), Mage::helper("adminhtml")->__("Medicine Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("medicine/adminhtml_medicine_edit"))->_addLeft($this->getLayout()->createBlock("medicine/adminhtml_medicine_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("medicine")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Medicine"));
		$this->_title($this->__("Medicine"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("medicine/medicine")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("medicine_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("medicine/medicine");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Medicine Manager"), Mage::helper("adminhtml")->__("Medicine Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Medicine Description"), Mage::helper("adminhtml")->__("Medicine Description"));


		$this->_addContent($this->getLayout()->createBlock("medicine/adminhtml_medicine_edit"))->_addLeft($this->getLayout()->createBlock("medicine/adminhtml_medicine_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("medicine/medicine")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Medicine was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setMedicineData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setMedicineData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("medicine/medicine");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('entity_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("medicine/medicine");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'medicine.csv';
			$grid       = $this->getLayout()->createBlock('medicine/adminhtml_medicine_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'medicine.xml';
			$grid       = $this->getLayout()->createBlock('medicine/adminhtml_medicine_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
