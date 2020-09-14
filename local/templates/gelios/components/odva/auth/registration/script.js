var regBitrix =
{
	disableErrors:function(init)
	{
		$(init).siblings(".l-input__sub-text").css("display","none");
		$(init).siblings(".l-input__sub-text").html("Это поле объязательно!");
	},
	validate:function(init)
	{
		let errors = 0;
		$(init).find(".popup-registr__input input").each((index,element)=>
		{
			if($(element).val() == "")
			{
				errors++;
				$(element).siblings(".l-input__sub-text").css("display","block");
				$(element).siblings(".l-input__sub-text").html("Это поле объязательно!");
			}
		});
		if(errors > 0)
			return errors != 0;
		let mail = $(".popup-registr__input-email input");
		let pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
		if($(mail).val().search(pattern) != 0)
		{
			$(mail).siblings(".l-input__sub-text").css("display","block");
			$(mail).siblings(".l-input__sub-text").html("Введите верную почту");
			errors++;
		}
		if(errors > 0)
			return errors != 0;
		let inputsPassword = $(".popup-registr__input-pasword input");
		if($(inputsPassword).eq(0).val().length < 6)
		{
			$(inputsPassword).eq(0).siblings(".l-input__sub-text").css("display","block");
			$(inputsPassword).eq(0).siblings(".l-input__sub-text").html("Пароль должен быть больше 6 символов!");
			errors++;
		}
		if(errors > 0)
			return errors != 0;
		if($(inputsPassword).eq(0).val() != $(inputsPassword).eq(1).val())
		{
			$(inputsPassword).each((index,element)=>
				{
					$(element).siblings(".l-input__sub-text").css("display","block");
					$(element).siblings(".l-input__sub-text").html("Пароли должны совпадать!");
				}
			)
			errors++;
		}
		return errors != 0;
	},
	resgistration:function(e,init)
	{
		e.preventDefault();
		if(this.validate(init))
		{
			return;
		};
		$.ajax({
			type:'POST',
			url: $(init).attr("action"), // адрес, на который будет отправлен запрос
			dataType: "json",
			data:$(init).serialize(),
			success: function(data)
			{
				if(data.success == true)
				{
					window.location.reload(true);
				}
				else
				{
					alert(data.msg);
				}
			}
		});
	}
}