<template>

	<div class="pointer text-center" id="draggable"></div>

</template>

<script>
	require('jquery-ui');
	export default {
		data() {
			return {
				current_year: '',
				year_lists: '',
				years_position: [],
				pointer: ''
			};
		},
		mounted() {
			this.setUp();
		},
		methods: {
			setUp: function (){
				setTimeout(function() {
					var current_year = $('.year:eq(0)');
					var year_lists = $('.year');
					var years_position = [];
					var pointer = $('.pointer');
					getYearsPosition();
					$('.pointer').text($(current_year).prop('title'));

					$('#draggable').draggable({
						axis: 'y',
						containment: '.timeline',
						start: function(){
							getYearsPosition();
							var pointer_position = getPositionOfCenter(pointer);
						},
						drag: function(){
							findClosestYear();
							$(pointer).text($(current_year).prop('title'));
						},
						stop: function(){
							setPointerToClosestYear();
							// set style for current year
							setCurrentYearStyle();
							// TODO:: then scroll to the point of first post of current year
						}
					});

					function getYearsPosition (){
						$.each(year_lists, function(k, v){
							years_position[k] = getPositionOfCenter(v);
						});
					}

					function getPositionOfCenter(obj) {
						let h = $(obj).outerHeight();
						let t = $(obj).position().top;

						return t+(h/2);
					}

					function findClosestYear()
					{
						var current_pointer_position = getPositionOfCenter(pointer);
						getYearsPosition();
						if (current_pointer_position < years_position[0]) return 0;
						else if (current_pointer_position > years_position[years_position.length-1]) return (years_position.length-1);
						for (var i = 0; i < years_position.length-1; i++)
						{
							if (current_pointer_position > years_position[i] && current_pointer_position < years_position[i+1]){
								if ((current_pointer_position - years_position[i]) <  (years_position[i+1]-current_pointer_position)){
									current_year = $('.year:eq('+i+')');
								} else {
									current_year = $('.year:eq('+(i+1)+')');
								}
								break;
							}
						}
					}

					function setPointerToClosestYear()
					{
						var x = $(pointer).offset().left;
						var h = $(pointer).outerHeight();
						var t = getPositionOfCenter($(current_year));
						console.log(t);
						console.log(t-h/2);
						$(pointer).offset({left: x, top: t-h/2});
					}

					function setCurrentYearStyle()
					{
						$('.year').removeClass('current');
						$(current_year).addClass('current');
						setPointerToClosestYear();
					}
				}, 1);
			},
		}
	}


</script>