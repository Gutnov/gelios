var sendPasswordBitrix =
{
	mailInput:null,
	close:function()
	{
		if($('._recovery-content').hasClass('popup-recovery__content--hide'))
		{
			$('._recovery-content').removeClass('popup-recovery__content--hide');
			$('._recovery-success').addClass('popup-recovery__success--hide');
		}
		$(".popup-recovery__input .l-input__input").val("");
		$(".popup-recovery__input .l-input__input").siblings('.l-input__sub-text').css("display","none");
	},
	disableErrors:function(init)
	{
		$(init).siblings(".l-input__sub-text").css("display","none");
		$(init).siblings(".l-input__sub-text").html("Это поле объязательно!");
	},
	validate:function(init)
	{
		let errors = 0;
		$(init).find(".popup-recovery__input .l-input__input").each((indx,element)=>
		{
			if($(element).val() == "")
			{
				errors++;
				$(this.mailInput).siblings(".l-input__sub-text").css("color","#f44336");
				$(this.mailInput).siblings(".l-input__sub-text").css("bottom","-18px");
				$(element).siblings(".l-input__sub-text").css("display","block");
				$(element).siblings(".l-input__sub-text").html("Это поле объязательно!");
			}
		});
		if(errors > 0)
			return errors != 0;
		this.mailInput = $(".popup-recovery__input .l-input__input");
		let pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
		if($(this.mailInput).val().search(pattern) != 0)
		{
			$(this.mailInput).siblings(".l-input__sub-text").css("color","#f44336");
			$(this.mailInput).siblings(".l-input__sub-text").css("bottom","-18px");
			$(this.mailInput).siblings(".l-input__sub-text").css("display","block");
			$(this.mailInput).siblings(".l-input__sub-text").html("Введите верную почту");
			errors++;
		}
		if(errors > 0)
			return errors != 0;
		return errors != 0;
	},
	sendpassword:function(e,init)
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
			success: (data)=>
			{
				if(data.success == true)
				{
					$('._recovery-content').addClass('popup-recovery__content--hide');
					$('._recovery-success').removeClass('popup-recovery__success--hide');
				}
				else
				{
					$(this.mailInput).siblings(".l-input__sub-text").css("color","#f44336");
					$(this.mailInput).siblings(".l-input__sub-text").css("display","block");
					$(this.mailInput).siblings(".l-input__sub-text").html(data.msg);
				}
			}
		});
	}
}