// ajax call example

function getXMLHTTPRequest()
{
var req = false;
try
{
req = new XMLHttpRequest(); /* e.g. Firefox */
}
catch(err1)
{
try
{
req = new ActiveXObject(“Msxml2.XMLHTTP”);
/* some versions IE */
}
catch(err2)
{
try
{
req = new ActiveXObject(“Microsoft.XMLHTTP”);
/* some versions IE */
}
catch(err3)
{
req = false;
}
}
}
return req;
}

var myRequest = getXMLHTTPRequest();

function callAjax() {
// declare a variable to hold some information
// to pass to the server
var firstname = document.customer.first_name.value;
// build the URL of the server script we wish to call
var url = “myserverscript.php?surname=” + firstname;
// generate a random number
var myRandom=parseInt(Math.random()*99999999);
// ask our XMLHTTPRequest object to open
// a server connection
myRequest.open(“GET”, url + “&rand=” + myRandom, true);
// prepare a function responseAjax() to run when
// the response has arrived
myRequest.onreadystatechange = responseAjax;
// and finally send the request
myRequest.send(null);
}

function responseAjax() {
// we are only interested in readyState of 4,
// i.e. “completed”
if(myRequest.readyState == 4) {
// if server HTTP response is “OK”
if(myRequest.status == 200) {
… program execution statements …
} else {
// issue an error message for any
// other HTTP response
alert(“An error has occurred: “
?+ myRequest.statusText);
}
}
}