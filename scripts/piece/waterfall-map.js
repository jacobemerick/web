$(function() {
    if (window['google'] == undefined) {
        return;
    }
    
    var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(47, -88.5),
        mapTypeId: google.maps.MapTypeId.TERRAIN,
        zoom: 9
    });
    
    var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow();
    
    $('#waterfall-list li').each(function() {
        var coordinate_pair = $(this).attr('data-coordinate').split(',');
        var coordinate = new google.maps.LatLng(coordinate_pair[0], coordinate_pair[1]);
        
        if ($(this).attr('data-initial-ignore') !== 'true') {
            bounds.extend(coordinate);
        }
        
        var marker = new google.maps.Marker({
            map: map,
            position: coordinate,
            title: $(this).text()
        });
        
        google.maps.event.addListener(marker, 'click', function() {
            var node = $('#waterfall-list li:contains("' + this.title + '")');
            
            if (node.length == 0) {
                return;
            }
            
            var content = '<div class="waterfall-pane">';
            content += '<a href="' + node.attr('data-link') + '">';
            content += '<div class="photo">';
            content += '<img src="' + node.attr('data-image') + '" alt="' + node.attr('data-image-alt') + '" height="375" width="500" />';
            content += '</div>';
            content += '<div class="title">';
            content += '<h2>' + node.attr('data-waterfall') + '</h2>';
            content += '<h4> on ' + node.attr('data-river') + '</h4>';
            content += '</div>';
            content += '</a>';
            content += '</div>';
            
            infowindow.setContent(content);
            infowindow.open(map, this);
        });
    });
    
    map.fitBounds(bounds);
});