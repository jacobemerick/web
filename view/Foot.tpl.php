	</body>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '<?= $tracking_code ?>']);
		_gaq.push(['_setDomainName', 'jacobemerick.com']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = 'http://www.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
	</script>
</html>