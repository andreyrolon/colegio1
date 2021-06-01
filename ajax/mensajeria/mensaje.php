


<?php 
 

	if (isset($_FILES['upload']['name'])) {

		$file=$_FILES['upload']['tmp_name'];
		$file_name=$_FILES['upload']['name'];
		$file_name_array=explode('.', $file_name);
		$extencion=end($file_name_array);
		$new_image_name=rand().'.'.$extencion;
		chmod('upload',0777);
		$allowed_extencion=array('jpg','gif','png');
		if (in_array($extencion, $allowed_extencion)) {
			move_uploaded_file($file,''.$new_image_name);
			$function_number=$_GET['CKEditorFuncNum'];
			$url=''.$new_image_name;
			$message='';
			echo
			'<script typr="text/javascript">
				window.parent.CKEDITOR.tools.callFunction($function_number,"$url","$message");
			</script>';

		}
	}
 



