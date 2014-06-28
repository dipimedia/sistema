function homeCtrl($scope, $rootScope ,auth){

	$scope.inicio = function(){

		$rootScope.marca = 'menuactivo';
		$rootScope.muestra = true;
		$scope.tituloH = 'Estadisticas';
		$('html').removeClass('lockscreen');

	}
}

function loginCtrl($scope, $rootScope, auth){

	$scope.inicio = function(){

		$scope.username = '';
		$scope.password = '';
		$rootScope.marca = '';
		$rootScope.mensaje = '';
		$rootScope.muestra = false;
		$('html').addClass('lockscreen');
	}

	$scope.iniciar = function(){

		$rootScope.mensaje = '';
		auth.login($scope.username,$scope.password);
	}
}

function logoutCtrl($scope , $cookies, auth){
 
	$scope.inicio = function (){

		auth.logout();
		$scope.tituloA = 'Vuelve Pronto ' + $cookies.username;
	}

}

function nuevoProductoCtrl($scope, $http){

	$scope.inicio = function(){

		$scope.imagenes = [];
		$scope.tituloAPR = 'Producto';
		$scope.datos = {
			codigo:'',
			codigobarras:'',
			provedor:'',
			idprovedor:'',
			costo:'',
			venta:'',
			cantidad:'',
			descripcion:'',
			descripcionexpress:'',
			imagenes:$scope.imagenes
		}

		$scope.subiendo = false;
		$scope.mensaje = '';
		$scope.altaprovedores();
				
	}

	// Here I synchronize the value of label and percentage in order to have a nice demo
    $scope.$watch('roundProgressData', function (newValue, oldValue) {
      newValue.percentage = newValue.label / 100;
    }, true);



    $scope.onFileSelect = function($files) {


    try{

    	$scope.subiendo = true;

        for (var i = 0; i < $files.length; i++) {

        	$scope.roundProgressData = {
	          label: 0,
	          percentage: 0
	        }

			var file = $files[i];


			$scope.nombreimagen = file.name;

			if (file.type.indexOf('image') == -1) {

				throw 'La extension no es de tipo imagen'; 
			}

			$scope.upload = $upload.upload({

				url: 'api/temporal', //upload.php script, node.js route, or servlet url
				method: 'POST',
				data: {dato: 'datos Enviados'},
				file: file

			}).progress(function(evt) {
				$scope.roundProgressData.label = parseInt(100.0 * evt.loaded / evt.total);
			}).success(function(data, status, headers, config) {
			// imagen se guardo con exito en temporales
				$scope.files.push({
					name:file.name,
					ubicacion:data.ubicacion,
					principal:''
				});

			});

        }

        $scope.subiendo = false;


    }catch(err){

        alert(err);

    }
 
}

	$scope.altaprovedores = function(){

		$scope.provedores = [{id:1,nombre:'DUPLIMAX'},{id:2,nombre:'STYLOS'},{id:3,nombre:'MEMOREX'}];
	}

	$scope.guardar = function(){

		console.log($scope.datos);
		$scope.tipoalerta = 'alert-success'
		$scope.mensaje = 'Datos Guardados Correctamente';

	}

}

function nuevoProvedorCtrl($scope, $http){

	$scope.inicio = function(){

		$scope.tituloAP = 'Provedor';
		$("[data-mask]").inputmask();
		$scope.datos = {
			nombre:'',
			telefono:'',
			contacto:'',
			mail:'',
			descripcion:'',
			direccion:''
		}

		$scope.mensaje = '';
	}

	$scope.guardar = function(){

		console.log($scope.datos);
		$scope.tipoalerta = 'alert-success'
		$scope.mensaje = 'Datos Guardados Correctamente';

	}

}

function productoCtrl($scope){

	$scope.inicio = function(){

		$scope.tituloP = 'Productos';
		
	}
}

function provedorCtrl($scope){

	$scope.inicio = function(){

		$scope.tituloPV = 'Provedores';
		
	}
}




function usuarioCtrl($scope){
 	
 	$scope.inicio = function(){

 		$scope.tituloU = 'Alta de Usuarios';	

 	}
	

}