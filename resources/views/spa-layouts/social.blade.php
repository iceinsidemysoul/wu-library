<div class="social-share" id="social-tab">
	<div class="table-responsive">
		<table class="table">
			<tr>
				<td class="p-2 facebook-share" back>
					<div class="social-default fb-share-button mb-2" data-href="/" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="/">Share</a></div>
				</td>
				<td class="p-2">
					<!-- Place this tag where you want the share button to render. -->
					<div class="g-plus social-default " data-action="share" data-href="/" data-height="30"></div>	
				</td>
				<td class="p-2">
					<a class="twitter-share-button social-default"
					  href="/"
					  data-size="large">
					Tweet</a>
				</td>
			</tr>
		</table>
	</div>
</div>

<script>
	(function () {
		window.addEventListener('scroll', function(e) {
			let y = window.pageYOffset;

			if (y > 150) {
				document.getElementById('social-tab').className = "social-share half-faded";
			} else if (y < 150) {
				document.getElementById('social-tab').className = "social-share";
			}

		});

	})();
</script>