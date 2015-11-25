var map;

$(function() {
	set_map_height();
	$(window).resize(set_map_height);
	var myLatlng = new google.maps.LatLng(46.98165773, -88.51049423);
	var myOptions = {
		center: myLatlng,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR},
		mapTypeId: google.maps.MapTypeId.TERRAIN,
		navigationControlOptions: {
			style: google.maps.NavigationControlStyle.ZOOM_PAN},
		streetViewControl: false,
		zoom: 9
	};
	map = new google.maps.Map(document.getElementById('map'), myOptions);
});

function set_map_height()
{
	var window_height = $(window).height();
	var new_height = $(window).height() - ($('#header').height() + $('#menu').height() + parseInt($('#content').css('padding-top').substring(0, $('#content').css('padding-top').length - 2)));
	$('#map').css('height', new_height);
}