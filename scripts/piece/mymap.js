$(
	function()
	{
		var myLatlng = new google.maps.LatLng(46.98165773,-88.51049423);
		var myOptions = {
		  zoom: 9,
		  center: myLatlng,
		  mapTypeId: google.maps.MapTypeId.HYBRID
		};
		var map = new google.maps.Map(document.getElementById("map"), myOptions);
		
		//$('#pull').val("select id,falls_name as poi from jpemeric_waterfalls.falls where latlng_id='0' limit 1");
		$('#pull').val("select photos.id,photos.filename as photo,caption as poi from jpemeric_waterfalls.photos,jpemeric_waterfalls.falls where photos.latlng_id='' and falls_name='Agate' and falls_id=falls.id order by timestamp desc limit 1");
		//$('#execute').val("insert into jpemeric_waterfalls.latlng (lat,lng) values('00.00','00.00');update jpemeric_waterfalls.falls set latlng_id=(select last_insert_id()) where id='0'");
		$('#execute').val("insert into jpemeric_waterfalls.latlng (lat,lng) values('00.00','00.00');update jpemeric_waterfalls.photos set latlng_id=(select last_insert_id()) where id='0'");
		
		$('#run_pull').click(pull_new_id);
		$('#run_execute').click(execute);

		google.maps.event.addListener(map,'click',function(e)
		{
			if($('#record_points:checked').length==1)
				add_point_to_insert(e.latLng);
		});
	}
);

function pull_new_id()
{
	$.ajax({
		type:'POST',
		url:'/setData/',
		data:'select='+$('#pull').val(),
		dataType:'json',
		success:function(obj)
		{
			$('#poi').text(obj.poi);
			set_insert_id(obj.id);
			if(obj.photo)
			{
				$('#poi').append('<img src="http://waterfalls.jacobemerick.com/images/falls/thumb-'+obj.photo+'.jpg" />');
			}
		},
		error:function()
		{
			alert('error');
		}
	});
}

function execute()
{
	$.ajax({
		type:'POST',
		url:'/setData/',
		data:'execute='+$('#execute').val(),
		dataType:'json',
		success:function(obj)
		{
			alert('wot');
		},
		error:function()
		{
			pull_new_id();
		}
	});
}

function set_insert_id(id)
{
	var rgx = / id='([0-9]+)'/;
	$('#execute').val($('#execute').val().replace(rgx," id='"+id+"'"));
}

function add_point_to_insert(location)
{
	var rgx = /('([0-9\.-]+)','([0-9\.-]+)')/;
	$('#execute').val($('#execute').val().replace(rgx,"'"+location.lat()+"','"+location.lng()+"'"));
}