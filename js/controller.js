$().ready(function() { 
	$('form[name="addCadastro"]').submit(function() {
		var dados 		= $(this).serialize();
		var action 		= $(this).attr('action');
		$.ajax({
			url: action,
			dataType: "json", 
			type: 'POST',
			data: dados,
			success: function(responseText){
            	if(responseText.acao == 'success'){            		
            		$('.msg').html(responseText.msg).fadeIn('show');
            		window.setTimeout(function(){
            			$('.msg').html('').fadeOut(300);
            			$("input[type=text], input[type=email], input[type=tel]").val("");
            		},2500);
            	}else{
            		$('.msg').html(responseText.msg).fadeIn('show');
            		window.setTimeout(function(){$('.msg').html('').fadeOut(300);},2500);
            	}								
			},
			beforeSend: function(){},
			complete: function(){},
			error:function(){alert('Erro no processamento, fale com nosso suporte');}
		});	
		return false;
	});	

	$('form[name="eddCadastro"]').submit(function() {
		var dados 		= $(this).serialize();
		var action 		= $(this).attr('action');
		$.ajax({
			url: action,
			dataType: "json", 
			type: 'POST',
			data: dados,
			success: function(responseText){
            	if(responseText.acao == 'success'){            		
            		$('.lista'+responseText.idtb_agenda).addClass('bg-success');            		
            		window.setTimeout(function(){
            			$('.lista'+responseText.idtb_agenda).html(responseText.tr);            			
            			$('.edd_agenda'+responseText.idtb_agenda).fadeOut('600');
            			$('.lista'+responseText.idtb_agenda).removeClass('bg-success'); 
            		},500);
            	}else{
            		$('.lista'+responseText.idtb_agenda).addClass('bg-danger');  
            	}								
			},
			beforeSend: function(){},
			complete: function(){},
			error:function(){alert('Erro no processamento, fale com nosso suporte');}
		});	
		return false;
	});		

	$('body').on('submit','form[name="exCadastro"]',function() {
		var action 		= $(this).attr('action');
		var dados 		= $(this).serialize();
		$.ajax({
			url: action,
			dataType: "json", 
			type: 'POST',
			data: dados,
			success: function(responseText){
            	if(responseText.acao == 'success'){            		
            		$('.lista'+responseText.idtb_agenda).addClass('bg-danger');
            		$('.edd_agenda'+responseText.idtb_agenda).fadeOut(200);            		
            		window.setTimeout(function(){
            			$('.lista'+responseText.idtb_agenda).fadeOut(600);
            			
            		},500);
            	}else{
            		$('.lista'+responseText.idtb_agenda).addClass('bg-danger');  
            	}								
			},
			beforeSend: function(){},
			complete: function(){},
			error:function(){alert('Erro no processamento, fale com nosso suporte');}
		});	
		return false;
	});	

}); 