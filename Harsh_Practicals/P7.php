<!DOCTYPE html>
<html>
<head>
<style>
.box {
position: relative;
height: auto;
width: 500px;
/* border: 1px solid black; */
margin: auto;
box-shadow: 2px 2px 5px 2px gray;
opacity: 1;
overflow: hidden;
}
h2 {
margin-top: 55px;
font-size: 55px;
text-align: center;
text-shadow: 2px 3px 2px rgb(66, 67, 68);
/* box-shadow:2px 2px 5px 2px gray ; */
}
input {
overflow: hidden;
width: 50%;
margin-left: 25%;
box-sizing: border-box;
font-family: Times New Roman;
font-size: 15px;
font-weight: bold;
text-align: center;
padding-bottom: 5px;
outline: none;
border: none;
}


input:hover {
font-size: 25px;
}
input[type=submit]:hover {
margin-right: 25%;
background-color: #565856;
}
</style>
</head>
<body>
<h2>REGISTRATION FORM</h2>
<div class="box">
<form onsubmit=" net()" method="GET" action="action.php">
<!-- <label>NAME</label> -->
<input id="name" type="text" placeholder="ENTER NAME" name="name"
required></input>
<label id="erroru"
style="border: 1px solid red; color: RED; visibility:hidden;
font-size: 15px;padding-top: 1px;">
INVALID NAME</label>
<br>
<!-- <label>PASSWORD</label> -->
<input id="pass" type="password" placeholder="ENTER PASSWORD"
name="p" required></input>
<label id="errorp"
style="border: 1px solid red;color: red; visibility:hidden; fontsize: 10px; padding-top: 1px;font-family:sans-serif ;">
INVALID PASSWORD
</label>
<!-- <button onclick="show()">Show</button> -->
<br><br>
<div>
<input type="submit" value="SUBMIT">
</div>
</form>
</div>
</form>


</body>
<script type="text/javascript">
var uname = document.getElementById("name");
var p = document.getElementById("pass");
var eu = document.getElementById("erroru");
var ep = document.getElementById("errorp");
function net() {
if (uname.value.trim() == "") {
alert("Blank in username not allowed");
eu.style.visibility = "visible"; return false;
}
else if (p.value.trim() == "") {
alert("Blank in password not allowed"); ep.style.visibility =
"visible"; return false;
}
else if (p.value.trim().length < 5) {
alert("Password should be more than 5 element");
ep.style.visibility = "visible"; return false;
} else {
alert("Successfull LOGIN")
true;
}
}
function show() {
alert("password enter is" + p.value())
}
</script>
</html>

