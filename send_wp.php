
<?
// Вызываем функцию для перехвата данных
add_action( 'wpcf7_mail_sent', 'your_wpcf7_mail_sent_function' );
function your_wpcf7_mail_sent_function( $contact_form ) {
   $title = $contact_form->title;
   $posted_data = $contact_form->posted_data;
   //Вместо "Контактная форма 1" необходимо указать название Вашей контактной формы
   if ('Заказ в один клик из корзины' == $title ) {
   $submission = WPCF7_Submission::get_instance();
   $posted_data = $submission->get_posted_data();
   //далее мы перехватывает введенные данные в Contact Form 7[awooc-text][awooc-tel]
   //перехватываем поле [your-name]
   $firstName = $posted_data['awooc-text'];
   //перехватываем поле [your-message]
   //$message = $posted_data['awooc-email'];
	   $phone = $posted_data['awooc-tel'];
   //в данном примере рассмотрены два поля. Как перехватывать остальные поля
   //читайте ниже.
   }
	elseif ('Заказ звонка в шапке' == $title ) {
		   $submission = WPCF7_Submission::get_instance();
   $posted_data = $submission->get_posted_data();
		   $firstName = $posted_data['awooc-text'];
   //перехватываем поле [your-message]
   //$message = $posted_data['awooc-email'];
	   $phone = $posted_data['awooc-tel'];
	}

    
    // формируем URL в переменной $queryUrl
$queryUrl = 'https://c23423appin2ess.bitrix24.ru/rest/1/ycwicqcveftbnxr0/crm.lead.add.json';

// формируем параметры для создания лида в переменной $queryData'COMMENTS' => $message,
$queryData = http_build_query(array(
  'fields' => array(
    'TITLE' => "Обратный звонок СПБ",
	  'NAME' => $firstName,
	 'EMAIL' => Array(
	    "n0" => Array(
	        "VALUE" => $message,
	        "VALUE_TYPE" => "WORK",
	    ),
	),
	'PHONE' => Array(
	    "n0" => Array(
	        "VALUE" => $phone,
	        "VALUE_TYPE" => "WORK",
	    ),
	),
	   'ASSIGNED_BY_ID' => '19',
  ),
  'params' => array("REGISTER_SONET_EVENT" => "Y")
));

	
/*Подключаем новый файл js */
	add_action( 'wp_enqueue_scripts', 'my_scripts_method_new' );
function my_scripts_method_new(){
	wp_enqueue_script( 'newscriptnew', get_template_directory_uri() . '/js/custom_script.js');
}

// обращаемся к Битрикс24 при помощи функции curl_exec
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_POST => 1,
  CURLOPT_HEADER => 0,
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_URL => $queryUrl,
  CURLOPT_POSTFIELDS => $queryData,
));
$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result, 1);
if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
}
