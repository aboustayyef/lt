<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test</title>
</head>
<body>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript">

		$tweets = $.getJSON('http://localhost:8000/ajax/get/2/15', function(data){
			var jsondata = $.parseJSON(data);
			$.each(jsondata, function(index){
				console.log(jsondata[index]);
			});
			
		});


	</script>


</body>
</html>