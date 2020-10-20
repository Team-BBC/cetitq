<?php
class dbConnect{
	public $mysqli;
	function __construct()
	{
		$this->mysqli = new mysqli('localhost', 'cetihs', 'e536fb6e0', 'cetihs');
		if (mysqli_connect_errno()) {
			return false;
			exit('Fallo en la conexion con la base de datos ' .mysqli_connect_errno());
		}
		$this->mysqli->query("SET NAMES 'utf8'");
	}
	public function aPlaceTableHeader(){
		echo '<table class="table table-dark">
	            <thead class="text-center">
	              <tr class = "font-weight-bold">
	                <td>Nombre</td>
	                <td>Utima modificacion</td>
	                <td>Editar</td>
	                <td>Eliminar</td>
	                <td>Descargar</td>
	              </tr>
	            </thead>';
	}
	public function uPlaceTableHeader(){
		//table header
		echo '<table class="table table-dark">
	            <thead class="text-center">
	              <tr class = "font-weight-bold">
	                <td>Nombre</td>
	                <td>descargar</td>
	              </tr>
	            </thead>';
	}

	public function displayAll() {
		$table = '';
		if($stmt = $this->mysqli->query('select * from htq_ficheros order by fecha desc limit 20')){
			while ($row = $stmt->fetch_assoc()){
				$table = "";
				$table.="<tr>";
				$table.="<td style='display:none;'>$row[id]</td>";
				$table .= "<td>$row[sustancia]</td>";
				$table .= "<td>$row[fecha]</td>";
				$table .= "<td class='text-center'> 
					<span class='btn btn-warning btn-sm editbtn'>
						<img src='imagenes/editar.png'>
					</span>
				</td>";
				$table .= "<td class='text-center'> 
					<span class='btn btn-danger btn-sm deletebtn'>				
						<img src='imagenes/borrar.png'>
					</span>
				</td>";
				$table .= "<td class='text-center'> 
					<span class='btn btn-info btn-sm'>
						<a href='ficheros/$row[url]' target='_blank'>
						<img src='imagenes/descargar.png'>
					</span>
				</td>";
				$table .= "</tr>
				";
				echo $table;
			}
			echo "</table>";
		}else{
			$table.="<tr>
			<td>Hubo un error al mostrar</td></tr></table>";
		}
		$stmt->close();
		$this->mysqli->close();
	}

	public function display() {
		$datosTabla = '';
		if($stmt = $this->mysqli->query('select sustancia from htq_ficheros order by fecha desc limit 20')){
			while ($row = $stmt->fetch_array(MYSQLI_NUM)){
				$datosTabla ="";
				$datosTabla = $datosTabla.'<tr>
				<td >'.$row[0].'</td>
				<td class="text-center">
					<span class="btn btn-info btn-sm ">                      
					<a href = "ficheros/'.$row[0].'.pdf'.'" target="_blank">
						<img src="imagenes/descargar.png">
					</a>
					</span>
					
				</td>
				</tr>';   
				echo $datosTabla;
			}
			echo "</table>";
		}else{
			$datosTabla.="<tr>
			<td>Hubo un error al mostrar</td></tr></table>";
		}
		$stmt->close();
		$this->mysqli->close();
	}

	public function uSearch($busqueda){
		$name = "%$busqueda%";
		$busquedaTabla ='';
		if($stmt = $this->mysqli->prepare('SELECT sustancia FROM htq_ficheros WHERE sustancia LIKE ?')){
			$stmt->bind_param("s", $name);
			$stmt->execute();
			$stmt->bind_result($sustancia);
			while($stmt->fetch()){
				$busquedaTabla = "";
				$busquedaTabla = $busquedaTabla.'<tr>
				<td >'.$sustancia.'</td>
				<td class="text-center">
					<span class="btn btn-info btn-sm ">                 
					<a href = "../ficheros/'.$sustancia.'.pdf" target="_blank">
						<img src="../imagenes/descargar.png">
					</a>
					</span>
				</td>
				</tr>
				';	
				echo $busquedaTabla;
			}
			echo "</table>";
			$stmt->close();
		}else{
			$busquedaTabla.="<tr>
			<td>Hubo un error al mostrar</td></tr></table>";
		}
		
		$this->mysqli->close();
	}

	public function aSearch($busqueda){
		$name = "%$busqueda%";
		$table ='';
		if($stmt = $this->mysqli->prepare('SELECT id, sustancia, fecha FROM htq_ficheros WHERE sustancia LIKE ?')){
			$stmt->bind_param("s", $name);
			$stmt->execute();
			$stmt->bind_result($id, $sustancia, $fecha);
			while($stmt->fetch()){
				$table = "";
				$table = $table.'<tr>';
				$table.="<td style='display:none;'>$id</td>";
				$table .= "<td>$sustancia</td>";
				$table .= "<td>$fecha</td>";
				$table .= "<td class='text-center'> 
					<span class='btn btn-warning btn-sm editbtn'>
						<img src='../imagenes/editar.png'>
					</span>
				</td>";
				$table .= "<td class='text-center'> 
					<span class='btn btn-danger btn-sm deletebtn'>				
						<img src='../imagenes/borrar.png'>
					</span>
				</td>";
				$table .= "<td class='text-center'> 
					<span class='btn btn-info btn-sm'>
						<a href='../ficheros/$sustancia.pdf' target='_blank'>
						<img src='../imagenes/descargar.png'>
					</span>
				</td>";
				$table .= "</tr>";		
			}				
			echo$table."</table>";
			$stmt->close();
		}else{
			$table.="<tr>
			<td>Hubo un error al mostrar</td></tr></table>";
		}
		$this->mysqli->close();
	}
}