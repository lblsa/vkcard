$(function(){
	$('.menu a').click(function(){
		
		$('.menu a').removeClass('active');
		$(this).addClass('active');
		var id = $(this).attr('data-step');
		var title = $(this).attr('data-title');
		

		//$('.content:visible').hide("slide", { direction: "left" }, 1000);
		//$('#step'+id).show("slide", { direction: "right" }, 1000);
		
		//console.log($('.content:visible').width(), $('#step'+id).width());
		$('.title h2').fadeOut(1000);	

		$('.content:visible').animate({width:'hide'},1000,function(){
			$(this).hide();
		});

		$('#step'+id).animate({width:'show'},1000,function(){
			$(this).show();
			$('.title h2').html(title).fadeIn(500);	
		});

		return false;
	});
	$('.friends li').click(function(){
		
		$('.friends li').removeClass('active');
		$(this).addClass('active');

		return false;
	});

	$('.vign_cat').change(function(){
		if ($(this).val() != 0){
			$('.vign li').hide();
			$('.vign li[data-cat='+$(this).val()+']').fadeIn();
		} else {
			$('.vign li').fadeIn();
		}
	});

	$('.text-align a').click(function(){
		$('.text-align a').removeClass('active');
		$(this).addClass('active');
		$('.text textarea').css('text-align',$(this).attr('data-align'));
	});

});
