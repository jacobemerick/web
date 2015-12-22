$.fn.hint = function () {

	var blur_class = 'blur';

	return this.each(function() {

		var input = $(this);
		var title = input.attr('title');

		function remove() {
			if(input.val() === title && input.hasClass(blur_class))
				input.val('').removeClass(blur_class);}

		if(title) {
			input.blur(function() {
				if(this.value === '')
					input.val(title).addClass(blur_class);}).focus(remove).blur();

			$(this.form).submit(remove);
			$(window).unload(remove);}});}
