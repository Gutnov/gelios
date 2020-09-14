var profilePassword =
{
	validate:function(init)
	{
		let errors = 0;
		$(init).find(".account-security__form-item input").each((indx,element)=>
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
	},
	chenge:function(e,init)
	{
		e.preventDefault();
		if(this.validate(init))
		{
			return;
		};
		$.ajax({
			type:'POST',
			url: $(data).attr("action"), // адрес, на который будет отправлен запрос
         	dataType: "json",
         	data:$(data).serialize(),
			success: function(data)
			{
				if(data.success == 'OK')
				{
					alert("Пароль успешно изменен");
				}
				else
				{
					alert(data.msg);
				}
			}
		});
	}
}