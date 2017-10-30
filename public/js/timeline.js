let year = $('.year');  
let year_position_y = [];  

$(document).ready(function(){
    $.each(year, function (k,v){
        // alert(v);
        year_position_y.push(get_y_of_obj(v));
    });
    console.log(year_position_y);
    console.log(get_y_of_obj($('.pointer')));
    $('#draggable').draggable({ 
        axis: "y",
        containment: ".timeline",
        // grid: [20,26],
        start: function() {

        },
        stop: function() {
            var current_y = get_y_of_obj($(this));
            console.log(current_y);
            var to_year = find_nearest_year(current_y);
            // alert (to_year);
            console.log(year_position_y[to_year]);
            // var target = get_y_of_obj(year_position_y[to_year]);
            // console.log(target);
            set_obj_to_y($(this), year_position_y[to_year]-15);
            console.log(get_y_of_obj($(this)));
        }
    });
});

function find_nearest_year(position)
{
    //find the nearest point of
    var last_key = year_position_y.length-1;
    var first_year_y = year_position_y[0];
    var last_year_y = year_position_y[last_key];
    var nearest_year;
    if (position < first_year_y)
    {
        return 0;
    } else if (position > last_year_y) {
        return last_key;
    }
    $.each(year_position_y, function (k, v){
        if (k < last_key){
            if (position >= year_position_y[k] && position <= year_position_y[k+1]){
                // console.log(year_position_y[k]);
                // console.log(position);
                // console.log(year_position_y[k+1]);
                if ((position - year_position_y[k]) > (year_position_y[k+1] - position)){
                    nearest_year = k+1;
                    return false;
                } else {
                    nearest_year = k;
                    return false;
                }
            }
        }
    });
    return nearest_year;
}

function set_obj_to_y(obj, post)
{
    var x = $(obj).offset().left;
    var h = $(obj).height()/2;
    $(obj).offset({left: x, top: post-h/2});
}

function get_y_of_obj(obj)
{
    var h = $(obj).height();
    var y = $(obj).offset().top;
    return y+h/2;
}