<? 
define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");

/* файл /bitrix/php_interface/init.php
	* регистрируем обработчик
	* Наша группа номер - 8 (Контент-менеджер)
	* можно как переменную представить $group_content = '8'; и заменит ниже
	* проверял с помощью " AddMessage2Log(print_r([$arFields["GROUP_ID"]], true)); "
*/

AddEventHandler("main", "OnBeforeUserUpdate", Array("EvenAddUserINGroup", "OnBeforeUserUpdateHandler"));

class EvenAddUserINGroup
{
    // создаем обработчик события "OnBeforeUserUpdate"
    function OnBeforeUserUpdateHandler(&$arFields)
    {
			/* Используем вызов всех доступных этому пользовтелю групп (те в которых он состоит ) */
			$arGroups = CUser::GetUserGroup($arFields["ID"]);
                   	
               
			  if(in_array('8' , $arGroups)){
				/* Пользователь есть в этой группе по этому и пропускаем  */
			  } 
				else 
			  {
				 foreach ($arFields["GROUP_ID"] as $key => $new_gr ){
					if(($new_gr["GROUP_ID"]) == '8'){
						/* 
						  * https://dev.1c-bitrix.ru/api_help/main/reference/cevent/send.php
						  * Вызво почтового шаблона 
						  * Так же моно передать ID добавленного пользователя 
						  * $arFields["ID"]
						*/
						
					}
				}
				  
			  }
		
    }
	
	
}

?>
