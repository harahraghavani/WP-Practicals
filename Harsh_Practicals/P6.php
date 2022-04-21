<!DOCTYPE html>
<html>
<head>
<title>Iframe</title>
<style type="text/css">
* {
padding: 0px;
margin: 0px;
box-sizing: border-box;
}
div {

display: flex;
justify-content: space-around;
align-items: center;
background-color: rgba(151, 160, 154, 0);
}
button {
margin: 10px;
padding: 10px;
background-color: transparent;
border: none;
outline: none;
font-size: 20px;
font-weight: bolder;
}
button:hover {
background-color: rgb(152, 28, 28);
color: rgb(10, 16, 10);
border-radius: 10px;
}
</style>
</head>
<body>
<div>
<button onclick="newSrc();">Resume</button>
<button onclick="newSrc1();">Time Table</button>
<button onclick="newSrc2();">Calculator</button>
</div>
<script type="text/javascript">
function newSrc() {
document.getElementById('if').src = "first.html";
}
function newSrc1() {
document.getElementById('if').src = "second.html";
}
function newSrc2() {
document.getElementById('if').src = "4.html";
}
</script>
<iframe width="100%" height="1000" id="if"></iframe>
</body>
</html>