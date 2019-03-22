var courses = new Set();

// var json = $.getJSON('results.json');

// for (var i in json) {
//     var obj = json[i];
//     courses.add(obj.course_name);
// }

// console.log(json.stringify);
// console.log()

var obj = JSON.parse('results.json');
console.log(obj);


// function getArray(){
//     return $.getJSON('results.json');
// }

// getArray().done( function(json) {
//     console.log(json); // show the json data in console
//     var _len = json.length;
//     var obj;
//     for (var i in json) {
//         obj = json[i];
//         courses.add(obj.course_name);
//     }
//     console.log(courses)
// });