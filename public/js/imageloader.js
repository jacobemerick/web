$(function() {
  var loading = '.loading';
  $('body').bind('loadingImage', function () {
    $(loading).each(function() {
      $(this).find('img').css('margin-left', '-5000px');
      $(this).css('height', $(this).find('img').attr('height') + 'px').css('width', $(this).find('img').attr('width') + 'px');
      $(this).find('img').load(function() {
        $(this).css('margin-left', 0);
        $(this).fadeIn('normal');
        $(this).closest(loading).css('height', $(this).attr('height') + 'px').css('width', $(this).attr('width') + 'px');
      });
    });
  });
});
