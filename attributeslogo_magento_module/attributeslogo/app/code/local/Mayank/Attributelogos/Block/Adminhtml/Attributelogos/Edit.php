<?php

class Mayank_Attributelogos_Block_Adminhtml_Attributelogos_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'attributelogos';
        $this->_controller = 'adminhtml_attributelogos';
        
        $this->_updateButton('save', 'label', Mage::helper('attributelogos')->__('Save Logo'));
        $this->_updateButton('delete', 'label', Mage::helper('attributelogos')->__('Delete Logo'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('attributelogos_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'attributelogos_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'attributelogos_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
			
			
			Event.observe('attribute_id','change',function(){
				intAttributeId = this.value;
				strRequestUrl = '".$this->getUrl('attributelogos/index/options')."';
				strRequestUrl += '?attribute_id='+intAttributeId;
				new Ajax.Request(strRequestUrl, {
				  onSuccess: function(response) {
					strResponse = response.responseText;
					arrResponse = strResponse.split('#');	
					$('option_id').options.length = 0;				
					if(arrResponse.length > 0)
					{
						for(intR=0;intR<arrResponse.length;intR++)
						{
							strResponseValue = arrResponse[intR];
							arrResponseValue = strResponseValue.split('::');
							intOptionId = arrResponseValue[0];							
							strOptionLabel = arrResponseValue[1];							
							var Dropoption = new Option(strOptionLabel,intOptionId);							
							$('option_id').add(Dropoption);
						}
					}
				  }
				});
			});
			
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('attributelogos_data') && Mage::registry('attributelogos_data')->getId() ) {
            return Mage::helper('attributelogos')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('attributelogos_data')->getTitle()));
        } else {
            return Mage::helper('attributelogos')->__('Add Attribute Logo');
        }
    }
}