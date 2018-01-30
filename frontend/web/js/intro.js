
$(document).ready(function() {
	// get total width of all 'li' elements
	var totalWidth = 0;
	var slider = $('#slider');
	slider.find('li').each(function() {
		totalWidth += $(this).outerWidth();
	});

	// set width to container (with padding: +20px)
	slider.find('.items').outerWidth(totalWidth + 20);

	/*
				var delay = 2000;
				var speed = 1200;
				var i = 0;

				// Сreate array with all li elements
				var items = [];
				$('#slider').find('li').each(function(){
					items.push(this);
				});


				// window.setInterval(function(){
				// 	moveNext();
				// }, delay);


				function moveNext() {
					// Get current x pos of elements conteiner
					var currentPos = parseInt($('#slider').find('.items').css('left'));
					if (isNaN(currentPos)) {
						currentPos = 0;
					}

					// Calculate offset to moving elements container
					var moveOffset = $(items[i]).outerWidth();

					i++;
					if(i===items.length){
						i=0;
					}

					$('#slider').find('.items').animate({ left : currentPos-moveOffset }, speed);

				}*/


});