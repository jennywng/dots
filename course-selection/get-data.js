function getStuff() {
    var course = document.getElementById('course-choice');
    var c = course.options[course.selectedIndex].value;

    var dates = document.getElementById('date-choice');
    var date = dates.options[dates.selectedIndex].value;
    var d = Math.round(new Date(date).getTime()/1000);
    console.log(d);
    
    
    $.ajax({
        url: 'get-events.php',
        type: 'POST',
        data: {
            'course': c,
            'date': d,
        },
        success: function(data) {
            console.log(data);
        }
    }); 
}




// $(document).ready(function(){
//     $('button').click(function() {
//         console.log("button clicked");
//         var course = document.getElementById('course-choice');
//         var c = course.options[course.selectedIndex].value;
//         var dates = document.getElementById('date-choice');
//         var d = dates.options[dates.selectedIndex].value;
//         var date = Math.round(new Date(d).getTime()/1000);
    
//         console.log(date);
    
//         $.ajax({
//             url: 'get-events.php',
//             type: 'POST',
//             data: {
//                 'course': course,
//                 'date': date,
//             },
//             success: function(data) {
//                 console.log(data);
//             }
//         });
//     });     
// });

// function getEvents() {
//     var course = document.getElementById('course-choice');
//     var c = course.options[course.selectedIndex].value;
//     var dates = document.getElementById('date-choice');
//     var d = dates.options[dates.selectedIndex].value;
//     var date = Math.round(new Date(d).getTime()/1000);
//     console.log("date in unix: " + date);
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             var events_json = this.responseText;
//             console.log(events_json);
//             // var events = JSON.parse(events_json);
//             // console.log(events);
//         }
//     };

//     xmlhttp.open("GET", "get-events.php?c=" + c + "&d=" + d, true);
//     xmlhttp.send();
// }