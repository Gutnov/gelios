var authBitrix =
{
	inputMail:null,
	disableErrors:function(init)
	{
		$(init).siblings(".l-input__sub-text").css("display","none");
		$(init).siblings(".l-input__sub-text").html("Это поле объязательно!");
	},
	validate:function(init)
	{
		let errors = 0;
		$(init).find(".popup-auth__input input").each((indx,element)=>
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
		this.inputMail = $(".popup-auth__input-email input");
		let pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
		if($(this.inputMail).val().search(pattern) != 0)
		{
			$(this.inputMail).siblings(".l-input__sub-text").css("display","block");
			$(this.inputMail).siblings(".l-input__sub-text").html("Введите верную почту");
			errors++;
		}
		if(errors > 0)
			return errors != 0;
		return errors != 0;
	},
	authorization:function(e,init)
	{
		e.preventDefault();
		if(this.validate(init))
		{
			return;
		};
		$.ajax(
		{
			type:'POST',
			url: $(init).attr("action"),//адрес, на который будет отправлен запрос
			dataType: "json",
			data:$(init).serialize(),
			success: (data)=>
			{
				if(data.success == true)
				{
					window.location.reload(true);
				}
				else
				{
					$(this.inputMail).siblings(".l-input__sub-text").css("display","block");
					$(this.inputMail).siblings(".l-input__sub-text").html(data.msg);
				}
			}
		});
	}
}