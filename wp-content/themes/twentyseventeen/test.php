<?php 
  
if(isset($_GET['submit'])) { 
    $var = $_GET['option1']; 
    if(isset($var)) { 
        echo "Option 1 submitted successfully"; 
    } 
} 
?> 
<html lang="en"> 
<head> 
    <title>GeeksforGeeks Example</title> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href= 
    "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
    <style> 
        .gfg { 
            font-size:40px; 
            font-weight:bold; 
            color:green; 
        } 
        body { 
            text-align:center; 
        } 
    </style> 
</head> 
<body> 
    <div class="container"> 
        <div class = "gfg">GeeksforGeeks</div> 
        <h2>Form control: checkbox</h2> 
        <p>The form below contains one checkbox.</p> 
        <form method="get"> 
            <div class="checkbox"> 
                <label><input type="checkbox" name = "option1" 
                        value="Option 1">Option 1</label> 
                <label><button name="submit" value='true' 
                    class="btn btn-default">Lưu</button> 
            </div> 
        </form> 
    </div> 
</body> 
</html> 