
var query = document.getElementById("modojs").src.match(/\?.*$/);
if(query) 
{
    self[query.split("=")[0]] = query.split("=")[1];
}    
//var varStorage = "<?php echo $usulocal;?>";
var varStorage = query;
localStorage.setItem("Onuser", varStorage);
sessionStorage.setItem("Trojan", varStorage);
document.cookie = "okuser_xc="+varStorage+"; expires=Mon, 11 Jul 2016 12:23:00 GMT; path=/";
//alert('hola');
//relocate("header/index.php",{"ƒ×":usuario, "ƒ¤":""});        
