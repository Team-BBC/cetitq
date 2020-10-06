<?php
class dbConnect{
	public $mysqli;
	function __construct()
	{
		$this->mysqli = new mysqli('localhost', 'root', '', 'hojastq');
		if (mysqli_connect_errno()) {
			return false;
			exit('Fallo en la conexion con la base de datos ' .mysqli_connect_errno());
		}
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
		$query = $this->mysqli->prepare('select * from htq_ficheros order by fecha desc limit 20');
		$query->execute();

		$result = $query->get_result();
		$table = '';
		while($row = $result->fetch_assoc()){
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
			$table .= "</tr>";
			//$table .= "<td><a hre=\"editar.php?id=$row[id] \"Edit</a></td>";
		}
		echo($table);
		$query->close();
		//table header
		echo "</table>";
		$this->mysqli->close();
	}

	public function display() {
		$query = 'select * from htq_ficheros order by fecha desc limit 25';
		if($stmt = $this->mysqli->prepare($query)){
			$stmt->execute();
			$result = $stmt->get_result();
			while($row = $result->fetch_assoc()){
				//table content
				$datosTabla = "";
				$datosTabla = $datosTabla.'<tr>
				<td >'.$row['sustancia'].'</td>
				<td class="text-center">
					<span class="btn btn-info btn-sm ">                      
					<a href = "ficheros/'.$row['url'].'" target="_blank">
						<img src="imagenes/descargar.png">
					</a>
					</span>
					
				</td>
				</tr>';   
				echo $datosTabla;
			}    
			$result->free();
			echo "</table>";
			$stmt->close();
			$this->mysqli->close();
		  
		}
	}

	public function uSearch($busqueda){
		$name = "%$busqueda%";
		$stmt = $this->mysqli->prepare('SELECT sustancia FROM htq_ficheros WHERE sustancia LIKE ?');
		$stmt->bind_param("s", $name);
		$stmt->execute();
		$resulta = $stmt->get_result();
		while($row = $resulta->fetch_assoc()){
			$busquedaTabla = '';
			$busquedaTabla = $busquedaTabla.'<tr>
				<td >'.$row['sustancia'].'</td>
				<td class="text-center">
					<span class="btn btn-info btn-sm ">                      
					<a href = "../ficheros/'.$row['sustancia'].'.pdf" target="_blank">
						<img src="../imagenes/descargar.png">
					</a>
					</span>
				</td>
			</tr>';
			echo $busquedaTabla;
		}	
		$resulta->free();
		echo "</table>";	
		$stmt->close();
		$this->mysqli->close();
	}

	public function aSearch($busqueda){
		$name = "%$busqueda%";
		$stmt = $this->mysqli->prepare('SELECT id, sustancia, fecha FROM htq_ficheros WHERE sustancia LIKE ?');
		$stmt->bind_param("s", $name);
		$stmt->execute();
		$resulta = $stmt->get_result();
		while($row = $resulta->fetch_assoc()){
			if($row!=null){
				$table="";
				$table.="<tr>";
				$table.="<td style='display:none;'>$row[id]</td>";
				$table .= "<td>$row[sustancia]</td>";
				$table .= "<td>$row[fecha]</td>";
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
						<a href='../ficheros/$row[sustancia].pdf' target='_blank'>
						<img src='../imagenes/descargar.png'>
					</span>
				</td>";
				$table .= "</tr>";			
			}
		}
			echo($table);
			$stmt->close();
			//table header
			echo "</table>";
			$this->mysqli->close();
			
	}	

	/*}else{
					$tble = "";
					$tble.= "<tr>
						<td>No se mas encontraron resultados</td>
					</tr>
					</table>
					";
					echo $tble;
					$stmt->close();
					$this->mysqli->close();
				}
				*/
}
