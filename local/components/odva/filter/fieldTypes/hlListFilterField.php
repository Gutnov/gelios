<?php

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

class hlListFilterField extends FilterField
{
	public $value = [];

	public function getValues()
	{
		$props = [];

		$property = CIBlockProperty::GetList(
			[],
			[
				'IBLOCK_ID' => $this->settings['IBLOCK_ID'],
				'CODE'      => $this->settings['propName']
			]
		)->Fetch();

		if(!$property || empty($property['USER_TYPE_SETTINGS']['TABLE_NAME']))
			return $props;

		$entityDataClass = $this->getEntityDataClass($property['USER_TYPE_SETTINGS']['TABLE_NAME']);

		$data = $entityDataClass::getList([
			'select' => ['*']
		]);

		while($item = $data->Fetch())
		{
			$item['SELECTED']   = in_array($item['UF_XML_ID'], $this->value);
			$item['FIELD_NAME'] = $this->settings['propName'];
			$props[]            = $item;
		}

		return $props;
	}

	public function getFilter()
	{
		if(count($this->value) < 1) return [];
		return ["PROPERTY_{$this->settings['propName']}" => $this->value];
	}

	public function setValue($value)
	{
		if(!empty($value))
			$this->value = explode('-',$value);
	}

	private function getEntityDataClass($hlBlockTableName)
	{
		$hlblock = HLBT::getList(['filter'=>array('TABLE_NAME' => $hlBlockTableName)])->fetch();
		if(!$hlblock)
			return false;

		$entity = HLBT::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();
		return $entity_data_class;
	}
}
