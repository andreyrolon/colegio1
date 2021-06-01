<!doctype html>
<html lang="en" class="fullscreen-bg">
<?php  
    include('./codes/rector/login.php');
    $entrar=new login();
    if(isset($_POST['ingresar'])){
        $entrar->logueo($_POST['email'],$_POST['password']);
    }
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

	<!-- Custom Theme files --> 
	<!-- //Custom Theme files -->

	<!-- web font -->
	<link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
	<!-- //web font -->

</head>
 
<style type="text/css">
 @keyframes slideleft {
    from {
        background-position: 0%;
    }
    to {
        background-position: 90000%;
    }
}

@-webkit-keyframes slideleft {
    from {
        background-position: 0%;
    }
    to {
        background-position: 90000%;
    }
}

 
 .w3layouts-main{
 
    background-image: url('logos/zx.png'); 
    background-repeat: repeat-x;
    animation: slideleft 20000s infinite linear;
    -webkit-animation: slideleft 20000s infinite linear;
    background-size: cover;
	-webkit-background-size:cover;
	-moz-background-size:cover; 
    background-attachment: fixed;
    position: relative;
	min-height: 100vh;
}

 html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6 ,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
ol,ul{list-style:none;margin:0px;padding:0px;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
table{border-collapse:collapse;border-spacing:0;}
/*-- start editing from here --*/
a{text-decoration:none;}
.txt-rt{text-align:right;}/* text align right */
.txt-lt{text-align:left;}/* text align left */
.txt-center{text-align:center;}/* text align center */
.float-rt{float:right;}/* float right */
.float-lt{float:left;}/* float left */
.clear{clear:both;}/* clear float */
.pos-relative{position:relative;}/* Position Relative */
.pos-absolute{position:absolute;}/* Position Absolute */
.vertical-base{	vertical-align:baseline;}/* vertical align baseline */
.vertical-top{	vertical-align:top;}/* vertical align top */
nav.vertical ul li{	display:block;}/* vertical menu */
nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
img{max-width:100%;}
/*-- end reset --*/
body {
	font-family: 'Hind', sans-serif;
} 
/*-- main --*/ 

h1 {
	font-size: 45px;
	color: #fff;
	font-weight: 300;
	text-transform: uppercase;
	letter-spacing: 4px;
	text-align: center;
	padding: 1em 0 0.4em 0;
}
/*-- slide --*/

@keyframes slideleft {

    from {
        background-position: 0%;
    }
    to {
        background-position: 90000%;
    }
}

@-webkit-keyframes slideleft {
    from {
        background-position: 0%;
    }
    to {
        background-position: 90000%;
    }
}

 
 @media   screen and (max-width: 900px) {
	#e{
		display:  none;
	}
	 
	.ui {
		display: none; ;
    }
     	
    #wq{
    	    margin-top:21px;
    	    color: #4c4b4b;
    }
    #ig{
    	margin-bottom: 9px;
    }

 }
 
 @media   screen and (max-width: 600px) {
	#e{
		display: none;
	}
	.header-main {
    height: 588px;
    }
	.ui {
		display: none;
    }
    #xs{
    	    margin-top: -42px;
    }	
    #wq{
    	    margin-top:21px;
    	    color: #4c4b4b;
    }
    #ig{
    	margin-bottom: 9px;
    }

 }
.bg-layer { 
	min-height: 100vh;
}
/*-- //slide --*/

/*--header start here--*/
.w3ls-header {
    padding: 0em 0 0;
}
.icon1 {
	margin: 0 0 1em;
	padding: .8em 1em;
	background: rgba(255, 255, 255, 0.94);
}
.icon1 span.fa {
    color: #222;
    width: 22px;
}
.main-icon {
    text-align: center;
}
.main-icon span.fa{
    font-size: 50px;
    color: #fff;
    margin-bottom: 1em;
}
.wthree li {
    display: inline-block;
}
a {
    color: #585858;
    margin: 0em;
}
.bottom {
    margin: 1em 0 0;
}
.header-main {
	height: 880px;
	max-width: 310px; 
	position: relative;
	z-index: 999;
	padding: 3em 2em;
	background: rgba(255, 255, 255, 0.87);
	-webkit-box-shadow: -1px 4px 28px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: -1px 4px 28px 0px rgba(0,0,0,0.75);
	box-shadow: -1px 4px 28px 0px rgba(0,0,0,0.75);
}

.sign-up {
    margin: 2em 0;
}
.header-left {
  background: #fff;
  padding: 0px;
}
.sign-up h2 {
    font-size: 22px;
    color: #fff;
    text-align: center;
    background: #fbbc05;
    width: 40px;
    height: 40px;
    line-height: 1.9em;
    border-radius: 50%;
    margin: 0 auto;
}
::-webkit-input-placeholder{
    color: #333!important;
}
.header-left-bottom input[type="txt"] {
    outline: none;
    font-size: 15px;
    color: #222;
	border:none;
    width: 90%;
    display: inline-block;
    background: transparent;
    letter-spacing: 1px;
}
.header-left-bottom input[type="password"]{
	outline: none;
	font-size: 15px;
    color: #222;
	border:none;
    width: 90%;
	display: inline-block;
	background: transparent;
    letter-spacing: 1px;
}
.header-left-bottom button.btn {
    background: #007cc0;
    color: #fff;
    font-size: 15px;
    text-transform: uppercase;
    padding: .8em 2em;
    letter-spacing: 1px;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    display: inline-block;
    cursor: pointer;
    outline: none;
    border: none;
	width: 100%;
}

/*-- agileits --*/
.header-left-bottom p {
    font-size: 17px;
    color: #000;
    display: inline-block;
    width: 50%;
    margin: 20px 0 0;
    letter-spacing: 1px;
    float: left;
}

.header-left-bottom p.right {
	text-align: right;
}
.header-left-bottom p a {
	font-size: 11px;
	color: #e2e2e2;
	text-transform: uppercase;
}
.social {
    margin: 2em 0 0;
}
.heading h5 {
    color: #c5c5c5;
    color: #000000;
    margin-top: 8px;
    font-size: 20px;
}
.social span.fa {
	color: #fff;
	font-size: 12px;
	line-height: 35px;
	margin: 0 5px;
	transition: 0.5s all;
}
.social ul li {
    display: inline-block;
    margin: 0 5px;
    font-size: 15px;
    color: #fff;
    letter-spacing: 1px;
    text-transform: capitalize;
}
.social a.facebook{
    background: #3b5998;
}
.social a.twitter{
    background: #1da1f2;
}
.social a.linkedin {
    background: #00a0dc;
}
.social a.google {
    background: #dd4b39;
}
.social ul li a {
	background: rgba(255, 255, 255, 0.8);
	width: 35px;
	height: 35px;
	line-height: 35px;
	display: block;
	text-align: center;
	border-radius: 50%;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-ms-border-radius: 50%;
	-o-border-radius: 50%;
}

.login-check {
    position: relative;
}
.checkbox i {
    position: absolute;
    top: 0px;
    left: 0%;
    text-align: center;
    display: block;
    width: 19px;
    height: 17px;
    outline: none;
    background: #fff;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    -o-border-radius: 0px;
    cursor: pointer;
}
.checkbox input:checked + i:after {
    opacity: 1;
}
.checkbox input + i:after {
    position: absolute;
    opacity: 0;
    transition: opacity 0.1s;
    -o-transition: opacity 0.1s;
    -ms-transition: opacity 0.1s;
    -moz-transition: opacity 0.1s;
    -webkit-transition: opacity 0.1s;
}
.checkbox input + i:after {
    content: url(../images/tick.png);
    top: -1px;
    left: 2px;
    width: 15px;
    height: 15px;
}
.checkbox {
    position: relative;
    display: block;
    padding-left: 30px;
    text-transform: capitalize;
    letter-spacing: 1px;
    font-size: 14px;
    color: #fff;
}
input[type="checkbox" i] {
    display: none;
}
/*-- w3layouts --*/
/*-- header end here --*/
h2 {
    font-size: 26em;
    color: #fff;
    line-height: 1.3em;
    letter-spacing: 10px;
}
h3 {
    font-size: 2em;
    color: #fff;
}
h3 a {
    font-size: 17px;
    padding-left: 12px;
    color: #04c9f9;
    text-decoration: underline;
}
/*-- copyright --*/
.copyright {
    padding: 2em 0;
    text-align: center;
}
.copyright p {
    font-size: 15px;
    letter-spacing: 1px;
    color: #ccc;
    line-height: 1.8em;
}
.copyright p a{
    color: #fff; 
	-webkit-transition: 0.5s all;
	-moz-transition: 0.5s all;
	-o-transition: 0.5s all;
	-ms-transition: 0.5s all;
	transition: 0.5s all;
}
/*-- //copyright --*/
/*-- //main --*/

/*-- responsive-design --*/ 

@media(max-width:667px){
	
	h1 {
		font-size: 40px;
		letter-spacing: 3px;
	}
}

@media(max-width:415px){
	
	h1 {
		font-size: 35px;
		letter-spacing: 3px;
	}
	.social {
		margin: 1em 0 0;
	}
	.copyright {
		padding: 2em 1em;
	}
}
@media(max-width:384px){
	.main-icon span.fa {
		margin-bottom: .6em;
	}
	.header-main {
		max-width: 310px;
		margin: 0 1em;
	}
	.header-left-bottom input[type="email"],.header-left-bottom input[type="password"] {
		width: 88%;
	}
	.social ul li {
		margin: 0 2px;
	}
	h1 {
		font-size: 30px;
	}
} 
a{
	color: #007cc0; 
    font-size: 19px;
}
a:hover{
	cursor: pointer;
	color: #c0001b;

}
</style>
<body body style=" margin: 0px">
	<!-- WRAPPER -->
	<!-- main -->
<script type="text/javascript">
	function colo(){
		document.getElementById('w1').style.border='solid 1px #b1b1b1';document.getElementById('w2').style.border='solid 1px #b1b1b1';
	}
</script>
<div class="w3layouts-main"  > 
	<div class="bg-layer" onclick="colo()" style="background-color: #ffffff45">
		<h1 style="float: right;margin-right: 300px">
			 
				<div id="e">
					<img src="img/texto1.png" alt="" style=" width: 688px;">  	  
					<div style="margin-top: -35px">  
						<img src="img/texto2.png" alt="" style=" width: 604px;margin-top: -75px"> 
						<div style="float: right;font-size: 35px;  margin-top: -11px;  margin-left: -54px; "> 🎓 </div>    
					</div>
				</div>
			 
		</h1>
		<div class="header-main" style=" ">
			<div class="main-icon">
				<span class="fa fa-eercast"></span>
			</div>
			<div class="header-left-bottom">
				<form  method="post">
					 <center> 
						<img src="logos/institucion.png" style="width: 250px"  > 
						<img src="logos/nom_col.png" style="width: 260px;margin-top: -10px"  >
			 
				<img src="logos/foto4.png" id="ig" style="    width: 107px;" alt="">
				<br class="ui"><br class="ui"><br class="ui"><br class="ui"><br class="ui">

				<div class="header-left-bottom">
					<form action="#" method="post">
						<div id="w1" class="icon1">
							<span class="fa fa-user"></span>
							<input type="txt" name="email" id="email" placeholder="Numero documento"  onfocus="document.getElementById('w2').style.border='solid 1px #b1b1b1';document.getElementById('w1').style.border='solid 1px #007cc0';" required=""/>
						</div>
						<div id="w2" class="icon1">
							<span class="fa fa-lock"></span>
							<input type="password" name="password" id="password"  placeholder="Clave" onfocus="document.getElementById('w1').style.border='solid 1px #b1b1b1';document.getElementById('w2').style.border='solid 1px #007cc0';" required=""/>
						</div>
						 
						<div class="bottom">
							<button name="ingresar" class="btn">Ingresar</button>
						</div>
						<br ><br class="ui" >
						<a > Recuperar clave</a>
						<div id="wq">
							Empresa Desarrolladora: Ibusoft.<br><br>
							<img src="logos/foto1.png" alt="">
						</div>
						 
					</form>	
				</div>
			</center>
				</form>	
			</div>
			 
		</div>
		 
	</div>
</div>	
	<!-- END WRAPPER -->
</body>

</html>

	 <script>  
	 	document.getElementById('w1').style.border='solid 1px #007cc0'; 
	 	document.getElementById('email').focus(); 
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
