<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset="utf-8" />
        <style>
        table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    white-space: normal;
    line-height: normal;
    font-weight: normal;
    font-size: medium;
    font-style: normal;
    color: -internal-quirk-inherit;
    text-align: start;
    border-spacing: 2px;
    border-color: gray;
    font-variant: normal;
    width: 100%;
    table-layout: auto;
    border: 1px solid;
}
th{
    text-align: left;
}
td{
    height: 50px;
    vertical-align: bottom;
}
th, td{
    border-bottom: 1px;
    border: 1px solid;
}
tr:nth-child(even){
    background-color: $f2f2f2;
}
.table{
    display: table;
}
.table>* {
    display: table-row;
    }
.table>*>*{
    display:table-cell;
}
        </style>
    </head>
<body>
<script>
function changeTable(str) {
  if (str.length == 0) {
    document.getElementById("answer").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    window.history.replaceState(null, document.title, "/~group9/ajax.php?table="+str);
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("answer").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "php/xml.php?input="+str, true);
    xmlhttp.send();
  }
}
function changeHash(str){
    if (str.length == 0) {
    document.getElementById("hashpass").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("hashpass").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "php/hash.php?pass="+str, true);
    xmlhttp.send();
  }
}
</script>
<?php
    include('header.php');
    echo("<br />");
    $sql = "show tables";
    $result = $conn -> execute_query($sql, []);
    echo("<form><select name = 'table' id='table' onchange = 'changeTable(this.value)' onpageshow='changeTable(this.value)' onfocus='changeTable(this.value)'><option value = ''> </option>");
    while($row = $result->fetch_row()){
        echo("<option value = ".$row[0].">".$row[0]."</option>");
    }
    echo("</select></form>");
    echo("<div id = 'answer'>blank</div>");
    echo("<input id = 'pass' onkeyup = 'changeHash(this.value)'>");
    echo("<div id = 'hashpass'></div>");
    $tab = $_GET['table'];
    echo("<script>
    document.getElementById('table').value = \"$tab\";
    changeTable(\"$tab\");
    </script>");
?>


</head>
<body>

</body>
</html>