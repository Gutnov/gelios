var authLineMobile = {
	logout:function(e,init)
	{
		e.preventDefault();
		$.ajax({
			type:'POST',
			url: $(init).data("url-ajax"), // адрес, на который будет отправлен запрос
			dataType: "json",
			success: function(data)
			{
				if(data.success == true)
				{
					alert("Вы разлогинились");
					window.location.reload(true);
				}
				else
				{
					alert("Вы не разлогинились");
				}
			}
		});
	}
}