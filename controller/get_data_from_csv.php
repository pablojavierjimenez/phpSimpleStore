<?php 

class getDataFromCSV
{
	
	public static function csvToElementList ($uploaded_file){
		////Inicializacion de variables
			$i =1;
			$fila = 1;
			$csv_headers = array();
			$csv_rows 	 = array();
			$row_data	 =[];
		////

		$uploaded_file = $_FILES["archivo"];

		//SI EL ARCHIVO SE ENVIÓ Y ADEMÁS SE SUBIO CORRECTAMENTE
		if (isset($uploaded_file) && is_uploaded_file($uploaded_file['tmp_name'])) {
		    $inputFile   = $uploaded_file['tmp_name'];
		    // echo "Archivo subido correctamente";
			}
			else{
		     echo "Error de subida";
		}

		$csv_data = fopen($inputFile, "r");

		/**
		 * parcear archivo V-1
		 */
		// while (!feof($csv_data)){

		// 	$data  = explode(",", fgets($csv_data));

		// 	if ($i <= 1) {
		// 		foreach ($data as $key) {
		// 			array_push($csv_headers, $key);
		// 		}
		// 	}

		// 	if ($i > 1) {
		// 		foreach ($data as $key) {
		// 			array_push($csv_rows, trim($key));
		// 		}
		// 		if (count($csv_headers)==count($csv_rows)) {
		// 			$row = array_combine($csv_headers, $csv_rows);					
		// 			array_push($row_data, $row);	
		// 			$csv_rows = array();
		// 		}
		// 	}
		// 	$i ++;
		// }

		/**
		 * parcear archivo V-2
		 */
		if (($gestor = fopen($inputFile, "r")) !== FALSE) {
			while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
				$numero = count($datos);
				if ($fila <= 1) {
					foreach ($datos as $key) {
						array_push($csv_headers, $key);
					}
				}
		
				if ($fila > 1) {
					if (count($csv_headers)==count($datos)) {
						$row = array_combine($csv_headers, $datos);					
						array_push($row_data, $row);
					}
				}
				// echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
				$fila++;
				// for ($c=0; $c < $numero; $c++) {
				//     echo $datos[$c] . " |\n";
				// }
			}
			fclose($gestor);
		
			// echo json_encode($row_data);
		}
		return array($csv_headers,$row_data,$fila);
	}

	public static function csvToTable($csv_headers,$row_data){
		///imprimir
			$show_tables ="<table border='1'>";
			$show_tables .="<thead><tr>";

			foreach ($csv_headers as $key) {
				$show_tables .= "<th>$key <i class='fa fa-sort'></i></th>\n";
			}

			$show_tables .="</tr>\n<thead>\n<tbody>";

			foreach ($row_data as $key => $line) {
				$show_tables .="\n<tr class='success'>";
				foreach ($line as $key => $value) {
					$show_tables .= "<td>$value</td>\n";
				}
				$show_tables .="\n</tr>";
			}

			$show_tables .="</tbody>";
			return $show_tables;
		////
	}

	public static function csvToArray ($row_data, $stock, $family_name){
		return array(
			"category_name" => $family_name,
			"stock" => $stock,
			"last_update" => date('c'),
			"item_list" => $row_data
		);
	}
	
	public static function csvToJSON ($row_data, $stock, $family_name) {
		$category = array(
			"category_name" => $family_name,
			"stock" => $stock,
			"last_update" => date('c'),
			"item_list" => $row_data
		);
		return json_encode($category);
	}
}
?>