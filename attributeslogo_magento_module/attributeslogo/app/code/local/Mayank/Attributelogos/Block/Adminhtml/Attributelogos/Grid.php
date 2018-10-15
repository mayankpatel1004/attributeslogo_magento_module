<?php

class Mayank_Attributelogos_Block_Adminhtml_Attributelogos_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('attributelogosGrid');
      $this->setDefaultSort('attributelogos_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('attributelogos/attributelogos')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('attributelogos_id', array(
          'header'    => Mage::helper('attributelogos')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'attributelogos_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('attributelogos')->__('Attribute Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));

		
	  $arrAttributes = Mage::getModel('attributelogos/attributelogos')->fnGetAttributesGridValues();
	  $this->addColumn('attribute_id', array(
          'header'    => Mage::helper('attributelogos')->__('Attributes Options'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'attribute_id',
          'type'      => 'options',
          'options'   => $arrAttributes,
      ));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('attributelogos')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      $this->addColumn('status', array(
          'header'    => Mage::helper('attributelogos')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('attributelogos')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('attributelogos')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('attributelogos')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('attributelogos')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attributelogos_id');
        $this->getMassactionBlock()->setFormFieldName('attributelogos');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('attributelogos')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('attributelogos')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('attributelogos/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('attributelogos')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('attributelogos')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}