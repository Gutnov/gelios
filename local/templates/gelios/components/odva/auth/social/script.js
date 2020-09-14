function auth_with_social(token)
{
	$.ajax({
		type:'POST',
		url: $(".social-auth-block").data("url-file"), // адрес, на который будет отправлен запрос
		dataType: "json",
		data:{"token":token},
		success: function(data)
		{
			if(data.success == true)
			{
				window.location.reload(true);
				return false;
			}
			else
			{
				alert(data.msg);
				return false;
			}
		}
	});
}

var authSocial =
{
	authVk:function(e)
	{
		e.preventDefault();
		$(".ulogin-button-vkontakte").click();
	},
	authFb:function(e)
	{
		e.preventDefault();
		$(".ulogin-button-facebook").click();
	}
}