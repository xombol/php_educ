		// ------------ сортировка таблиц ------------ 
		
		/* Новое не удалять !!!!!!!!!!!!! */
		
		$('#select-history-orders').removeClass('select');
		$('#select-active-orders').addClass('select');

		$('body').on('click', '.sort_btn', function () {
			$('.sort_btn').removeClass('sorted');
			var val = $(this).closest('th').attr('data-name');
			var tabl_n = '#active-orders .room-order__row';
			var date_ss;
			

			
			var col_need = 0;
			if (val == 'order_number') {
				col_need = '.order-number';
				column = 1
			} else if (val == 'client_number') {
				col_need = 'td:nth-child(2)';
				column = 2
			} else if (val == 'date_plan') {
				col_need = '.order-date';
				date_ss = 1;
				column = 3
			} else if (val == 'date_fact') {
				col_need = '.order-date';
				console.log($(col_need)); 
				column = 4
			} else {
				return false;
			}
			
			if ($('#select-history-orders').hasClass('select')) {
				tabl_n = '#history-orders tbody tr';
				col_need = '.order-number';
				console.info('ВЫбрана история ');
			}
			else {
				console.info('НЕ ВЫбрана история ');
			}
			

			$(this).addClass('sorted');
			//$(this).addClass('load');

			if ($(this).hasClass('down')) {
				$('.sort_btn').removeClass('up');
				$('.sort_btn').removeClass('down');
				sort(col_need, tabl_n, date_ss);
				//direction = 'asc'; //по-возрастанию

				$('th').each(function () {
					if ($(this).attr('data-name') == val) {
						$(this).find('.sort_btn').removeClass('down');
						$(this).find('.sort_btn').addClass('up');
					}
				});
			} else if ($(this).hasClass('up')) {
				$('.sort_btn').removeClass('up');
				$('.sort_btn').removeClass('down');
					sort2(col_need, tabl_n, date_ss);
				//direction = 'desc'; //по-убыванию

				$('th').each(function () {
					if ($(this).attr('data-name') == val) {
						$(this).find('.sort_btn').removeClass('up');
						$(this).find('.sort_btn').addClass('down');
					}
				});
			} else {
				$('.sort_btn').removeClass('up');
				$('.sort_btn').removeClass('down');
				sort(col_need, tabl_n, date_ss);
				//direction = 'asc'; //по-возрастанию

				$('th').each(function () {
					if ($(this).attr('data-name') == val) {
						$(this).find('.sort_btn').addClass('up');
					}
				});
			}
			
			
			
			  //this calculates values automatically 
			  var n = '.order-number';
				  $( ".sort_new" ).click(function(){ // задаем функцию при нажатиии на элемент <button>
				  console.log(n);
					 sort_cl(n);
				  });
				  $( ".sort_new2" ).click(function(){ // задаем функцию при нажатиии на элемент <button>
				  console.log(n);
					 sort2_cl(n);
				  });

			

			function sort(x, y, z) {
				
			  var nodeList = document.querySelectorAll(y);
			  console.log(nodeList);
			  var itemsArray = [];
			  var parent = nodeList[0].parentNode;
			  for (var i = 0; i < nodeList.length; i++) {    
				itemsArray.push(parent.removeChild(nodeList[i]));
			  }
			  itemsArray.sort(function(nodeA, nodeB) { 
				  var textA = nodeA.querySelector(x).textContent;
				  var textB = nodeB.querySelector(x).textContent;
				  
				  if (z == '1'){
		
						var numberA = new Date(textA);
						var numberB = new Date(textB);
				  }else {
					var numberA = parseInt(textA);
				  var numberB = parseInt(textB);
				  }
				  

				  if (numberA < numberB) return -1;
				  if (numberA > numberB) return 1;
				  return 0;
				})
				.forEach(function(node) {
				  parent.appendChild(node)
				});
			}

			function sort2(x, y, z) {
			  var nodeList = document.querySelectorAll(y);
			  console.log(nodeList);
			  var itemsArray = [];
			  var parent = nodeList[0].parentNode;
			  for (var i = 0; i < nodeList.length; i++) {    
				itemsArray.push(parent.removeChild(nodeList[i]));
			  }
			  itemsArray.sort(function(nodeA, nodeB) {
				  var textA = nodeA.querySelector(x).textContent;
				  var textB = nodeB.querySelector(x).textContent;
				  console.info('1');
				    if (z == '1'){
		
						var numberA = new Date(textB);
						var numberB = new Date(textA);
				  }else {
				  
				  var numberA = parseInt(textB);
				  var numberB = parseInt(textA);
				  }
				  
				  if (numberA < numberB) return -1;
				  if (numberA > numberB) return 1;
				  return 0;
				})
				.forEach(function(node) {
				  parent.appendChild(node)
				});
			}
