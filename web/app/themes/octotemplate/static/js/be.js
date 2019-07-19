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
});