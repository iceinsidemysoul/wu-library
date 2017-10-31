// class Timeline
// {

// 		constructor(current_year, year_lists) {
// 			this.current_year = current_year;
// 			this.year_lists = year_lists;
// 			// this.year_lists_position = getTopPosition(this.year_lists);
// 			this.position_of_first_content_at_year = 0;
// 			this.window_y_position = 0;
// 		}
// 		// input jquery object
// 		setTopPosition(item) {

// 		}

// 		getTopPosition(item) {
// 			var h = item.height();
// 			var top = item.offset().top;
// 			return top - (h/2);
// 		}

// 		showContentOfCurrentYear(){
// 			// window.scrollTo(0, position_of_first_content_at_year[current_year]) = position(year_lists_position[current_year]);
// 		}
// }

// import axios from 'axios';

// var current_year = 2560;
// var year_lists = document.getElementsByClassName('year');
// var year_lists_position = [];


// let timeLiner = new Timeline(current_year, year_lists);

$(document).ready(function(){
	$('#draggable').draggable({
			axis: 'y',
			containment: '.timeline',
			start: function(){
				// get current position of each year
				// get current position of pointer 
			},
			drag: function(){
				// get the adjoining year to check
				// 1st way
				// check if drag more than previous year then - year on pointer 
				// or if drag pass than next year then + year on pointer
				// ******************
				// 2nd way
				// 
				// ****************
				// after change the year get the adjoining year again
			},
			stop: function(){
				// after drag done, pull pointer to the current year
				// then scroll to the point of first post of current year
			}			
	});
});

