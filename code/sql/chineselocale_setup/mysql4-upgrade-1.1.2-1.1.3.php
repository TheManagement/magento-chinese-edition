<?php

$installer = new Mage_Catalog_Model_Resource_Setup('core_setup');
$installer->startSetup();
$catalog_product           = (int)$installer->getEntityTypeId('catalog_product');
$attributeIds       = array();
$select = $installer->getConnection()->select()
    ->from(
        array('ea' => $installer->getTable('eav/attribute')),
        array('entity_type_id', 'attribute_code', 'attribute_id'))
    ->where('ea.entity_type_id IN(?)', array($catalog_product));
foreach ($installer->getConnection()->fetchAll($select) as $row) {
    $attributeIds[$row['entity_type_id']][$row['attribute_code']] = $row['attribute_id'];
}
foreach($attributeIds as $attributeid){
    foreach($attributeid as $attribute_code=>$attribute_id){
        if($attribute_code=="group_price" ){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','�û���۸�')->save();
        }
        if($attribute_code=="tier_price" ){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','�㼶�۸�')->save();
        }
        if( $attribute_code=="thumbnail"){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','����ͼ')->save();
        }
        if( $attribute_code=="small_image" ){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','����ҳ��Ʒͼ')->save();
        }
        if( $attribute_code=="image"){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('frontend_label','��Ʒ����ͼ')->save();
        }
    
        if( $attribute_code=="options_container"){
            $attribute = Mage::getModel('eav/entity_attribute')->load($attribute_id);
            $attribute->setData('default_value','container1')->save();
        }
    }
}
$installer->endSetup();



$installer = new Mage_Customer_Model_Entity_Setup('core_setup');
$installer->startSetup();

$customer           = (int)$installer->getEntityTypeId('customer');
$customerAddress    = (int)$installer->getEntityTypeId('customer_address');
$attributeIds       = array();
$customerAttrIds       = array();
$select = $installer->getConnection()->select()
    ->from(
        array('ea' => $installer->getTable('eav/attribute')),
        array('entity_type_id', 'attribute_code', 'attribute_id'))
    ->where('ea.entity_type_id IN(?)', array($customer, $customerAddress));

foreach ($installer->getConnection()->fetchAll($select) as $row) {
    $attributeIds[$row['entity_type_id']][$row['attribute_code']] = $row['attribute_id'];
}
foreach($attributeIds as $attributeid){
    foreach($attributeid as $attribute_code=>$attribute_id){
        if($attribute_code=="firstname"){
            $customerAttrIds[]= $attribute_id;
        }
        if($attribute_code=="lastname"){
        
            $customerAttrIds[]= $attribute_id;
        }
    
    }
}
$customer_eav_attributeTable = $installer->getTable('customer_eav_attribute');
foreach($customerAttrIds as $_attribute_id){
    $installer->run("
        UPDATE `{$customer_eav_attributeTable}` SET
        `validate_rules`= Null
        WHERE `attribute_id`='{$_attribute_id}'
    ");
}







$directory_country_region = $installer->getTable('directory_country_region');
$directory_country_region_name = $installer->getTable('directory_country_region_name');

    $installer->run("

INSERT INTO `{$directory_country_region}` (`region_id`, `country_id`, `code`, `default_name`) VALUES
(378, 'CN', 'BJ', '����'),
(379, 'CN', 'SH', '�Ϻ�'),
(380, 'CN', 'GD', '�㶫'),
(381, 'CN', 'JS', '����'),
(382, 'CN', 'SD', 'ɽ��'),
(383, 'CN', 'SC', '�Ĵ�'),
(384, 'CN', 'TW', '̨��'),
(385, 'CN', 'ZJ', '�㽭'),
(386, 'CN', 'LN', '����'),
(387, 'CN', 'HN1', '����'),
(388, 'CN', 'HB', '����'),
(389, 'CN', 'FJ', '����'),
(390, 'CN', 'HB1', '�ӱ�'),
(391, 'CN', 'HN', '����'),
(392, 'CN', 'HK', '���'),
(393, 'CN', 'HLJ', '������'),
(394, 'CN', 'TJ', '���'),
(395, 'CN', 'CQ', '����'),
(396, 'CN', 'JX', '����'),
(397, 'CN', 'SX1', 'ɽ��'),
(398, 'CN', 'AH', '����'),
(399, 'CN', 'SX', '����'),
(400, 'CN', 'HN2', '����'),
(401, 'CN', 'YN', '����'),
(402, 'CN', 'GS', '����'),
(403, 'CN', 'NMG', '���ɹ�'),
(404, 'CN', 'GZ', '����'),
(405, 'CN', 'XJ', '�½�'),
(406, 'CN', 'XZ', '����'),
(407, 'CN', 'QH', '�ຣ'),
(408, 'CN', 'GX', '����'),
(409, 'CN', 'AM', '����'),
(410, 'CN', 'NX', '����'),
(411, 'CN', 'JL', '����');



INSERT INTO `{$directory_country_region_name}`  (`region_id`, `locale`, `name`) VALUES
(378, 'zh_CN', '����'),
(379, 'zh_CN', '�Ϻ�'),
(380, 'zh_CN', '�㶫'),
(381, 'zh_CN', '����'),
(382, 'zh_CN', 'ɽ��'),
(383, 'zh_CN', '�Ĵ�'),
(384, 'zh_CN', '̨��'),
(385, 'zh_CN', '�㽭'),
(386, 'zh_CN', '����'),
(387, 'zh_CN', '����'),
(388, 'zh_CN', '����'),
(389, 'zh_CN', '����'),
(390, 'zh_CN', '�ӱ�'),
(391, 'zh_CN', '����'),
(392, 'zh_CN', '���'),
(393, 'zh_CN', '������'),
(394, 'zh_CN', '���'),
(395, 'zh_CN', '����'),
(396, 'zh_CN', '����'),
(397, 'zh_CN', 'ɽ��'),
(398, 'zh_CN', '����'),
(399, 'zh_CN', '����'),
(400, 'zh_CN', '����'),
(401, 'zh_CN', '����'),
(402, 'zh_CN', '����'),
(403, 'zh_CN', '���ɹ�'),
(404, 'zh_CN', '����'),
(405, 'zh_CN', '�½�'),
(406, 'zh_CN', '����'),
(407, 'zh_CN', '�ຣ'),
(408, 'zh_CN', '����'),
(409, 'zh_CN', '����'),
(410, 'zh_CN', '����'),
(411, 'zh_CN', '����');
    ");












$installer->endSetup();