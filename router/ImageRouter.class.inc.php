<?

Loader::load('router', 'Router');

final class ImageRouter extends Router
{

	protected function get_redirect_array()
	{
		return array(
			(object) array(
				'pattern' => '@^/$@',
				'replace' => 'http://home.jacobemerick.com/'),
			(object) array(
				'pattern' => '@^/mead_forest-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/mead-forest-trail-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mead_forest-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/mead-forest-trail-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mead_forest-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/mead-forest-trail-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mead_forest-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/mead-forest-trail-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mead_forest-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/mead-forest-trail-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/bald-mountain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/bald-mountain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/bald-mountain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/bald-mountain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/bald-mountain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/south-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/south-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/south-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/south-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/bald_mountain_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/south-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blue_ice_formation-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/blue-ice-formation-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blue_ice_formation-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/blue-ice-formation-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blue_ice_formation-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/blue-ice-formation-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blue_ice_formation-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/blue-ice-formation-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blue_ice_formation-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/blue-ice-formation-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/logan_on_bald_mountain-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/logan-and-cairn-size-full.jpg'),
			(object) array(
				'pattern' => '@^/logan_on_bald_mountain-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/logan-and-cairn-size-large.jpg'),
			(object) array(
				'pattern' => '@^/logan_on_bald_mountain-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/logan-and-cairn-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/logan_on_bald_mountain-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/logan-and-cairn-size-small.jpg'),
			(object) array(
				'pattern' => '@^/logan_on_bald_mountain-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-mountain/logan-and-cairn-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/young_logan-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rice-lake/logan-size-full.jpg'),
			(object) array(
				'pattern' => '@^/young_logan-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rice-lake/logan-size-large.jpg'),
			(object) array(
				'pattern' => '@^/young_logan-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rice-lake/logan-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/young_logan-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rice-lake/logan-size-small.jpg'),
			(object) array(
				'pattern' => '@^/young_logan-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rice-lake/logan-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lower_montreal_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-montreal-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lower_montreal_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-montreal-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lower_montreal_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-montreal-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lower_montreal_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-montreal-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lower_montreal_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-montreal-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lost_creek_mountains-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/panorama-hills/central-hills-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lost_creek_mountains-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/panorama-hills/central-hills-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lost_creek_mountains-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/panorama-hills/central-hills-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lost_creek_mountains-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/panorama-hills/central-hills-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lost_creek_mountains-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/panorama-hills/central-hills-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/little_mountain_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/little-mountain/east-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/little_mountain_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/little-mountain/east-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/little_mountain_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/little-mountain/east-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/little_mountain_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/little-mountain/east-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/little_mountain_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/little-mountain/east-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/jacobs_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-lower-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/jacobs_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-lower-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/jacobs_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-lower-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/jacobs_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-lower-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/jacobs_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-lower-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/upper_jacobs_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-upper-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/upper_jacobs_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-upper-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/upper_jacobs_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-upper-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/upper_jacobs_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-upper-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/upper_jacobs_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jacobs-falls/snow-covered-upper-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/upper-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/upper-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/upper-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/upper-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/upper-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_stamp_sand-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/stamp-sand-size-full.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_stamp_sand-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/stamp-sand-size-large.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_stamp_sand-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/stamp-sand-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_stamp_sand-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/stamp-sand-size-small.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_stamp_sand-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/stamp-sand-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_marsh-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/marsh-size-full.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_marsh-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/marsh-size-large.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_marsh-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/marsh-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_marsh-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/marsh-size-small.jpg'),
			(object) array(
				'pattern' => '@^/copper_falls_marsh-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/copper-falls/marsh-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/empty_silver_lake_basin-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-east-shore-size-full.jpg'),
			(object) array(
				'pattern' => '@^/empty_silver_lake_basin-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-east-shore-size-large.jpg'),
			(object) array(
				'pattern' => '@^/empty_silver_lake_basin-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-east-shore-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/empty_silver_lake_basin-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-east-shore-size-small.jpg'),
			(object) array(
				'pattern' => '@^/empty_silver_lake_basin-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-east-shore-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mcclure_dam-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mcclure-basin/mcclure-dam-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mcclure_dam-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mcclure-basin/mcclure-dam-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mcclure_dam-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mcclure-basin/mcclure-dam-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mcclure_dam-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mcclure-basin/mcclure-dam-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mcclure_dam-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mcclure-basin/mcclure-dam-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/trestle_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/trestle-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/trestle_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/trestle-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/trestle_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/trestle-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/trestle_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/trestle-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/trestle_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/trestle-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/forestville_dam-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/forestville-basin/forestville-dam-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/forestville_dam-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/forestville-basin/forestville-dam-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/forestville_dam-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/forestville-basin/forestville-dam-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/forestville_dam-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/forestville-basin/forestville-dam-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/forestville_dam-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/forestville-basin/forestville-dam-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/tourist_park_basin-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tourist-park-basin/dewatered-south-shore-size-full.jpg'),
			(object) array(
				'pattern' => '@^/tourist_park_basin-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tourist-park-basin/dewatered-south-shore-size-large.jpg'),
			(object) array(
				'pattern' => '@^/tourist_park_basin-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tourist-park-basin/dewatered-south-shore-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/tourist_park_basin-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tourist-park-basin/dewatered-south-shore-size-small.jpg'),
			(object) array(
				'pattern' => '@^/tourist_park_basin-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tourist-park-basin/dewatered-south-shore-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-evening-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-evening-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-evening-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-evening-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-evening-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_cliff-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/forested-cliff-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_cliff-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/forested-cliff-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_cliff-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/forested-cliff-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_cliff-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/forested-cliff-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_cliff-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/forested-cliff-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/lower-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/lower-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/lower-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/lower-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/lower-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_gorge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/cluttered-lower-gorge-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_gorge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/cluttered-lower-gorge-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_gorge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/cluttered-lower-gorge-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_gorge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/cluttered-lower-gorge-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_gorge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/cluttered-lower-gorge-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/upper_mulligan_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/upper-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/upper_mulligan_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/upper-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/upper_mulligan_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/upper-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/upper_mulligan_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/upper-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/upper_mulligan_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/upper-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/upper_silver_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/upper-silver-falls/upper-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/upper_silver_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/upper-silver-falls/upper-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/upper_silver_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/upper-silver-falls/upper-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/upper_silver_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/upper-silver-falls/upper-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/upper_silver_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/upper-silver-falls/upper-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/lower-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/lower-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/lower-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/lower-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/lower-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/sturgeon_river_gorge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sturgeon-river-falls/barren-gorge-size-full.jpg'),
			(object) array(
				'pattern' => '@^/sturgeon_river_gorge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sturgeon-river-falls/barren-gorge-size-large.jpg'),
			(object) array(
				'pattern' => '@^/sturgeon_river_gorge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sturgeon-river-falls/barren-gorge-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/sturgeon_river_gorge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sturgeon-river-falls/barren-gorge-size-small.jpg'),
			(object) array(
				'pattern' => '@^/sturgeon_river_gorge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sturgeon-river-falls/barren-gorge-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/onion_creek_gorge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/onion-falls/snow-filled-gorge-size-full.jpg'),
			(object) array(
				'pattern' => '@^/onion_creek_gorge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/onion-falls/snow-filled-gorge-size-large.jpg'),
			(object) array(
				'pattern' => '@^/onion_creek_gorge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/onion-falls/snow-filled-gorge-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/onion_creek_gorge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/onion-falls/snow-filled-gorge-size-small.jpg'),
			(object) array(
				'pattern' => '@^/onion_creek_gorge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/onion-falls/snow-filled-gorge-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/slate_river_gorge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/slate-river-falls/gorge-past-the-lower-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/slate_river_gorge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/slate-river-falls/gorge-past-the-lower-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/slate_river_gorge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/slate-river-falls/gorge-past-the-lower-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/slate_river_gorge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/slate-river-falls/gorge-past-the-lower-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/slate_river_gorge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/slate-river-falls/gorge-past-the-lower-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/bulldog_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bulldog-falls/main-middle-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/bulldog_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bulldog-falls/main-middle-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/bulldog_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bulldog-falls/main-middle-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/bulldog_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bulldog-falls/main-middle-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/bulldog_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bulldog-falls/main-middle-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/yellow_dog_river-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/yellow-dog-falls/small-middle-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/yellow_dog_river-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/yellow-dog-falls/small-middle-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/yellow_dog_river-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/yellow-dog-falls/small-middle-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/yellow_dog_river-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/yellow-dog-falls/small-middle-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/yellow_dog_river-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/yellow-dog-falls/small-middle-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/unnamed_rocky_peak-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/ghost-deer-mountain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/unnamed_rocky_peak-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/ghost-deer-mountain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/unnamed_rocky_peak-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/ghost-deer-mountain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/unnamed_rocky_peak-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/ghost-deer-mountain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/unnamed_rocky_peak-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/ghost-deer-mountain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/little_huron_river-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/little-huron-river-size-full.jpg'),
			(object) array(
				'pattern' => '@^/little_huron_river-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/little-huron-river-size-large.jpg'),
			(object) array(
				'pattern' => '@^/little_huron_river-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/little-huron-river-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/little_huron_river-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/little-huron-river-size-small.jpg'),
			(object) array(
				'pattern' => '@^/little_huron_river-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/little-huron-river-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/cliff-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/cliff-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/cliff-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/cliff-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/cliff-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/superior-mountain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/superior-mountain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/superior-mountain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/superior-mountain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/superior-mountain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/east_branch_ontonagon_river-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jumbo-falls/river-below-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/east_branch_ontonagon_river-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jumbo-falls/river-below-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/east_branch_ontonagon_river-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jumbo-falls/river-below-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/east_branch_ontonagon_river-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jumbo-falls/river-below-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/east_branch_ontonagon_river-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/jumbo-falls/river-below-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/agate_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/agate-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/agate_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/agate-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/agate_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/agate-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/agate_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/agate-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/agate_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/agate-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/victoria_dam-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/victoria-basin/icy-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/victoria_dam-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/victoria-basin/icy-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/victoria_dam-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/victoria-basin/icy-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/victoria_dam-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/victoria-basin/icy-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/victoria_dam-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/victoria-basin/icy-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ontonagon_river-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/plover-falls/ontonagon-near-plover-creek-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ontonagon_river-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/plover-falls/ontonagon-near-plover-creek-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ontonagon_river-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/plover-falls/ontonagon-near-plover-creek-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ontonagon_river-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/plover-falls/ontonagon-near-plover-creek-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ontonagon_river-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/plover-falls/ontonagon-near-plover-creek-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hogback_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hogback_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hogback_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hogback_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hogback_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mccormick_trailhead-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/trailhead-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mccormick_trailhead-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/trailhead-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mccormick_trailhead-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/trailhead-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mccormick_trailhead-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/trailhead-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mccormick_trailhead-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/trailhead-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_river-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/peshekee-river-size-full.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_river-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/peshekee-river-size-large.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_river-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/peshekee-river-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_river-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/peshekee-river-size-small.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_river-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/peshekee-river-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake_island-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-island-size-full.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake_island-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-island-size-large.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake_island-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-island-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake_island-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-island-size-small.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake_island-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-island-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/old_foundations-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/old-foundations-size-full.jpg'),
			(object) array(
				'pattern' => '@^/old_foundations-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/old-foundations-size-large.jpg'),
			(object) array(
				'pattern' => '@^/old_foundations-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/old-foundations-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/old_foundations-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/old-foundations-size-small.jpg'),
			(object) array(
				'pattern' => '@^/old_foundations-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/old-foundations-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-west-shore-size-full.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-west-shore-size-large.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-west-shore-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-west-shore-size-small.jpg'),
			(object) array(
				'pattern' => '@^/white_deer_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mccormick-tract/white-deer-lake-west-shore-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/smokey_valley-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/cliff-lake-hollow-size-full.jpg'),
			(object) array(
				'pattern' => '@^/smokey_valley-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/cliff-lake-hollow-size-large.jpg'),
			(object) array(
				'pattern' => '@^/smokey_valley-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/cliff-lake-hollow-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/smokey_valley-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/cliff-lake-hollow-size-small.jpg'),
			(object) array(
				'pattern' => '@^/smokey_valley-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/cliff-lake-hollow-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/grassy_slope-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/west-slope-size-full.jpg'),
			(object) array(
				'pattern' => '@^/grassy_slope-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/west-slope-size-large.jpg'),
			(object) array(
				'pattern' => '@^/grassy_slope-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/west-slope-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/grassy_slope-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/west-slope-size-small.jpg'),
			(object) array(
				'pattern' => '@^/grassy_slope-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/west-slope-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain_cliff-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/large-bluff-size-full.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain_cliff-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/large-bluff-size-large.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain_cliff-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/large-bluff-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain_cliff-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/large-bluff-size-small.jpg'),
			(object) array(
				'pattern' => '@^/superior_mountain_cliff-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/large-bluff-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cloudy_cliff_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/smoky-cliff-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cloudy_cliff_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/smoky-cliff-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cloudy_cliff_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/smoky-cliff-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cloudy_cliff_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/smoky-cliff-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cloudy_cliff_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/smoky-cliff-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/smoky_hills-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/logan-size-full.jpg'),
			(object) array(
				'pattern' => '@^/smoky_hills-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/logan-size-large.jpg'),
			(object) array(
				'pattern' => '@^/smoky_hills-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/logan-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/smoky_hills-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/logan-size-small.jpg'),
			(object) array(
				'pattern' => '@^/smoky_hills-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/superior-mountain/logan-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upstream-from-red-road-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upstream-from-red-road-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upstream-from-red-road-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upstream-from-red-road-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upstream-from-red-road-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_sandy_valley-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/sandy-plain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_sandy_valley-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/sandy-plain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_sandy_valley-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/sandy-plain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_sandy_valley-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/sandy-plain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_sandy_valley-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/sandy-plain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_lookout-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-south-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_lookout-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-south-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_lookout-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-south-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_lookout-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-south-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_lookout-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-south-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/island_lake_trail-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/main-trail-size-full.jpg'),
			(object) array(
				'pattern' => '@^/island_lake_trail-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/main-trail-size-large.jpg'),
			(object) array(
				'pattern' => '@^/island_lake_trail-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/main-trail-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/island_lake_trail-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/main-trail-size-small.jpg'),
			(object) array(
				'pattern' => '@^/island_lake_trail-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/main-trail-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/island_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/island_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/island_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/island_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/island_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/island-lake/lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_bog-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upper-swamp-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_bog-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upper-swamp-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_bog-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upper-swamp-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_bog-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upper-swamp-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_bog-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek/upper-swamp-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/smokey_mulligan_cliff-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/forested-cliff-size-full.jpg'),
			(object) array(
				'pattern' => '@^/smokey_mulligan_cliff-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/forested-cliff-size-large.jpg'),
			(object) array(
				'pattern' => '@^/smokey_mulligan_cliff-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/forested-cliff-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/smokey_mulligan_cliff-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/forested-cliff-size-small.jpg'),
			(object) array(
				'pattern' => '@^/smokey_mulligan_cliff-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/forested-cliff-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_waterfall-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/overflow-waterfall-size-full.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_waterfall-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/overflow-waterfall-size-large.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_waterfall-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/overflow-waterfall-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_waterfall-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/overflow-waterfall-size-small.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_waterfall-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/overflow-waterfall-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/northern_rocking_chair_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-north-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/northern_rocking_chair_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-north-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/northern_rocking_chair_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-north-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/northern_rocking_chair_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-north-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/northern_rocking_chair_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-north-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/southern_rocking_chair_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-south-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/southern_rocking_chair_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-south-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/southern_rocking_chair_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-south-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/southern_rocking_chair_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-south-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/southern_rocking_chair_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-south-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-view-west-size-full.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-view-west-size-large.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-view-west-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-view-west-size-small.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/cloudy-view-west-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_mountain_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-mountain/north-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_mountain_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-mountain/north-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_mountain_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-mountain/north-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_mountain_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-mountain/north-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_mountain_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-mountain/north-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mt_kallio_side-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-kallio/south-outcropping-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mt_kallio_side-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-kallio/south-outcropping-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mt_kallio_side-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-kallio/south-outcropping-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mt_kallio_side-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-kallio/south-outcropping-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mt_kallio_side-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-kallio/south-outcropping-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/east-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/east-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/east-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/east-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/east-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliffs-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/cabin-and-cliffs-size-full.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliffs-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/cabin-and-cliffs-size-large.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliffs-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/cabin-and-cliffs-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliffs-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/cabin-and-cliffs-size-small.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliffs-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/cabin-and-cliffs-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/dead_river_basin_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/narrow-cliff-cut-size-full.jpg'),
			(object) array(
				'pattern' => '@^/dead_river_basin_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/narrow-cliff-cut-size-large.jpg'),
			(object) array(
				'pattern' => '@^/dead_river_basin_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/narrow-cliff-cut-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/dead_river_basin_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/narrow-cliff-cut-size-small.jpg'),
			(object) array(
				'pattern' => '@^/dead_river_basin_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/narrow-cliff-cut-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_south_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/south-mead-forest-size-full.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_south_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/south-mead-forest-size-large.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_south_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/south-mead-forest-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_south_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/south-mead-forest-size-small.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_south_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/south-mead-forest-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_gorge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/dead-river-basin-head-size-full.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_gorge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/dead-river-basin-head-size-large.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_gorge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/dead-river-basin-head-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_gorge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/dead-river-basin-head-size-small.jpg'),
			(object) array(
				'pattern' => '@^/red_road_cliff_gorge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/red-road-cliffs/dead-river-basin-head-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_bridge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/road-bridge-over-mulligan-creek-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_bridge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/road-bridge-over-mulligan-creek-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_bridge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/road-bridge-over-mulligan-creek-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_bridge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/road-bridge-over-mulligan-creek-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_bridge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/road-bridge-over-mulligan-creek-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_basin_edge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/eastern-shoreline-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_basin_edge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/eastern-shoreline-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_basin_edge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/eastern-shoreline-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_basin_edge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/eastern-shoreline-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_basin_edge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/eastern-shoreline-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/swollen_mulligan_middle_canyon-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/middle-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/swollen_mulligan_middle_canyon-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/middle-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/swollen_mulligan_middle_canyon-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/middle-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/swollen_mulligan_middle_canyon-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/middle-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/swollen_mulligan_middle_canyon-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-falls/middle-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_road-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/snow-covered-road-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_road-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/snow-covered-road-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_road-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/snow-covered-road-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_road-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/snow-covered-road-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_road-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/snow-covered-road-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/straight_peshekee_grade-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/straight-grade-size-full.jpg'),
			(object) array(
				'pattern' => '@^/straight_peshekee_grade-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/straight-grade-size-large.jpg'),
			(object) array(
				'pattern' => '@^/straight_peshekee_grade-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/straight-grade-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/straight_peshekee_grade-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/straight-grade-size-small.jpg'),
			(object) array(
				'pattern' => '@^/straight_peshekee_grade-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/straight-grade-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/snowy_peshekee_river-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/bridge-over-peshekee-river-size-full.jpg'),
			(object) array(
				'pattern' => '@^/snowy_peshekee_river-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/bridge-over-peshekee-river-size-large.jpg'),
			(object) array(
				'pattern' => '@^/snowy_peshekee_river-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/bridge-over-peshekee-river-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/snowy_peshekee_river-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/bridge-over-peshekee-river-size-small.jpg'),
			(object) array(
				'pattern' => '@^/snowy_peshekee_river-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/bridge-over-peshekee-river-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_railroad_cut-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/middle-cut-size-full.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_railroad_cut-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/middle-cut-size-large.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_railroad_cut-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/middle-cut-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_railroad_cut-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/middle-cut-size-small.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_railroad_cut-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/middle-cut-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/haypress_dam_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haypress-dam-falls/snow-covered-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/haypress_dam_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haypress-dam-falls/snow-covered-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/haypress_dam_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haypress-dam-falls/snow-covered-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/haypress_dam_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haypress-dam-falls/snow-covered-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/haypress_dam_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haypress-dam-falls/snow-covered-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/summit_cut-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-size-full.jpg'),
			(object) array(
				'pattern' => '@^/summit_cut-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-size-large.jpg'),
			(object) array(
				'pattern' => '@^/summit_cut-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/summit_cut-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-size-small.jpg'),
			(object) array(
				'pattern' => '@^/summit_cut-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_grade-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-grade-size-full.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_grade-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-grade-size-large.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_grade-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-grade-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_grade-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-grade-size-small.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_grade-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-grade-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_trestle_remains-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-trestle-remains-size-full.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_trestle_remains-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-trestle-remains-size-large.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_trestle_remains-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-trestle-remains-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_trestle_remains-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-trestle-remains-size-small.jpg'),
			(object) array(
				'pattern' => '@^/summit_railroad_trestle_remains-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/peshekee-grade/summit-cut-trestle-remains-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/two_track_radio_tower-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/clear-cut-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/two_track_radio_tower-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/clear-cut-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/two_track_radio_tower-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/clear-cut-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/two_track_radio_tower-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/clear-cut-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/two_track_radio_tower-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/clear-cut-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_swamp-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-bog-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_swamp-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-bog-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_swamp-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-bog-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_swamp-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-bog-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_swamp-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-bog-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/western_clark_creek_cliff_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-west-size-full.jpg'),
			(object) array(
				'pattern' => '@^/western_clark_creek_cliff_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-west-size-large.jpg'),
			(object) array(
				'pattern' => '@^/western_clark_creek_cliff_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-west-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/western_clark_creek_cliff_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-west-size-small.jpg'),
			(object) array(
				'pattern' => '@^/western_clark_creek_cliff_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/looking-west-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_spring-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-small-spring-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_spring-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-small-spring-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_spring-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-small-spring-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_spring-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-small-spring-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_cliff_spring-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-cliff-small-spring-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_cabin-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/cabin-on-silver-lead-mine-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_cabin-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/cabin-on-silver-lead-mine-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_cabin-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/cabin-on-silver-lead-mine-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_cabin-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/cabin-on-silver-lead-mine-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_cabin-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/cabin-on-silver-lead-mine-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/bog_walkway-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/walkway-over-bog-size-full.jpg'),
			(object) array(
				'pattern' => '@^/bog_walkway-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/walkway-over-bog-size-large.jpg'),
			(object) array(
				'pattern' => '@^/bog_walkway-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/walkway-over-bog-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/bog_walkway-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/walkway-over-bog-size-small.jpg'),
			(object) array(
				'pattern' => '@^/bog_walkway-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/walkway-over-bog-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/south_from_black_rock_point-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/south-from-black-rock-point-size-full.jpg'),
			(object) array(
				'pattern' => '@^/south_from_black_rock_point-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/south-from-black-rock-point-size-large.jpg'),
			(object) array(
				'pattern' => '@^/south_from_black_rock_point-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/south-from-black-rock-point-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/south_from_black_rock_point-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/south-from-black-rock-point-size-small.jpg'),
			(object) array(
				'pattern' => '@^/south_from_black_rock_point-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/south-from-black-rock-point-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/north_from_black_rock_point-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/north-from-black-rock-point-size-full.jpg'),
			(object) array(
				'pattern' => '@^/north_from_black_rock_point-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/north-from-black-rock-point-size-large.jpg'),
			(object) array(
				'pattern' => '@^/north_from_black_rock_point-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/north-from-black-rock-point-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/north_from_black_rock_point-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/north-from-black-rock-point-size-small.jpg'),
			(object) array(
				'pattern' => '@^/north_from_black_rock_point-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/north-from-black-rock-point-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/superior_from_salmon_trout_point-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/east-over-superior-size-full.jpg'),
			(object) array(
				'pattern' => '@^/superior_from_salmon_trout_point-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/east-over-superior-size-large.jpg'),
			(object) array(
				'pattern' => '@^/superior_from_salmon_trout_point-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/east-over-superior-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/superior_from_salmon_trout_point-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/east-over-superior-size-small.jpg'),
			(object) array(
				'pattern' => '@^/superior_from_salmon_trout_point-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/east-over-superior-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/south_from_salmon_trout_point-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/eastern-shoreline-size-full.jpg'),
			(object) array(
				'pattern' => '@^/south_from_salmon_trout_point-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/eastern-shoreline-size-large.jpg'),
			(object) array(
				'pattern' => '@^/south_from_salmon_trout_point-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/eastern-shoreline-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/south_from_salmon_trout_point-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/eastern-shoreline-size-small.jpg'),
			(object) array(
				'pattern' => '@^/south_from_salmon_trout_point-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/eastern-shoreline-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/sunset_over_conway_point-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/sunset-over-conway-point-size-full.jpg'),
			(object) array(
				'pattern' => '@^/sunset_over_conway_point-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/sunset-over-conway-point-size-large.jpg'),
			(object) array(
				'pattern' => '@^/sunset_over_conway_point-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/sunset-over-conway-point-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/sunset_over_conway_point-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/sunset-over-conway-point-size-small.jpg'),
			(object) array(
				'pattern' => '@^/sunset_over_conway_point-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/salmon-trout-point/sunset-over-conway-point-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/bald_hill_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-hill/east-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/bald_hill_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-hill/east-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/bald_hill_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-hill/east-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/bald_hill_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-hill/east-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/bald_hill_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/bald-hill/east-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/morning_on_mulligan_plains-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/south-from-stager-cliffs-size-full.jpg'),
			(object) array(
				'pattern' => '@^/morning_on_mulligan_plains-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/south-from-stager-cliffs-size-large.jpg'),
			(object) array(
				'pattern' => '@^/morning_on_mulligan_plains-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/south-from-stager-cliffs-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/morning_on_mulligan_plains-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/south-from-stager-cliffs-size-small.jpg'),
			(object) array(
				'pattern' => '@^/morning_on_mulligan_plains-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/south-from-stager-cliffs-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_spooky_four_wheeler_trail-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/path-to-bob-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_spooky_four_wheeler_trail-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/path-to-bob-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_spooky_four_wheeler_trail-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/path-to-bob-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_spooky_four_wheeler_trail-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/path-to-bob-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mulligan_plains_spooky_four_wheeler_trail-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/path-to-bob-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/first_view_deer_lake_dam-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/dam-size-full.jpg'),
			(object) array(
				'pattern' => '@^/first_view_deer_lake_dam-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/dam-size-large.jpg'),
			(object) array(
				'pattern' => '@^/first_view_deer_lake_dam-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/dam-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/first_view_deer_lake_dam-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/dam-size-small.jpg'),
			(object) array(
				'pattern' => '@^/first_view_deer_lake_dam-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/dam-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake_dam_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/deer-lake-dam-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake_dam_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/deer-lake-dam-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake_dam_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/deer-lake-dam-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake_dam_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/deer-lake-dam-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/deer_lake_dam_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/deer-lake/deer-lake-dam-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/spooky_upper_dead_river-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-upper-dead-river-size-full.jpg'),
			(object) array(
				'pattern' => '@^/spooky_upper_dead_river-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-upper-dead-river-size-large.jpg'),
			(object) array(
				'pattern' => '@^/spooky_upper_dead_river-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-upper-dead-river-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/spooky_upper_dead_river-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-upper-dead-river-size-small.jpg'),
			(object) array(
				'pattern' => '@^/spooky_upper_dead_river-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dewatered-upper-dead-river-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_eastern_overlook-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/east-overlook-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_eastern_overlook-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/east-overlook-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_eastern_overlook-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/east-overlook-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_eastern_overlook-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/east-overlook-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_eastern_overlook-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/east-overlook-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southeastern_shoreline-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/southeast-shoreline-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southeastern_shoreline-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/southeast-shoreline-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southeastern_shoreline-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/southeast-shoreline-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southeastern_shoreline-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/southeast-shoreline-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southeastern_shoreline-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/southeast-shoreline-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_new_rock_wall-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/rebuilt-earth-plug-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_new_rock_wall-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/rebuilt-earth-plug-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_new_rock_wall-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/rebuilt-earth-plug-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_new_rock_wall-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/rebuilt-earth-plug-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_new_rock_wall-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/rebuilt-earth-plug-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_overflow_channel-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/overflow-channel-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_overflow_channel-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/overflow-channel-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_overflow_channel-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/overflow-channel-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_overflow_channel-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/overflow-channel-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_overflow_channel-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/overflow-channel-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_dam-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dam-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_dam-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dam-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_dam-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dam-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_dam-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dam-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_dam-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/dam-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_shallow_lakebed-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/grassy-lakebed-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_shallow_lakebed-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/grassy-lakebed-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_shallow_lakebed-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/grassy-lakebed-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_shallow_lakebed-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/grassy-lakebed-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_shallow_lakebed-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/grassy-lakebed-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_west_end-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/west-shoreline-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_west_end-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/west-shoreline-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_west_end-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/west-shoreline-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_west_end-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/west-shoreline-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_west_end-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/west-shoreline-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lakes_outflow_mouth_clutter-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/silver-lead-mine-lake-mouth-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lakes_outflow_mouth_clutter-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/silver-lead-mine-lake-mouth-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lakes_outflow_mouth_clutter-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/silver-lead-mine-lake-mouth-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lakes_outflow_mouth_clutter-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/silver-lead-mine-lake-mouth-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lakes_outflow_mouth_clutter-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/silver-lead-mine-lake-mouth-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/smoky_view_southern_mulligan_plains-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/smoky-view-from-stager-cliffs-size-full.jpg'),
			(object) array(
				'pattern' => '@^/smoky_view_southern_mulligan_plains-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/smoky-view-from-stager-cliffs-size-large.jpg'),
			(object) array(
				'pattern' => '@^/smoky_view_southern_mulligan_plains-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/smoky-view-from-stager-cliffs-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/smoky_view_southern_mulligan_plains-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/smoky-view-from-stager-cliffs-size-small.jpg'),
			(object) array(
				'pattern' => '@^/smoky_view_southern_mulligan_plains-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/smoky-view-from-stager-cliffs-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/stager_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/stager_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/stager_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/stager_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/stager_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/beaver_pond_below_stager-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/pond-below-stager-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/beaver_pond_below_stager-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/pond-below-stager-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/beaver_pond_below_stager-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/pond-below-stager-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/beaver_pond_below_stager-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/pond-below-stager-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/beaver_pond_below_stager-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/stager-lake/pond-below-stager-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-daylight-size-full.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-daylight-size-large.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-daylight-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-daylight-size-small.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mulligan-plains/north-end-in-daylight-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_snowy-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/snowy-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_snowy-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/snowy-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_snowy-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/snowy-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_snowy-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/snowy-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_snowy-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/snowy-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hidden_falls_upper-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hidden-falls/upper-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hidden_falls_upper-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hidden-falls/upper-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hidden_falls_upper-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hidden-falls/upper-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hidden_falls_upper-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hidden-falls/upper-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hidden_falls_upper-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hidden-falls/upper-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_summer-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_summer-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_summer-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_summer-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/weidman_lake_summer-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/weidman-lake/lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cookout_mountain_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cookout-mountain/south-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cookout_mountain_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cookout-mountain/south-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cookout_mountain_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cookout-mountain/south-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cookout_mountain_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cookout-mountain/south-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cookout_mountain_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cookout-mountain/south-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_south_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/south-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_south_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/south-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_south_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/south-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_south_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/south-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_south_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/south-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_woods-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/wooded-mount-size-full.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_woods-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/wooded-mount-size-large.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_woods-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/wooded-mount-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_woods-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/wooded-mount-size-small.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_woods-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/wooded-mount-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_slide-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/rock-slide-size-full.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_slide-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/rock-slide-size-large.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_slide-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/rock-slide-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_slide-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/rock-slide-size-small.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_slide-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/rock-slide-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_east_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/north-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_east_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/north-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_east_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/north-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_east_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/north-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_east_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/north-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_west_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/west-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_west_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/west-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_west_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/west-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_west_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/west-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_west_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/west-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_overgrown_top-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/overgrown-peak-size-full.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_overgrown_top-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/overgrown-peak-size-large.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_overgrown_top-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/overgrown-peak-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_overgrown_top-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/overgrown-peak-size-small.jpg'),
			(object) array(
				'pattern' => '@^/haystack_mountain_overgrown_top-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/haystack-mountain/overgrown-peak-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_southern_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-south-shoreline-size-full.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_southern_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-south-shoreline-size-large.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_southern_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-south-shoreline-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_southern_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-south-shoreline-size-small.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_southern_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-south-shoreline-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_western_shoreline-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-west-shoreline-size-full.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_western_shoreline-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-west-shoreline-size-large.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_western_shoreline-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-west-shoreline-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_western_shoreline-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-west-shoreline-size-small.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_western_shoreline-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-west-shoreline-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_hill_western_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-overlook-size-full.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_hill_western_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-overlook-size-large.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_hill_western_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-overlook-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_hill_western_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-overlook-size-small.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_southern_hill_western_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/south-lake-overlook-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_old_cedars_and_swamp_near_mulligan-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/old-cedars-sudden-swamps-size-full.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_old_cedars_and_swamp_near_mulligan-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/old-cedars-sudden-swamps-size-large.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_old_cedars_and_swamp_near_mulligan-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/old-cedars-sudden-swamps-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_old_cedars_and_swamp_near_mulligan-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/old-cedars-sudden-swamps-size-small.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_old_cedars_and_swamp_near_mulligan-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/old-cedars-sudden-swamps-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_largest_looking_south-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/largest-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_largest_looking_south-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/largest-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_largest_looking_south-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/largest-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_largest_looking_south-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/largest-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_largest_looking_south-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/largest-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_small_spooky_pond-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/small-pond-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_small_spooky_pond-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/small-pond-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_small_spooky_pond-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/small-pond-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_small_spooky_pond-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/small-pond-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hills_lake_small_spooky_pond-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hills-lakes/small-pond-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_hill_western_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-overlook-size-full.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_hill_western_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-overlook-size-large.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_hill_western_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-overlook-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_hill_western_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-overlook-size-small.jpg'),
			(object) array(
				'pattern' => '@^/rocking_chair_lakes_northern_hill_western_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/rocking-chair-lakes/north-lake-overlook-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_peak-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/bench-at-peak-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_peak-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/bench-at-peak-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_peak-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/bench-at-peak-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_peak-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/bench-at-peak-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_peak-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/bench-at-peak-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_road_barricade-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/road-barricade-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_road_barricade-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/road-barricade-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_road_barricade-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/road-barricade-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_road_barricade-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/road-barricade-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_road_barricade-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/road-barricade-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/north-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/north-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/north-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/north-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/north-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_pond-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/pond-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_pond-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/pond-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_pond-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/pond-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_pond-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/pond-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mount_arvon_pond-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-arvon/pond-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_sunrise-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/pink-sunrise-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_sunrise-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/pink-sunrise-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_sunrise-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/pink-sunrise-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_sunrise-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/pink-sunrise-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_sunrise-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/pink-sunrise-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_ridgeline_cabin-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/cabin-in-construction-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_ridgeline_cabin-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/cabin-in-construction-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_ridgeline_cabin-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/cabin-in-construction-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_ridgeline_cabin-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/cabin-in-construction-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ravens_nest_ridgeline_cabin-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/ravens-nest/cabin-in-construction-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/howe_lake_and_rush_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/howe-and-rush-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/howe_lake_and_rush_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/howe-and-rush-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/howe_lake_and_rush_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/howe-and-rush-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/howe_lake_and_rush_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/howe-and-rush-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/howe_lake_and_rush_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/howe-and-rush-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/huron_mountain-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/mountain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/huron_mountain-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/mountain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/huron_mountain-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/mountain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/huron_mountain-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/mountain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/huron_mountain-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/huron-mountain/mountain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_logging_operation-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/logging-operation-size-full.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_logging_operation-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/logging-operation-size-large.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_logging_operation-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/logging-operation-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_logging_operation-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/logging-operation-size-small.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_logging_operation-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/logging-operation-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-in-distance-size-full.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-in-distance-size-large.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-in-distance-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-in-distance-size-small.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-in-distance-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_cedar_forest-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/cedar-forest-size-full.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_cedar_forest-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/cedar-forest-size-large.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_cedar_forest-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/cedar-forest-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_cedar_forest-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/cedar-forest-size-small.jpg'),
			(object) array(
				'pattern' => '@^/burnt_mountain_south_cedar_forest-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/cedar-forest-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/canyon_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/canyon-lake/lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/canyon_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/canyon-lake/lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/canyon_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/canyon-lake/lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/canyon_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/canyon-lake/lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/canyon_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/canyon-lake/lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mountain_lake_from_burnt_mountain-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-lake-in-distance-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mountain_lake_from_burnt_mountain-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-lake-in-distance-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mountain_lake_from_burnt_mountain-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-lake-in-distance-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mountain_lake_from_burnt_mountain-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-lake-in-distance-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mountain_lake_from_burnt_mountain-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/burnt-mountain/mountain-lake-in-distance-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ishpeming_power_lines-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/power-lines-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ishpeming_power_lines-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/power-lines-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ishpeming_power_lines-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/power-lines-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ishpeming_power_lines-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/power-lines-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ishpeming_power_lines-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/power-lines-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls_footpath-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/hunting-footpath-size-full.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls_footpath-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/hunting-footpath-size-large.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls_footpath-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/hunting-footpath-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls_footpath-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/hunting-footpath-size-small.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls_footpath-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/hunting-footpath-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/carp_river_near_nealy_creek-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/carp-river-size-full.jpg'),
			(object) array(
				'pattern' => '@^/carp_river_near_nealy_creek-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/carp-river-size-large.jpg'),
			(object) array(
				'pattern' => '@^/carp_river_near_nealy_creek-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/carp-river-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/carp_river_near_nealy_creek-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/carp-river-size-small.jpg'),
			(object) array(
				'pattern' => '@^/carp_river_near_nealy_creek-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/carp-river-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/nealy_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/nealy-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_bear-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/bear-cub-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_bear-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/bear-cub-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_bear-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/bear-cub-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_bear-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/bear-cub-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_bear-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/bear-cub-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_charging_bear-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/charging-bear-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_charging_bear-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/charging-bear-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_charging_bear-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/charging-bear-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_charging_bear-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/charging-bear-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_charging_bear-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/charging-bear-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_northern_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-trout-river-bends-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_northern_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-trout-river-bends-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_northern_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-trout-river-bends-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_northern_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-trout-river-bends-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_northern_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-trout-river-bends-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_living_room-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/living-room-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_living_room-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/living-room-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_living_room-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/living-room-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_living_room-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/living-room-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_living_room-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/living-room-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_kitchen-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/kitchen-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_kitchen-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/kitchen-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_kitchen-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/kitchen-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_kitchen-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/kitchen-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_kitchen-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/kitchen-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_office-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/office-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_office-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/office-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_office-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/office-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_office-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/office-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wheatfield_duplex_office-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wheatfield-duplex/office-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/pinnacle-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/pinnacle-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/pinnacle-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/pinnacle-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/pinnacle_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/pinnacle-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_snowy-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snow-covered-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_snowy-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snow-covered-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_snowy-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snow-covered-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_snowy-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snow-covered-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_snowy-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snow-covered-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_frozen_little_huron_river-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/frozen-little-huron-river-size-full.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_frozen_little_huron_river-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/frozen-little-huron-river-size-large.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_frozen_little_huron_river-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/frozen-little-huron-river-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_frozen_little_huron_river-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/frozen-little-huron-river-size-small.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_frozen_little_huron_river-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/frozen-little-huron-river-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_view_of_largest_peak-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-eastern-peak-size-full.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_view_of_largest_peak-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-eastern-peak-size-large.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_view_of_largest_peak-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-eastern-peak-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_view_of_largest_peak-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-eastern-peak-size-small.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_view_of_largest_peak-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-eastern-peak-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_western_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-view-west-size-full.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_western_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-view-west-size-large.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_western_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-view-west-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_western_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-view-west-size-small.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_western_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-view-west-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_limited_view_of_superior-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-superior-mountain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_limited_view_of_superior-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-superior-mountain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_limited_view_of_superior-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-superior-mountain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_limited_view_of_superior-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-superior-mountain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_limited_view_of_superior-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/snowy-superior-mountain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_small_eastern_outcropping-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-to-small-outcropping-size-full.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_small_eastern_outcropping-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-to-small-outcropping-size-large.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_small_eastern_outcropping-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-to-small-outcropping-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_small_eastern_outcropping-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-to-small-outcropping-size-small.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_small_eastern_outcropping-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-to-small-outcropping-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_eastern_slope-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-face-size-full.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_eastern_slope-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-face-size-large.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_eastern_slope-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-face-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_eastern_slope-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-face-size-small.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_eastern_slope-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/east-face-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_cliff_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/hills-around-cliff-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_cliff_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/hills-around-cliff-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_cliff_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/hills-around-cliff-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_cliff_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/hills-around-cliff-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/tick_mountain_snowy_cliff_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/tick-mountain/hills-around-cliff-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_icy_gorge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/icy-gorge-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_icy_gorge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/icy-gorge-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_icy_gorge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/icy-gorge-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_icy_gorge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/icy-gorge-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_icy_gorge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/icy-gorge-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_southern_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/looking-south-size-full.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_southern_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/looking-south-size-large.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_southern_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/looking-south-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_southern_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/looking-south-size-small.jpg'),
			(object) array(
				'pattern' => '@^/mt_benison_southern_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-benison/looking-south-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_abandoned_jeep-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/abandoned-car-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_abandoned_jeep-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/abandoned-car-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_abandoned_jeep-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/abandoned-car-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_abandoned_jeep-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/abandoned-car-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_abandoned_jeep-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/abandoned-car-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_northwest_cliffs-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snowy-northwest-cliffs-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_northwest_cliffs-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snowy-northwest-cliffs-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_northwest_cliffs-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snowy-northwest-cliffs-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_northwest_cliffs-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snowy-northwest-cliffs-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_northwest_cliffs-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/snowy-northwest-cliffs-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_western_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/west-from-outcropping-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_western_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/west-from-outcropping-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_western_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/west-from-outcropping-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_western_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/west-from-outcropping-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cliff_lake_western_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cliff-lake/west-from-outcropping-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_east_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-from-lake-three-cliffs-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_east_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-from-lake-three-cliffs-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_east_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-from-lake-three-cliffs-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_east_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-from-lake-three-cliffs-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_east_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/east-from-lake-three-cliffs-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_northeast_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/view-from-lake-three-cliffs-size-full.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_northeast_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/view-from-lake-three-cliffs-size-large.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_northeast_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/view-from-lake-three-cliffs-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_northeast_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/view-from-lake-three-cliffs-size-small.jpg'),
			(object) array(
				'pattern' => '@^/clark_creek_foggy_northeast_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/clark-creek-valley/view-from-lake-three-cliffs-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_east_end-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-overlook-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_east_end-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-overlook-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_east_end-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-overlook-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_east_end-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-overlook-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_east_end-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-overlook-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_end-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_end-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_end-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_end-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_end-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_lakeshore-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-shoreline-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_lakeshore-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-shoreline-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_lakeshore-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-shoreline-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_lakeshore-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-shoreline-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_north_lakeshore-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-shoreline-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_outlet-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-outlet-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_outlet-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-outlet-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_outlet-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-outlet-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_outlet-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-outlet-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_2_outlet-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-two-outlet-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_east_end-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_east_end-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_east_end-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_east_end-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_east_end-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_overflow_waterfall-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-waterfall-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_overflow_waterfall-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-waterfall-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_overflow_waterfall-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-waterfall-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_overflow_waterfall-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-waterfall-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_3_overflow_waterfall-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/lake-three-waterfall-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cabin-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cabin-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cabin-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cabin-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cabin-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/view-from-cabin-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/view-from-cabin-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/view-from-cabin-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/view-from-cabin-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_cabin_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/view-from-cabin-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_north_end-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/rainy-north-side-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_north_end-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/rainy-north-side-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_north_end-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/rainy-north-side-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_north_end-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/rainy-north-side-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lake_8_north_end-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/rainy-north-side-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_large_cedar-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cedar-forest-size-full.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_large_cedar-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cedar-forest-size-large.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_large_cedar-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cedar-forest-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_large_cedar-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cedar-forest-size-small.jpg'),
			(object) array(
				'pattern' => '@^/peshekee_large_cedar-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lake-8/cedar-forest-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_trail-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trail-fork-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_trail-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trail-fork-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_trail-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trail-fork-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_trail-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trail-fork-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_trail-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trail-fork-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_west-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trap-hills-to-the-west-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_west-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trap-hills-to-the-west-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_west-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trap-hills-to-the-west-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_west-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trap-hills-to-the-west-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_west-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/trap-hills-to-the-west-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_south-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/south-towards-ontonagon-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_south-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/south-towards-ontonagon-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_south-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/south-towards-ontonagon-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_south-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/south-towards-ontonagon-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_bluff_south-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/south-towards-ontonagon-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_wooded_trail-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/wooded-trail-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_wooded_trail-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/wooded-trail-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_wooded_trail-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/wooded-trail-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_wooded_trail-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/wooded-trail-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls_wooded_trail-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/wooded-trail-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/cascade_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/cascade-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_east-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-size-full.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_east-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-size-large.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_east-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_east-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-size-small.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_east-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_west-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-westwards-size-full.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_west-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-westwards-size-large.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_west-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-westwards-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_west-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-westwards-size-small.jpg'),
			(object) array(
				'pattern' => '@^/coles_creek_outcropping_looking_west-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/coles-creek-outcropping-westwards-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southwest_campsite-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/campsite-on-southwest-shore-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southwest_campsite-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/campsite-on-southwest-shore-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southwest_campsite-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/campsite-on-southwest-shore-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southwest_campsite-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/campsite-on-southwest-shore-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_southwest_campsite-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/campsite-on-southwest-shore-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_wildcat_canyon-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/wildcat-canyon-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_wildcat_canyon-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/wildcat-canyon-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_wildcat_canyon-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/wildcat-canyon-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_wildcat_canyon-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/wildcat-canyon-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lake_basin_wildcat_canyon-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/wildcat-canyon-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_outlet-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/outlet-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_outlet-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/outlet-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_outlet-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/outlet-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_outlet-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/outlet-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_outlet-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/outlet-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_shaft-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/gated-shaft-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_shaft-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/gated-shaft-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_shaft-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/gated-shaft-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_shaft-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/gated-shaft-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_shaft-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/gated-shaft-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/lower-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/lower-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/lower-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/lower-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/silver_lead_mine_lake_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lead-mine-lakes/lower-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_lower_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/lower-drops-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_lower_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/lower-drops-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_lower_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/lower-drops-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_lower_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/lower-drops-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_lower_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/lower-drops-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_middle_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/middle-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_middle_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/middle-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_middle_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/middle-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_middle_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/middle-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_middle_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/middle-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_rim_towards_silver_lake_basin-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/cliffs-above-wildcat-canyon-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_rim_towards_silver_lake_basin-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/cliffs-above-wildcat-canyon-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_rim_towards_silver_lake_basin-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/cliffs-above-wildcat-canyon-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_rim_towards_silver_lake_basin-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/cliffs-above-wildcat-canyon-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_rim_towards_silver_lake_basin-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/silver-lake-basin/cliffs-above-wildcat-canyon-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_swamp-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-swamp-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_swamp-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-swamp-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_swamp-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-swamp-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_swamp-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-swamp-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wildcat_canyon_upper_swamp-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wildcat-canyon-falls/upper-swamp-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/gleason_two_track-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/two-track-size-full.jpg'),
			(object) array(
				'pattern' => '@^/gleason_two_track-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/two-track-size-large.jpg'),
			(object) array(
				'pattern' => '@^/gleason_two_track-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/two-track-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/gleason_two_track-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/two-track-size-small.jpg'),
			(object) array(
				'pattern' => '@^/gleason_two_track-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/two-track-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/gleason_falls-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/gleason_falls-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/gleason_falls-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/gleason_falls-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/gleason_falls-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/gleason-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_view_from_logging_road-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/view-from-gleason-logging-road-size-full.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_view_from_logging_road-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/view-from-gleason-logging-road-size-large.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_view_from_logging_road-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/view-from-gleason-logging-road-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_view_from_logging_road-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/view-from-gleason-logging-road-size-small.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_view_from_logging_road-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/view-from-gleason-logging-road-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_gated_shaft-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/gated-shaft-size-full.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_gated_shaft-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/gated-shaft-size-large.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_gated_shaft-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/gated-shaft-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_gated_shaft-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/gated-shaft-size-small.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_gated_shaft-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/gated-shaft-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_misty_trees-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/misty-trees-to-the-south-size-full.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_misty_trees-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/misty-trees-to-the-south-size-large.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_misty_trees-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/misty-trees-to-the-south-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_misty_trees-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/misty-trees-to-the-south-size-small.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_misty_trees-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/misty-trees-to-the-south-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_eastern_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-east-size-full.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_eastern_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-east-size-large.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_eastern_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-east-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_eastern_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-east-size-small.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_eastern_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-east-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_western_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-west-size-full.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_western_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-west-size-large.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_western_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-west-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_western_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-west-size-small.jpg'),
			(object) array(
				'pattern' => '@^/norwich_bluff_western_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/norwich-bluff/foggy-view-west-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_wetmore_beach-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/north-towards-little-presque-isle-size-full.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_wetmore_beach-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/north-towards-little-presque-isle-size-large.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_wetmore_beach-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/north-towards-little-presque-isle-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_wetmore_beach-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/north-towards-little-presque-isle-size-small.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_wetmore_beach-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/north-towards-little-presque-isle-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_trail_stairs-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/stairs-up-the-mountain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_trail_stairs-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/stairs-up-the-mountain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_trail_stairs-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/stairs-up-the-mountain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_trail_stairs-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/stairs-up-the-mountain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_trail_stairs-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/stairs-up-the-mountain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_marquette-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/middle-island-to-the-south-size-full.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_marquette-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/middle-island-to-the-south-size-large.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_marquette-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/middle-island-to-the-south-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_marquette-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/middle-island-to-the-south-size-small.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_marquette-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/middle-island-to-the-south-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_hogback-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/hogback-mountain-to-the-east-size-full.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_hogback-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/hogback-mountain-to-the-east-size-large.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_hogback-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/hogback-mountain-to-the-east-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_hogback-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/hogback-mountain-to-the-east-size-small.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_towards_hogback-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/hogback-mountain-to-the-east-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_northern_flank-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/woods-on-north-flank-size-full.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_northern_flank-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/woods-on-north-flank-size-large.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_northern_flank-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/woods-on-north-flank-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_northern_flank-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/woods-on-north-flank-size-small.jpg'),
			(object) array(
				'pattern' => '@^/sugarloaf_mountain_northern_flank-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/sugarloaf-mountain/woods-on-north-flank-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_waves_against_black_rocks-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/waves-against-black-rocks-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_waves_against_black_rocks-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/waves-against-black-rocks-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_waves_against_black_rocks-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/waves-against-black-rocks-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_waves_against_black_rocks-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/waves-against-black-rocks-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_waves_against_black_rocks-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/waves-against-black-rocks-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_presque_isle-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/looking-south-to-middle-island-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_presque_isle-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/looking-south-to-middle-island-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_presque_isle-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/looking-south-to-middle-island-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_presque_isle-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/looking-south-to-middle-island-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_presque_isle-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/looking-south-to-middle-island-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_shelter-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/makeshift-shelter-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_shelter-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/makeshift-shelter-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_shelter-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/makeshift-shelter-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_shelter-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/makeshift-shelter-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_shelter-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/makeshift-shelter-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_sandy_cove-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sandy-cove-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_sandy_cove-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sandy-cove-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_sandy_cove-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sandy-cove-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_sandy_cove-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sandy-cove-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_sandy_cove-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sandy-cove-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_cloudy_waves-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sugarloaf-mountain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_cloudy_waves-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sugarloaf-mountain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_cloudy_waves-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sugarloaf-mountain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_cloudy_waves-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sugarloaf-mountain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_cloudy_waves-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/sugarloaf-mountain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_north-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/north-towards-little-presque-isle-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_north-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/north-towards-little-presque-isle-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_north-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/north-towards-little-presque-isle-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_north-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/north-towards-little-presque-isle-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_beach_towards_north-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-beach/north-towards-little-presque-isle-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_two_bridge_trail-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/harlow-lake/two-bridge-trail-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_two_bridge_trail-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/harlow-lake/two-bridge-trail-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_two_bridge_trail-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/harlow-lake/two-bridge-trail-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_two_bridge_trail-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/harlow-lake/two-bridge-trail-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_two_bridge_trail-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/harlow-lake/two-bridge-trail-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_grade_waterfall-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/potluck-falls/falls-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_grade_waterfall-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/potluck-falls/falls-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_grade_waterfall-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/potluck-falls/falls-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_grade_waterfall-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/potluck-falls/falls-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_grade_waterfall-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/potluck-falls/falls-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_pine_trail-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/pine-trail-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_pine_trail-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/pine-trail-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_pine_trail-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/pine-trail-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_pine_trail-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/pine-trail-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_pine_trail-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/pine-trail-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_towards_sugarloaf-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/east-to-sugarloaf-mountain-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_towards_sugarloaf-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/east-to-sugarloaf-mountain-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_towards_sugarloaf-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/east-to-sugarloaf-mountain-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_towards_sugarloaf-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/east-to-sugarloaf-mountain-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_towards_sugarloaf-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/east-to-sugarloaf-mountain-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_looking_west-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/peak-outcroppings-size-full.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_looking_west-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/peak-outcroppings-size-large.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_looking_west-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/peak-outcroppings-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_looking_west-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/peak-outcroppings-size-small.jpg'),
			(object) array(
				'pattern' => '@^/hogsback_mountain_looking_west-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/hogback-mountain/peak-outcroppings-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_first_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/first-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_first_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/first-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_first_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/first-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_first_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/first-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_first_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/first-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_outcroppings-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/outcroppings-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_outcroppings-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/outcroppings-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_outcroppings-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/outcroppings-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_outcroppings-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/outcroppings-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_outcroppings-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/outcroppings-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_flooded_railroad_grade-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/flooded-railroad-grade-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_flooded_railroad_grade-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/flooded-railroad-grade-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_flooded_railroad_grade-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/flooded-railroad-grade-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_flooded_railroad_grade-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/flooded-railroad-grade-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_flooded_railroad_grade-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/flooded-railroad-grade-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_southern_swamp-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/south-swamp-size-full.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_southern_swamp-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/south-swamp-size-large.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_southern_swamp-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/south-swamp-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_southern_swamp-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/south-swamp-size-small.jpg'),
			(object) array(
				'pattern' => '@^/wetmore_pond_southern_swamp-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/wetmore-pond/south-swamp-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_sunset_over_ives_lake-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/sunset-over-ives-lake-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_sunset_over_ives_lake-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/sunset-over-ives-lake-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_sunset_over_ives_lake-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/sunset-over-ives-lake-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_sunset_over_ives_lake-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/sunset-over-ives-lake-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_sunset_over_ives_lake-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/sunset-over-ives-lake-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_fall_logging_road-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/logging-road-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_fall_logging_road-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/logging-road-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_fall_logging_road-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/logging-road-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_fall_logging_road-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/logging-road-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_fall_logging_road-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/logging-road-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_small_creek-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/small-creek-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_small_creek-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/small-creek-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_small_creek-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/small-creek-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_small_creek-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/small-creek-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_small_creek-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/small-creek-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunset-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-in-the-sunset-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunset-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-in-the-sunset-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunset-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-in-the-sunset-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunset-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-in-the-sunset-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunset-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-in-the-sunset-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_ives_lake_ives_hill-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-hill-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_ives_lake_ives_hill-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-hill-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_ives_lake_ives_hill-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-hill-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_ives_lake_ives_hill-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-hill-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_ives_lake_ives_hill-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-hill-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_southern_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/florence-pond-sunset-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_southern_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/florence-pond-sunset-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_southern_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/florence-pond-sunset-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_southern_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/florence-pond-sunset-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_southern_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/florence-pond-sunset-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunset-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunset-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunset-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunset-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunset-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunset-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunset-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunset-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunset-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunset-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_lake_superior-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/superior-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_lake_superior-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/superior-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_lake_superior-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/superior-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_lake_superior-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/superior-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_lake_superior-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/superior-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunrise-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunrise-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunrise-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunrise-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunrise-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunrise-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunrise-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunrise-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_homer_sunrise-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/mount-homer-sunrise-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunrise-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-sunrise-size-full.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunrise-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-sunrise-size-large.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunrise-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-sunrise-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunrise-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-sunrise-size-small.jpg'),
			(object) array(
				'pattern' => '@^/ives_area_mount_ives_sunrise-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/mount-ives/ives-sunrise-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_poor_rock_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/view-from-victoria-poor-rock-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_poor_rock_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/view-from-victoria-poor-rock-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_poor_rock_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/view-from-victoria-poor-rock-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_poor_rock_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/view-from-victoria-poor-rock-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_poor_rock_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/view-from-victoria-poor-rock-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_north_country_trail_sign-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-sign-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_north_country_trail_sign-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-sign-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_north_country_trail_sign-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-sign-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_north_country_trail_sign-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-sign-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_north_country_trail_sign-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-sign-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_path-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_path-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_path-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_path-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_path-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/north-country-trail-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior_and_dam-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-and-dam-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior_and_dam-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-and-dam-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior_and_dam-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-and-dam-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior_and_dam-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-and-dam-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lookout_mountain_victoria_reservior_and_dam-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lookout-mountain/victoria-reservoir-and-dam-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_eastern_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/east-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_eastern_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/east-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_eastern_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/east-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_eastern_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/east-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_eastern_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/east-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_western_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/view-west-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_western_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/view-west-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_western_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/view-west-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_western_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/view-west-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_western_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/view-west-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_salmon_river_valley-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-river-valley-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_salmon_river_valley-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-river-valley-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_salmon_river_valley-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-river-valley-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_salmon_river_valley-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-river-valley-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_salmon_river_valley-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/salmon-river-valley-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_keweenaw_peninsula_window-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/keweenaw-peninsula-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_keweenaw_peninsula_window-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/keweenaw-peninsula-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_keweenaw_peninsula_window-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/keweenaw-peninsula-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_keweenaw_peninsula_window-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/keweenaw-peninsula-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_keweenaw_peninsula_window-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/keweenaw-peninsula-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_high_southern_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/clear-creek-valley-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_high_southern_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/clear-creek-valley-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_high_southern_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/clear-creek-valley-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_high_southern_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/clear-creek-valley-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_high_southern_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/clear-creek-valley-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_sunset_view-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-sunset-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_sunset_view-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-sunset-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_sunset_view-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-sunset-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_sunset_view-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-sunset-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_sunset_view-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-hills-sunset-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view_morning-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/cloudy-south-view-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view_morning-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/cloudy-south-view-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view_morning-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/cloudy-south-view-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view_morning-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/cloudy-south-view-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_southern_view_morning-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/cloudy-south-view-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_snake_creek_bridge-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-bridge-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_snake_creek_bridge-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-bridge-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_snake_creek_bridge-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-bridge-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_snake_creek_bridge-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-bridge-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_snake_creek_bridge-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/snake-creek-bridge-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_huron_mountain_club-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/huron-mountain-club-property-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_huron_mountain_club-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/huron-mountain-club-property-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_huron_mountain_club-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/huron-mountain-club-property-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_huron_mountain_club-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/huron-mountain-club-property-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_huron_mountain_club-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/huron-mountain-club-property-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_pine_forest-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/pine-forest-size-full.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_pine_forest-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/pine-forest-size-large.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_pine_forest-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/pine-forest-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_pine_forest-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/pine-forest-size-small.jpg'),
			(object) array(
				'pattern' => '@^/blind_35_hills_pine_forest-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/blind-35-hills/pine-forest-size-thumb.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls_jake_and_kate-sxlarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/jake-and-katie-size-full.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls_jake_and_kate-slarge.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/jake-and-katie-size-large.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls_jake_and_kate-smedium.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/jake-and-katie-size-medium.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls_jake_and_kate-ssmall.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/jake-and-katie-size-small.jpg'),
			(object) array(
				'pattern' => '@^/lower_silver_falls_jake_and_kate-sthumb.jpg$@',
				'replace' => 'http://blog.jacobemerick.com/photo/lower-silver-falls/jake-and-katie-size-thumb.jpg'));
	}

	protected function get_direct_array()
	{
		return array(
			(object) array(
				'match' => '/([a-z0-9-_\.\/]+).gif',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/([a-z]+).ico',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/([a-z0-9-_\.\/]+).jpg',
				'controller' => 'HomeController'),
			(object) array(
				'match' => '/([a-z0-9-_\.\/]+).png',
				'controller' => 'HomeController'));
	}

}