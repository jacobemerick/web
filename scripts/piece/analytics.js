var Track = new function() {

	var key = 'UA-11745070-1';
	var domain = '.jacobemerick.com';
	var track = _gat._getTracker(key);

	this.pageview = function() {
		try {
			track._setDomainName(domain);
			track._trackPageview();}
		catch(err) {}}

	this.action = function(category, action, label) {
			try {
				track._trackEvent(category, action, label);}
			catch(err) {}}}();

$(function() {
	Track.pageview();});