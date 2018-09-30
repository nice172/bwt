var glide = $('.slider').glide({
	afterTransition: function() {
		var currentSlide = this.currentSlide;
	}
}).data('api_glide');
$(window).on('keyup', function (key) {
	if (key.keyCode === 13) {
		glide.jump(3, console.log('Wooo!'));
	};
});