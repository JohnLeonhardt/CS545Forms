// form AJAX call
$(document).ready(function() {
    $('input[name="first_name"]').focus();
    
    $(':submit').on('click', function(e) {
        e.preventDefault();
        var params = "email="+$('#email_address').val();
        var url = "check_dup.php?"+params;
        $.get(url, dup_handler);
		processUpload();
        });
    
    });
    
function dup_handler(response) {
    if(response == "dup")
        $('#status').text("ERROR, duplicate");
    else if(response == "OK") {
        $('form').serialize();
        $('form').submit();
        }
    else
        alert(response);
    }
	
function processUpload() {
        send_file();    // picture upload takes longer, get it going
        send_form_data();
        }
        
    function send_form_data() {
        var name = $('input:text[name=name]').val();
        var desc = $('textarea[name="description"]').val();        
        var url = "echo.php";
        url += "?name="+name+"&description=" + desc;
        var req = new HttpRequest(url, handleData);
        req.send();
        }
        
    function handleData(response) {
               $('#status').css('color','blue');
               $('#answer').html(response); 
               }
        
    function send_file() {    
        var form_data = new FormData($('form')[0]);       
        form_data.append("image", document.getElementById("picture").files[0]);
        $.ajax( {
            url: "file_upload.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
               $('#status').css('color','blue');
               $('#status').html("Your file has been received.");
               var fname = $("#picture").val();
               var toDisplay = "<img src=\"/~jadrn026/proj3/emblem/" + fname + "\" />";               
               $('#pic').html(toDisplay);
                },
            error: function(response) {
               $('#status').css('color','red');
               $('#status').html("Sorry, an upload error occurred, "+ response.statusText);
                }
            });
        }