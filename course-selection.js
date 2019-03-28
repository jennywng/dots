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
    xmlhttp.open("GET", "get-dates.php", true);
    xmlhttp.send();
}