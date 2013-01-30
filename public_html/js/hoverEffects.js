$('.song').hover(function() {
	$(this).children('.playMedia').css('visibility','visible');
	$(this).children('.pencil').css('visibility','visible');
	$(this).children('.remove').css('visibility','visible');
	$(this).children('.add').css('visibility','visible');
	$(this).children('.comment').css('visibility','visible');
}, function() {
	$(this).children('.playMedia').css('visibility','hidden');
	$(this).children('.pencil').css('visibility','hidden');
	$(this).children('.remove').css('visibility','hidden');
	$(this).children('.add').css('visibility','hidden');
	$(this).children('.comment').css('visibility','hidden');
});