<?php
session_start(); 
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

$db = mysqli_connect("10.169.0.177","whatmovi_mattr","Password1","whatmovi_project");
$ac_key = mysqli_real_escape_string($db, $_POST['ac_key']);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Console Testing.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="outputs"></div>
    <span class='console-label'>Input >> </span><input id="holder" name="holder" type="text" class='console-input' placeholder="Type command...">
    <script src='js/jquery.min.js'></script>
</body>
<script>
    $('.console-input').focus();
    var ver = "3.5";
    $('#ver').html(ver);
    $('.console-input').keyup(function() {});
    $('.console-input').keydown(function() {
        this.value = this.value;
    });
    $('.console-input').click(function() {
        this.value = this.value;
    });

    function output(print) {
        var cmd = $('.console-input').val();
        if (cmd == "") {
            cmd = "<span style='opacity:0;'>...</span>";
        }
        $("#outputs").append("<span class='output-cmd-pre'>Input ></span><span class='output-cmd'>" + cmd + "</span><br>");

        $.each(print, function(index, value) {
            cmd = "Response >>";
            if (value == "") {
                value = "&nbsp;";
            }
            $("#outputs").append("<span class='output-text-pre'>" + cmd + "</span><span class='output-text'>" + value + "</span><br>");
        });

        $('.console-input').val("");
        //$('.console-input').focus();
        $("html, body").animate({
            scrollTop: $(document).height()
        }, 300);
    }
    var cmds = {
        "/ping": function() {
            output(['Pong!']);
        },
        "/code": function() {
            output(['#Fe2G#%C9=Un(8wKfd?EU6UVpB']);
        },
        "sv_cheats": function() {
            $(document).ready(function() {
                var email_value = prompt('Please enter your key.');
                if (email_value !== null) {
                    //post the field with ajax
                    $.ajax({
                        url: 'cons.php',
                        type: 'POST',
                        dataType: 'text',
                        data: {
                            data: email_value
                        },
                        success: function(response) {
                            <?
                            $sql = $db->query("SELECT ac_key FROM ac_key;");
                            $data = $sql-> fetch_array();
                            if ($_POST['data'] == $data[0]) {
                                $sql = $db->query("UPDATE users SET ulocked='1' WHERE id='".$_SESSION['id']."'");
                            } else {
                                
                            }
                            ?>
                        }
                    });
                }

            });
        },
        "/pong": function() {
            output(['Use /ping']);
        },
        "/help": function() {
            var print = ["Commands:", "/ping", "/pong"];
            output(print);
        },
    };
    $('.console-input').on('keypress', function(event) {
        if (event.which === 13) {
            var str = $(this).val();
            var data = str.split(' ');
            data.shift();
            data = data.join(' ');
            var cmd = str.split(' ')[0];

            if (typeof cmds[cmd] == 'function') {
                if (cmds[cmd].length > 0) {
                    cmds[cmd](data);
                } else {
                    cmds[cmd]();
                }
            } else {
                output(["Command not found: '" + cmd + "'", "Use '/help' for list of commands."]);
            }
            $(this).val("");
        }
    });
</script>

</html>