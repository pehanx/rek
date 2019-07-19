$(document).ready(function() {
	$('#loadmore').click(function (event) {
		event.preventDefault();

		var data = {'action': action, 'query': loadmore_posts, 'page': current_page};
		$.ajax({
			url: ajaxurl, data: data, type: 'POST', success: function (data) {
				if (data) {
					$('.be-ajax-loadmore-container').append(data);
					current_page++;
					if (current_page == max_pages) $("#loadmore").remove();
				} else {
					$('#loadmore').remove();
				}
			}
		});
	});
	
	$( "#typeParty" ).change(function() {
		 $( "#infoTypeParty" ).text($(this).children("option:selected").val());
	});

	$("#eventCalendar").eventCalendar({
		jsonData:data_cal
	});

	$(".Calendar").css('display','none');

	$('.calendaropen').on('click',function(e){
		e.preventDefault();
		var width = $('body').innerWidth();
		$('.Calendar').css('display', 'block');
		$('.calendar_bg').css('display', 'block');
		$('body, html').addClass('noscroll');
		$('body').width(width);
		setTimeout(function(){
			$('.calendar_bg').css('background-color', 'rgba(0,0,0,0.7)');
			$('.Calendar').css('opacity',1);
		},200);
	});

	$('.Calendar').on('click',function(e){
		e.stopPropagation()
	});

	$('.calendar_bg').on('click',function(){
		$('.Calendar').css('opacity', 0);
		$(this).css('background-color', 'rgba(0,0,0,0)');
		setTimeout(function(){
			$('.Calendar').css('display', 'none');
			$('.calendar_bg').css('display', 'none');
			$('body, html').removeClass('noscroll');
			$('body').width('auto');
		},200);
	});
});