function getCourses() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var select = document.getElementById("course-choice");
            
            var courses_json = this.responseText;
            console.log(courses_json);
            var courses = JSON.parse(courses_json);
            console.log(courses);

            for (var key in courses) {
                if (courses.hasOwnProperty(key)) {
                    var option = document.createElement('option', value=courses[key]);
                    option.append(courses[key]);
                    select.append(option);
                }
            }
        }
    };
    xmlhttp.open("GET", "get-courses.php", true);
    xmlhttp.send();
}


function getDates() {
    var course = document.getElementById('course-choice');
    var c = course.options[course.selectedIndex].value
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var select = document.getElementById("date-choice");
            
            var dates_json = this.responseText;
            console.log(dates_json);
            var dates = JSON.parse(dates_json);
            console.log(dates);

            for (d in dates) {
                console.log(d);
                var option = document.createElement('option', value=dates[d]);
                option.append(dates[d]);
                select.append(option);
            }
        }
    };
    xmlhttp.open("GET", "get-dates.php?c=" + c, true);
    xmlhttp.send();
}