var courses = new Set();

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
    xmlhttp.open("GET", "mysql.php")
}

var obj = JSON.parse('results.json');
console.log(obj);


