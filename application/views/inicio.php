<!DOCTYPE html>
<html lang="en" ng-app="app">
<head>
	<meta charset="utf-8">
	<title>Prueba Sistema CodeIgniter - Angular</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
<body ng-controller="homeCtrl">
	<section class="container" ng-init="incio()">
		<h1>We are ready!!! <br><small><em>CodeGular &copy; </em>Time!!! <br><?= base_url();?></small></h1>
		<div class="row">
			<div class="col-md-6">
				<h2>Datos del Usuario</h2>
				<form role="form">
					<div class="form-group">
					    <label for="exampleInputPassword1">Nombre</label>
					    <input type="text" class="form-control" id="exampleInputPassword1" ng-model="datos.user_name" placeholder="Nombre">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Correo</label>
						<input type="email" class="form-control" id="exampleInputEmail1" ng-model="datos.user_email" placeholder="Email">
					</div>
					<div class="text-center">
						<div ng-show="mensaje" class="alert alert-success" role="alert">{{mensaje}}</div>
						<br>
					  	<button type="submit" ng-hide="edicion" ng-click="guardar()" class="btn btn-default">Guardar</button>
					  	<div class="edicion" ng-show="edicion">
					  		<button type="button" ng-click="actualizar()" class="btn btn-primary">Actualizar</button>
					  	</div>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<h2>Usuarios Registrados</h2>
				<br>
				<table class="table table-bordered">
			      <thead>
			        <tr>
			          <th>id</th>
			          <th>Nombre</th>
			          <th>Correo</th>
			          <th>Accion</th>
			        </tr>
			      </thead>
			      <tbody>
			        <tr ng-repeat="usuario in usuarios">
						<th>{{usuario.user_id}}</th>
						<th>{{usuario.user_name}}</th>
						<th>{{usuario.user_email}}</th>
						<th>
							<button class="btn btn-warning" ng-click="editar(usuario.user_id)">Editar</button>
							<button class="btn btn-danger" ng-click="eliminar(usuario.user_id)">Eliminar</button>
						</th>
			        </tr>
			      </tbody>
			    </table>
			</div>
		</div>
	</section>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/angular.min.js"></script>
	<script>

			var app = angular.module('app', []);

			function homeCtrl($scope, $http){

				$scope.incio = function(){

					$scope.consulta();

					$scope.datos = {
						user_email:'',
						user_name:''
					}

					$scope.id = '';
					$scope.edicion = false;
					$scope.usuarios = [];
					$scope.mensaje = '';
					
				}

				$scope.guardar = function(){

					console.log($scope.datos)

					$http({
				        url:'/dba/add_user',
				        method:'POST', 
				        // headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				        contentType: "application/json; charset=utf-8", 
				        dataType: "json", 
				        data:$scope.datos
				    }).success(function (data){
				        console.log(data);
				        $scope.mensaje = data.msg;

				        $scope.datos.user_email = '';
						$scope.datos.user_name = '';

						$scope.consulta();

				    }).error( function (xhr,status,data){
				        alert('Existe Un Problema de Conexion Intente Cargar Nuevamente la Pagina');
				    });
				}

				$scope.editar = function(id){

					$http.get('/dba/user_data_for_id/'+id).success(function (data){

						console.log(data);
						$scope.datos.user_email = data[0].user_email;
						$scope.datos.user_name = data[0].user_name;
						$scope.id = id;
						$scope.edicion = true;

					});
				}

				$scope.actualizar = function(){

					$http({
				        url:'/dba/up_user/'+ $scope.id,
				        method:'POST', 
				        // headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				        contentType: "application/json; charset=utf-8", 
				        dataType: "json", 
				        data:$scope.datos
				    }).success(function (data){
				        console.log(data);
				        $scope.mensaje = data.msg;
				        $scope.consulta();
				        $scope.edicion = false;
				        $scope.datos.user_email = '';
						$scope.datos.user_name = '';
				    }).error( function (xhr,status,data){
				        alert('Existe Un Problema de Conexion Intente Cargar Nuevamente la Pagina');
				    });

				} 

				$scope.eliminar = function(id){

					$http.get('/dba/del_user/'+id).success(function (data){

						console.log(data);
						$scope.mensaje = data.msg;
				        $scope.consulta();
						
					});

				}

				$scope.consulta = function(){

					$http.get('/dba/users_list').success(function (data){
						console.log(data);
						$scope.usuarios = data;
					});

				}
			}
	</script>
</body>
</html>


<!-- 
color pagina daseda

morado claro #6E63A7
morado oscuro #4D4479
azul de contraste #5DADE2 -->