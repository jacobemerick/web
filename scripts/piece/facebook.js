/*
$(function() {
	window.fbAsyncInit = function() {
		FB.init({
			appId: '108421029220498',
			status: true,
			cookie: true,
			xfbml: true
		});
	};
});
*/
$(function() {
FB.init({
	appId: '108421029220498',
	status: true,
	cookie: true,
	xfbml: true
});

FB.Event.subscribe(
	'auth.sessionChange',
	function(response) {
		if (response.session) {
			// A user has logged in, and a new cookie has been saved
		} else {
			// The user has logged out, and the cookie has been cleared
		}
	}
);
});