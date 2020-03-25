 <!doctype html>
     <html lang="en">
     <head>
     <meta charset="utf-8">
     <title>jQuery UI Datepicker - Format date</title>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
     <script src="//code.jquery.com/jquery-1.10.2.js"></script>
     <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
     <link rel="stylesheet" href="/resources/demos/style.css">
     <script>
     $(function() {
           $( "#datepicker" ).datepicker();
           $( "#format" ).change(function() {
           $( "#datepicker" ).datepicker( "option", "dateFormat", 'yy-mm-dd' ); // I am using the internationl date format, you can choose yours following below six options.
    });
     });
    </script>
    </head>
    <body>

    <p>Date: <input type="text" id="datepicker" size="30"></p>
    <p>Format options:<br>

    </body>
    </html>`