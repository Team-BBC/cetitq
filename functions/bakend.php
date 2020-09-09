<?php
/**
 * https://www.siteground.com/tutorials/php-mysql/display-table-data/
 */
class dbConnect{
	public $mysqli;
	function __construct()
	{
		$this->mysqli = new mysqli('localhost', 'root', '', 'hojastq');
		if (mysqli_connect_errno()) {
			return false;
			exit('Failed to connect to Mysql: ' .mysqli_connect_errno());
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
		$stmt = $this->mysqli->prepare('select * from document order by fecha desc limit 20');
		$stmt->execute();

		$result = $stmt->get_result();
		$table = '';
		while($row = $result->fetch_assoc()){
			$table.="<tr>";
			$table .= "<td>$row[sustancia]</td>";
			$table .= "<td>$row[fecha]</td>";
			$table .= "<td class='text-center'> 
				<span class='btn btn-warning btn-sm editbtn'>
					<a href='?id=$row[id]'>
						<img src='imagenes/editar.png'>
					</a>
				</span>
			</td>";
			$table .= "<td class='text-center'> 
				<span class='btn btn-danger btn-sm deletebtn'>
					<a href='?id=$row[id]'>
						<img src='imagenes/editar.png'>
					</a>
				</span>
			</td>";
			$table .= "<td class='text-center'> 
				<span class='btn btn-info btn-sm'>
					<a href='ficheros/$row[url]' target='_blank'>
						<img src='imagenes/descargar.png'>
					</a>
				</span>
			</td>";
			$table .= "</tr>";
			//$table .= "<td><a hre=\"editar.php?id=$row[id] \"Edit</a></td>";
		}
		echo($table);
		$stmt->close();
		//table header
		echo "</table>";
		$this->mysqli->close();
	}

	public function display() {
		$query = 'select * from document order by fecha desc limit 25';
		if($result = $this->mysqli->query($query)){
			while($row = $result->fetch_assoc()){
				//table content
				$datosTabla = "";
				$datosTabla = $datosTabla.'<tr>
				<td >'.$row['sustancia'].'</td>
				<td class="text-center">
					<span class="btn btn-info btn-sm ">                      
					<a href = "ficheros/'.$row['url'].'" target="_blank">
						<i data-feather="download"> </i>
					</a>
					</span>
					
				</td>
				</tr>';   
				echo $datosTabla;
			}    
			$result->free();
			echo "</table>";
			$this->mysqli->close();
		  
		}
	}
}
?>