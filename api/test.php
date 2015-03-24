	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ru">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="content-language" content="ru">
		<script src="jquery-1.11.0.min.js" type="text/javascript"></script>

	</head>
  
	<body>
		<input type="button" value="Request" id="but"/>
		<script type="text/javascript">
		
		/*$('#but').click(function(){
			    $.ajax({
					type: "POST",
					url: "/api/v1/auth/login",
					data: "username=admin@megainfo.com.ua&password=megainfocomuaz",
					success: function(data) {
						
					},
					error:  function(xhr, str){
						alert("Возникла ошибка!");
					}
				});
		});*/
		
		/*$('#but').click(function(){
			    $.ajax({
					type: "POST",
					url: "/api/v1/category",
					data: {"parent_id":"0","name":"Услугиёёёёёёё","title":"","short_desc":"<p>Помимо разработки и продажи роботов различных конфигураций, наша компания предоставляет также полный спектр услуг связанных с работоспособностью роботов. Со всем списком Вы можете ознакомиться ниже.<\/p>","url":"usluhi","keywords":"","description":""},
					success: function(data) {
						//var j = JSON.stringify(data);
						//alert (j);
					},
					error:  function(xhr, str){
						
					}
				});
		});*/
		
		/*$('#but').click(function(){
			    $.ajax({
					type: "GET",
					url: "/api/v1/category/",
					data: "username=admin@megainfo.com.ua&password=megainfocomua",
					success: function(data) {
						//var j = JSON.stringify(data);
						//alert (j);
					},
					error:  function(xhr, str){
						
					}
				});
		});*/
		
		$('#but').click(function(){
			    $.ajax({
					type: "DELETE",
					url: "/api/v1/category/87",
					data: "username=admin@megainfo.com.ua&password=megainfocomua",
					success: function(data) {
						
					},
					error:  function(xhr, str){
						alert("Возникла ошибка!");
					}
				});
		});
		
		/*$('#but').click(function(){
			    $.ajax({
					type: "PUT",
					url: "/api/v1/category/56",
					data: {"parent_id":"0","name":"Человеко роботы","title":"ыаыаыаыа","short_desc":"<p>вфывфывфывфывфыв</p>","url":"cheloveko_roboty","keywords":"афафыа","description":"КЕША ВИТАЛИЙ СЕРЕЖА", "username":"admin@megainfo.com.ua", "password" : "megainfocomua"},
					success: function(data) {
						
					},
					error:  function(xhr, str){
						alert("Возникла ошибка!");
					}
				});
		});*/	 
		/*$('#but').click(function(){
			    $.ajax({
					type: "GET",
					url: "/api/v1/page/category/55",

					success: function(data) {
						//var j = JSON.stringify(data);
						//alert (j);
					},
					error:  function(xhr, str){
						
					}
				});
		});*/
		/*$('#but').click(function(){
			    $.ajax({
					type: "GET",
					url: "/api/v1/page/64",

					success: function(data) {
						//var j = JSON.stringify(data);
						//alert (j);
					},
					error:  function(xhr, str){
						
					}
				});
		});*/
		
		/*$('#but').click(function(){
			    $.ajax({
					type: "POST",
					url: "/api/v1/page",
					data: {"title":"Человеко роботыЫЫЫЫЫЫЫ","meta_title":"ЫЫХХЫХЫХЫЫХХЫХХЫХЫХЫЫХЫХЫ","url":"cheloveko_roboty","keywords":"какая-то абракадабра","description":"Вам надоели ваши друзья и подруги? Вас достало ваше окружение? Закажите человеко робота у нас, и вы получите все, чего вам не хватало от надоедливых людей! Человеко роботы работают по законам, которые укажите вы. Они схожи с людьми, но в тоже время облада","prev_text":"<p><img style=\"float: left; margin-right: 10px; margin-top:2px\" src=\"\/uploads\/images\/cheloveko-roboty.jpg\" alt=\"\" width=\"190\" height=\"143\" \/>Вам надоели ваши друзья и подруги? Вас достало ваше окружение? Закажите человеко робота у нас, и вы получите все, чего вам не хватало от надоедливых людей!<\/p>\r\n<p>Человеко роботы работают&nbsp; по законам, которые укажите вы. Они схожи с людьми, но в тоже время обладают механизмом управления \nи подчинения вашим приказам.<\/p>\r\n<p>Наши новые человеко роботы обладают инновационными разговорными функциями. Они могут оказывать полноценную психологическую поддержку, вести беседу обо всем, быть хорошими советчиками и пунктами необходимых&nbsp; знаний!<\/p>\r\n<p>Любого человеко робота можно взять в кредит и вернуть, если он вас не устроит.<\/p>","full_text":"","category":"0"},
					success: function(data) {
						//var j = JSON.stringify(data);
						//alert (j);
					},
					error:  function(xhr, str){
						
					}
				});
		});*/
		
		/*$('#but').click(function(){
				$.ajax({
					type: "GET",
					url: "/api/v1/page/64",
					data: {"title":"Человеко роботы ты-тыры пы-пыры","meta_title":"ЗВЕРСКИЙ ТИТЛЕ","url":"cheloveko_roboty","keywords":"какая-то абракадабра","description":"скачать онлайн бесплатно без регистрации и смс HD720p 58K 31D","prev_text":"<p><img style=\"float: left; margin-right: 10px; margin-top:2px\" src=\"\/uploads\/images\/cheloveko-roboty.jpg\" alt=\"\" width=\"190\" height=\"143\" \/>Вам надоели ваши друзья и подруги? Вас достало ваше окружение? Закажите человеко робота у нас, и вы получите все, чего вам не хватало от надоедливых людей!<\/p>\r\n<p>Человеко роботы работают&nbsp; по законам, которые укажите вы. Они схожи с людьми, но в тоже время обладают механизмом управления \nи подчинения вашим приказам.<\/p>\r\n<p>Наши новые человеко роботы обладают инновационными разговорными функциями. Они могут оказывать полноценную психологическую поддержку, вести беседу обо всем, быть хорошими советчиками и пунктами необходимых&nbsp; знаний!<\/p>\r\n<p>Любого человеко робота можно взять в кредит и вернуть, если он вас не устроит.<\/p>","full_text":"","category":"55"},
					success: function(data) {
						//var j = JSON.stringify(data);
						//alert (j);
					},
					error:  function(xhr, str){
						
					}
				});
		});*/
		/*$('#but').click(function(){
			    $.ajax({
					type: "GET",
					url: "/api/v1/page/64",
					data: {"username":"admin@megainfo.com.ua","password":"megainfocomua"},
					success: function(data) {
						//var j = JSON.stringify(data);
						//alert (j);
					},
					error:  function(xhr, str){
						
					}
				});
		});*/
		</script>
	</body>
	</html>

