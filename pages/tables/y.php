<!DOCTYPE html>
<html>
<head>
<script 
src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"> 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3- 
typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<link rel="stylesheet" 
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
/>
<script 
src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"> 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap- 
multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap- 
multiselect/0.9.13/css/bootstrap-multiselect.css" />
</head>
<body>
<div class="container" style="width:400px;">
    <form method="post" id="framework_form">
        <div class="form-group">
            <label>Select which Framework you have knowledge</label>
            <select id="framework" name="framework[]" multiple class="form-control">
                <option value="Codeigniter">Codeigniter</option>
                <option value="CakePHP">CakePHP</option>
                <option value="Laravel">Laravel</option>
                <option value="YII">YII</option>
                <option value="Zend">Zend</option>
                <option value="Symfony">Symfony</option>
                <option value="Phalcon">Phalcon</option>
                <option value="Slim">Slim</option>
            </select>
        </div>
    </form>
    <br />
</div>
</body>
</html>
<script>
$(document).ready(function () {
    $('#framework').multiselect({
        nonSelectedText: 'Thêm khách mời',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '400px'
    });


});
</script>