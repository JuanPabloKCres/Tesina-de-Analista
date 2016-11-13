<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-65677009-1', 'auto');
	ga('send', 'pageview');


	<!--Script para que el mapa no tenga zoom-->
	var map;

	function load() {
		if (GBrowserIsCompatible()) {
			map = new GMap2(document.getElementById("map"));
			map.setCenter(new GLatLng(10.014714, 76.343836), 13);
			document.getElementById("map").checked = true;
			toggleZoom(false);
		}
	}

	function toggleZoom(isChecked) {
		if (isChecked) {
			map.enableScrollWheelZoom();
		} else {
			map.disableScrollWheelZoom();
		}
	}
</script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{asset('plantillas/Avada/assets/js/jquery-2.1.3.min.js') }}"> </script>
<script src="{{asset('plantillas/Avada/assets/js/bootstrap.js')}}"></script>
<script src="{{asset('plantillas/Avada/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plantillas/Avada/assets/js/jquery.actual.min.js')}}"></script>
<script src="{{asset('plantillas/Avada/assets/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('plantillas/Avada/assets/js/contact.js')}}"></script>
<script src="{{asset('plantillas/Avada/assets/js/script.js')}}"></script>
<script src="{{asset('plantillas/Avada/assets/js/smoothscroll.js')}}"></script>


<script src="{{ asset('plantillas/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('plantillas/bootstrap-select/js/bootstrap-select.min.js') }}"></script>


<script src="{{ asset('js/busquedaFront.js') }}"></script>



