//IvaLove
jQuery(document).ready(function($){
	'use strict';
	$(document).on('click','.iva-love', function() {
		var $loveLink = $(this);
		var $id = $(this).attr('id');
		
		if($loveLink.hasClass('loved')) return false;
		
		var $sendTheData = {
			action: 'iva-love', 
			loves_id: $id 
		}
		$.post(ivaLove.ajaxurl, $sendTheData, function(data){
			$loveLink.find('span').html(data);
			$loveLink.addClass('loved').attr('title','You already love this!');
			$loveLink.find('span').css({'opacity': 1,'width':'auto'});
		});
		return false;
	});
});