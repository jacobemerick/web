var Login = new function() {

	var signIn = '#submit_sign_in';
	var signOut = '#sign_out';

	var username = '#login_form [name=username]';
	var faux_password = '#login_form [name=faux_password]';
	var password = '#login_form [name=password]';

	var login_form = '#login_form';
	var display_login = '#display_login';
	var hide_login = '#cancel_sign_in';

	this.init = function() {
		this.attachSignIn();
		this.attachSignOut();
		this.prepareInputs();
		this.prepareSignInForm();}

	this.attachSignIn = function() {
		$(signIn).live('click', function() {
			$.post(
				'/signIn/user.json',
				{username : $(username).val(), password : $(password).val()},
				function(data) {
					if(data.internal == 'success')
						location.reload();
					else
						alert('Sorry, your login was not succesful.');},
				'json');});}

	this.attachSignOut = function() {
		$(signOut).live('click', function() {
			$.post(
				'/signOut/user.json',
				{},
				function(data) {
					if(data.internal == 'success')
						location.reload();
					else
						alert('Sorry, your logout was not succesful.');},
				'json');});}

	this.prepareInputs = function() {
		$(password).hide();
		$(username).hint();
		$(faux_password).hint();
		$(faux_password).focus(function() {
			$(this).hide();
			$(password).show().focus();});
		$(password).blur(function() {
			if(this.value === '') {
				$(password).hide();
				$(faux_password).show().blur();}});}

	this.prepareSignInForm = function() {
		$(login_form).hide();
		$(display_login).click(function() {
			$(login_form).fadeIn();});
		$(hide_login).click(function() {
			$(login_form).fadeOut();});}}();

$(function() {
	Login.init();});
