function hola(t,e){var n={entrenamientos:t.target.value};$.ajax({data:n,url:"../functions/filter.php",datatype:"html",method:"get",success:function(t){document.getElementById(e).innerHTML=t},error:function(t,e,n){console.log(n)}})}     