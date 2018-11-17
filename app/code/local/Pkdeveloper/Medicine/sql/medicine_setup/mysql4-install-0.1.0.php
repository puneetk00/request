<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table query_medicine_entity(entity_id int not null auto_increment, name varchar(100),email varchar(100),phone varchar(100),create_at stamptime,status boolean, primary key(entity_id));
create table query_medicine_entity_item(entity_id int not null auto_increment, m_name varchar(100),qty int,create_at stamptime,availibility varchar(255), note varchar(255), primary key(entity_id));		
SQLTEXT;

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 