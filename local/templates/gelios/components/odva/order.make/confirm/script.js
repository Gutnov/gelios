var confirmPopap =
{
	code: '',
	getCode:function()
	{
		this.setNuber();
		$.post(
			BX.message('TEMPLATE_PATH_COFIRM')+"/ajax.get.code.php",
			{
				'PHONE':$(".order-register__form-item--phone").val()
			},
			(data)=>
			{
				let result = JSON.parse(data);
				if(result.success == true)
				{
					this.code = result.code;
				}
				else
				{
					$(".popup-confirm__input .l-input__sub-text").html(result.errorMsg);
				}
			}
		)
	},
	checkCode:function()
	{
		$.getScript('https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js', ()=>
		{
			if(CryptoJS.MD5($(".input-code-confirm--value").val()).toString() == this.code)
			{
				makeOrder.sendOrder();
			}
			else
			{
				$(".popup-confirm__input .l-input__sub-text").html("Не верный код!");
				$(".popup-confirm__input .l-input__sub-text").css('display','block');
			};
		});
	},
	setNuber:function()
	{
		let phone = $(".order-register__form-item--phone").val();
		let lenPhone = phone.length;
		let tt = phone.split('');
		if(lenPhone == 12)
		{
			tt.splice(2,"", " (");
			tt.splice(6,"", ") ");
			tt.splice(10,"", " ");
			tt.splice(13,"", " ");
		}
		else if(lenPhone == 13)
		{
			tt.splice(3,"", " (");
			tt.splice(7,"", ") ");
			tt.splice(11,"", " ");
			tt.splice(14,"", " ");
		}
		$(".popup-confirm__phone-num span").eq(0).html(tt.join(''));
	}
}