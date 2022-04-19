<?
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");	

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("MyClass", "OnBeforeIBlockElementUpdateHandler"));

class MyClass
{
    function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
		$res = CIBlockElement::GetByID($arFields["ID"]);
		if($ar_res = $res->GetNext())
		AddMessage2Log(print_r([$arFields["ACTIVE"]], true));
			if($arFields["ACTIVE"] == 'N') 
			{
				if($ar_res["SHOW_COUNTER"] < 3)
				{
					
					global $APPLICATION;
					$APPLICATION->throwException("Нельзя деактивировать товар, кол-во простморов меньше 2-х !.(ID:".$arFields["ID"].")");
					return false;
				}
					else
				{
				 global $APPLICATION;
					$APPLICATION->throwException("Активация прошла успешно !. ".$arFields["SHOW_COUNTER"]  . " (ID:".$arFields["ID"].")");
					return true;	
				}
			}
		
    }
}
?>