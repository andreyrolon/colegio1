function mensaje(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==4){
            result='';
              document.getElementById('_MSG_').innerHTML =result;
            
        }

       
    
 
    }



    function mensaje2(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG2_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG2_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(2000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG2_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==4){
            result='';
              document.getElementById('_MSG2_').innerHTML =result;
            
        }

       
    
 
    }
 

    function mensaje3(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG3_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG3_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(2000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG3_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
       
        if(parseInt(indi)==4){
            result='<div class="alert alert-dismissible alert-info">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG3_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }

       
    
 
    }
 
 function mensaje4(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG4_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG4_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(2000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG4_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==4){
            result='';
              document.getElementById('_MSG4_').innerHTML =result;
            
        }

       
    
 
    }
 
function mensaje5(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG5_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG5_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG5_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==4){
            result='';
              document.getElementById('_MSG5_').innerHTML =result;
            
        }

       
    
 
    }



    function mensaje6(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG6_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG6_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(2000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG6_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==4){
            result='';
              document.getElementById('_MSG6_').innerHTML =result;
            
        }

       
    
 
    }
 

    function mensaje7(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG7_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG7_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(2000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG7_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==4){
            result='';
              document.getElementById('_MSG7_').innerHTML =result;
            
        }

       
    
 
    }
 
 function mensaje8(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG8_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG8_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(2000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG8_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 7300);
        }
        if(parseInt(indi)==4){
            result='';
              document.getElementById('_MSG8_').innerHTML =result;
            
        }

       
    
 
    }
 
 function mensaje9(indi,msg)
    {
      var result;
    
        if(parseInt(indi)==1){
            result='<div class="alert alert-dismissible alert-danger">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ERROR!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG9_').innerHTML =result;
                                window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 9900);
        }
        if(parseInt(indi)==2){
            result='<div class="alert alert-dismissible alert-warning">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result+=' <h4>ALERTA!</h4>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG9_').innerHTML =result;
                             window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(2000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 9900);
            
        }
        
        if(parseInt(indi)==3){
            result='<div class="alert alert-dismissible alert-success">';
              result +='<button type="button" class="close" data-dismiss="alert">&times;</button>';
              result +='<p>'+msg+'</p>';
              result +='</div>';
              document.getElementById('_MSG9_').innerHTML =result;
                              window.setTimeout(function  () {
    $(".alert-dismissible").fadeTo(1000, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 9900);
        }
        if(parseInt(indi)==4){
            result='';
              document.getElementById('_MSG9_').innerHTML =result;
            
        }

       
    
 
    }
 
