import axios from 'axios';

// for pointer movement
var current_year = $('.year:eq(0)');
var year_lists = $('.year');
var years_position = [];
var pointer = $('.pointer');
// ***************

// for page scrolled
var page_top_position = 0;
var first_post_for_each_year = [];
// ********************

$(document).ready(function(){

	getYearsPosition();
	setCurrentYearStyle();

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

	// when user scroll the page
	// detect height and 
});

function getYearsPosition()
{
		$.each(year_lists, function (k, v){
			years_position[k] = getPositionOfCenter(v);
		});
}

function getPositionOfCenter(obj)
{
	var h = $(obj).outerHeight();
	var top = $(obj).offset().top;

	return top+h/2;
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
	$(pointer).offset({left: x, top: t-h/2});
}

function setCurrentYearStyle()
{
	$('.year').removeClass('current');
	$(current_year).addClass('current');
	setPointerToClosestYear();
}

function scrollToCurrentYearPost()
{

}