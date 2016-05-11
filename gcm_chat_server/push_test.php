<?php
error_reporting(-1);
ini_set('display_errors', 'On');
?>

<?php
require_once __DIR__ . '/demo.php';
$demo = new Demo();
$admin_id = $demo->getDemoUser();
?>

<html>
    <head>
        <title>Google Cloud Messaging 3.0 - Test</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,800,100' rel='stylesheet' type='text/css'>
        <link href='style.css' rel='stylesheet' type='text/css'>
        <link href='http://api.androidhive.info/gcm/styles/default.css' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('input#send_to_single_user').on('click', function () {
                    
                    var apiKey = $('#api_key').val();
                    var token = $('#token').val();
                    var msg = $('#message').val();
                    var include_image = $("#include_image").is(':checked');

                    if (apiKey.trim().length === 0) {
                        alert('Enter GCM API Key');
                        return;
                    }

                    if (token.trim().length === 0) {
                        alert('Enter GCM registration token');
                        return;
                    }

                    if (msg.trim().length === 0) {
                        alert('Enter a message');
                        return;
                    }
                    $('#loader_test_push').show();

                    $.post("v1/users/push_test",
                            {token: token, message: msg, api_key: apiKey, include_image: include_image},
                    function (data) {
                        if (data.error === false) {
                            $('#loader_test_push').hide();
                            alert('Test Push Notification sent successfully!');
                        } else {
                            alert('Sorry! Unable to send message');
                        }
                    }).done(function () {

                    }).fail(function () {
                        alert('Sorry! Unable to send message');
                    }).always(function () {
                        $('#loader_test_push').hide();
                    });
                });
            });
        </script>
    </head>
    <body>
        <div class="container_body">
            <div class="topics">
                <h2 class="heading">Google Cloud Messaging Push Notification Test</h2>

                <div class="container">
                    <input type="text" class="gcm_token" id="api_key" placeholder="GCM API Key"/><br/>
                    <input type="text" class="gcm_token" id="token" placeholder="Enter gcm registration token"/><br/>
                    <textarea id="message" class="textarea_msg" placeholder="Type a message"></textarea><br/><br/>
                    <input type="checkbox" id="include_image"/> <label for="include_image">Include image in notification</label><br/><br/><br/>
                    <input id="send_to_single_user" type="button" value="Send Push Notification" class="btn_send"/>
                    <img src="loader.gif" id="loader_test_push" class="loader"/>
                </div>
            </div>

        </div>
    </body>
</html>
