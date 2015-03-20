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
		
		$('#but').click(function(){
			    $.ajax({
					type: "GET",
					url: "/api/v1/greeting/answerme",
					success: function(data) {
						
					},
					error:  function(xhr, str){
						alert("Возникла ошибка!");
					}
				});
		});
		</script>
	</body>
	</html>

