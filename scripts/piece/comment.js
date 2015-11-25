var Comment = new function() {

	var newComment = '.comment-new';
	var replyComment = '.comment-reply';
	var hideComment = '.comment-hide';
	var commentType = '';

	var form = '#comment-form';
	var name = '#comment-form [name=name]';
	var email = '#comment-form [name=email]';
	var website = '#comment-form [name=website]';
	var comment = '#comment-form [name=comment]';
	var save = '#comment-form [name=save]';
	var notify = '#comment-form [name=notify]';

	var submit = '#comment-form [type=submit]';
	var reset = '#comment-form [type=reset]';

	this.init = function() {
		$(form).hide();
		this.attachFormDisplayEvents();}

	this.attachFormDisplayEvents = function() {
		$(newComment + ', ' + replyComment).live('click', function() {
			var listElem = $(this).closest('li');
			if(listElem.find(form).length == 0)
			{
				$(form).slideUp('normal', function() {
					listElem.append($(form));
					$(form).slideDown();});
			}
			else
				$(form).slideDown();
			$(this).hide();
			$(this).after('<a class="comment-hide faux_link">Close Form</span>');});
		$(hideComment + ', ' + reset).live('click', function() {
			$(form).slideUp();
			$(newComment + ', ' + replyComment).show();
			$(hideComment).remove();});
		$(submit).live('click', this.submitComment);}

	this.submitComment = function() {
		$.post(
			'/submit/comment.json',
			{
				name: $(name).val(),
				email: $(email).val(),
				website: $(website).val(),
				comment: $(comment).val(),
				save: $(save).is(':checked'),
				notify: $(notify).is(':checked'),
				reply: $(this).closest(form).closest('li').find(replyComment).attr('rel')
			},
			function(data) {
				if(data.internal == 'success')
					location.reload();
				else
					alert(data.error);});
		return false;}}();

$(function() {
	Comment.init();});
