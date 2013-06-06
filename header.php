		
		
		
		<div class="header">
		<table style="margin-top: 40px; ">
			<tr>
			<td>
				<h3 style="font-size: 76px;margin-top: 30px; color: #00CCFF;">CLIMED</h3>   	
			</td>
			<td> 
				<div class="menu">
					<table>
						<tr>
							<td><a href="index.php"><button class="btn btn-large btn-info" type="button">Home</button></a></td>
							<td><a href="GestionPacientes.php"><button class="btn btn-large" type="button">Pacientes</button></a></td>
							<td><a href="GestionMedicos.php"><button class="btn btn-large" type="button">Medicos</button></a></td>
							<td><a href="#"><button class="btn btn-large" type="button">Turnos</button></a></td>
							<td><a data-toggle="modal" role="button" href="#exit" class="btn btn-inverse btn-large">Salir</a></td>
						</tr>
					</table>
				</div>
			</td>
			</tr>
		</table>	<!-- Fin de Menú-->
		</div>

		
		<div id="exit" class="modal hide fade in" style="display: none; ">
            <div class="modal-body">
				<h4>Aviso</h4>	      
				<p> Esta seguro que desea salir del sistema? </p>
            </div>
            <div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<button class="btn btn-inverse" onclick="window.close()" type="button">Salir</button>
            </div>
          </div>
