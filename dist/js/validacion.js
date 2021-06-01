/* var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
	if(is_chrome==false)
	{
		alert("RECOMENDACION: UTILIZAR GOOGLE CHROME... PARA BUEN FUNCIONAMIENTO DEL APLICATIVO");
		location.href="https://www.google.es/chrome/browser/desktop/index.html";
	}*/
//document.oncontextmenu = function(){return false}

function validarEmail( email ) {
    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if ( !expr.test(email) ){
            
            return true;
            //alert("Error: La dirección de correo " + email + " es incorrecta.");
        }
        else{
            return false;
        }
            
       
    }

function valores(valor){
    
    valor= valor.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
    valor= valor.split('').reverse().join('').replace(/^[\.]/,'');
    return valor;
}
    
  function ESnumero( num ){
       if ((!/^([0-9])*$/.test(num))){
      return true;  
    }
   
    else{
        return false;
    }
  
 
  }
 
   
    function ESnumeros( num ){
       if ((!/^([0-9])*$/.test(num))){
      return true;  
    }
   
    else{
        return false;
    }
  
 
  }
  function te( num ){

    regexp = /^([0-9]{7})+$/;
       if (!regexp.test(num)){
      return true;  
    }
   
    else{
        return false;
    }
  
 
  }
    function decimaa( num ){
       valor = /^[0-9]+([.][0-9]+)?$/;
       if (!valor.test(num)){
      return true;  
    }
   
    else{
        return false;
    }
  
 
  } 
    function decimaa1( num ){
       valor = /^[0-9]+([,][0-9]+)?$/;
       if (valor.test(num)){
      return true;  
    }
   
    else{
        return false;
    }
  
 
  }   
    function decimaa2( num ){
       valor = /^[0-9]+([.][0-9]+)?$/;
       if (valor.test(num)){
      return true;  
    }
   
    else{
        return false;
    }
  
 
  }   
    function ESnombre(ttx){
    regexp = /^[A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN]+$/;
    if (!regexp.test(ttx))
    {       
      return true;  
    }
    else{
        return false;
    }
      
  }
    function ESnombre1(ttx){
    regexp = /^[A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN]+$/;
    if (regexp.test(ttx))
    {       
      return true;  
    }
    else{
        return false;
    }
      
  }
    function Esdireccion(ttx){
    regexp = /^[0-9A-Za-záéíóúñüÁÉÍÓÚÜNIÑOniñoN\sN,.-]+$/;
    if (regexp.test(ttx))
    {       
      return false;  
    }
    else{
        return true;
    }
      
  }

function EsNit(nit,cod) { 
	var vpri, x, y, z, i, nit1, dv1;
 nit1=nit;
    if (isNaN(nit1))
    {
    
  mensaje(1,'El valor digitado no es un numero valido');
        
    } else {
  vpri = new Array(16); 
    x=0 ; y=0 ; z=nit1.length ;
    vpri[1]=3;
    vpri[2]=7;
    vpri[3]=13; 
    vpri[4]=17;
    vpri[5]=19;
    vpri[6]=23;
    vpri[7]=29;
    vpri[8]=37;
    vpri[9]=41;
    vpri[10]=43;
    vpri[11]=47;  
    vpri[12]=53;  
    vpri[13]=59; 
    vpri[14]=67; 
    vpri[15]=71;
  for(i=0 ; i<z ; i++)
    { 
     y=(nit1.substr(i,1));
        //document.write(y+"x"+ vpri[z-i] +":");
   x+=(y*vpri[z-i]);
        //document.write(x+"<br>");     
    } 
  y=x%11
    //document.write(y+"<br>");
  if (y > 1)
    {
   dv1=11-y;
    } else {
   dv1=y;
    }
    //document.form1.dv.value=dv1;
        
        if(parseInt(cod)!=dv1){
            return true;
        }
        else{
            return false;
        }
    }
}
    

    