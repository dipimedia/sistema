//creamos la aplicacion
app = angular.module('admin', ['ngRoute','ngCookies','ngAnimate','angularFileUpload','ngIdle','ngResource','angular.directives-round-progress']);

//configuramos las rutas y asignamos html y controlador segun la ruta
app.config(function($routeProvider, $locationProvider, $idleProvider, $keepaliveProvider){

    $routeProvider.when('/home',{
            templateUrl   : '../views/home.html',
            controller    : 'homeCtrl'       
    });

    $routeProvider.when('/login',{
            templateUrl   : '../views/login.html',
            controller    : 'loginCtrl'       
    });

    $routeProvider.when('/logout',{
            templateUrl   : '../views/adios.html',
            controller    : 'logoutCtrl'       
    });

    $routeProvider.when('/nuevo/provedor',{
            templateUrl   : '../views/altaprovedor.html',
            controller    : 'nuevoProvedorCtrl'       
    });

    $routeProvider.when('/nuevo/producto',{
            templateUrl   : '../views/altaproducto.html',
            controller    : 'nuevoProductoCtrl'       
    });

    $routeProvider.when('/producto',{
            templateUrl   : '../views/producto.html',
            controller    : 'productoCtrl'       
    });

    $routeProvider.when('/producto',{
            templateUrl   : '../views/producto.html',
            controller    : 'productoCtrl'       
    });

    $routeProvider.when('/provedor',{
            templateUrl   : '../views/provedor.html',
            controller    : 'provedorCtrl'       
    });

    $routeProvider.when('/usuario',{
            templateUrl   : '../views/usuario.html',
            controller    : 'usuarioCtrl'       
    });

    $routeProvider.otherwise({redirectTo:'/login'});


    $locationProvider.html5Mode(false);


    $idleProvider.idleDuration(600); // tiempo en activarse el modo en reposo 
    $idleProvider.warningDuration(10); // tiempo que dura la alerta de sesion cerrada
    $keepaliveProvider.interval(10); // 

});

//var notificaciones = new Firebase("https://inventario.firebaseio.com/notificaciones");

//notificaciones que se ejecutan cuando la aplicacion inicia
app.run(function ($rootScope , $location, auth, $cookieStore, $cookies, $idle){

    $rootScope.usuario = $cookies.username;
    $rootScope.muestra = true;
    $rootScope.marca = 'menuactivo';

    $rootScope.$on('$routeChangeStart', function(){

        auth.checkStatus();

        $rootScope.usuario = $cookies.usuario;

    });

    //verificamos el estatus del usuario en la aplicacion
    $idle.watch();

    //Bloqueo en caso de inactividad

    // $rootScope.$on('$idleTimeout', function() {
    //     // the user has timed out (meaning idleDuration + warningDuration has passed without any activity)
    //     // this is where you'd log them
    //     if($location.path() != "/login" && $location.path() != "/bloqueo"){
            
    //         $rootScope.ruta = $location.path();
    //         $location.path('/bloqueo');
    //     }
        
    // })

});


//factoria que controla la autentificación, devuelve un objeto
//$cookies para crear cookies
//$cookieStore para actualizar o eliminar
//$location para cargar otras rutas

app.factory("auth", function($cookies,$cookieStore,$location, $rootScope, $routeParams, $http)
{
    return{
        login : function(username, password)
        {   


            // $cookies.usuario = username;
            // $cookies.token = 1;
            // $rootScope.usuario = username;
            // $rootScope.token = 1;
            // //mandamos a la home
            // $location.path("/home");


            $http.post('/api/login',{username:username,password:password})
            .success(function (data){
                    
                if(data.respuesta){
                    $rootScope.mensaje = data.respuesta;
                }else{
                    
                    //creamos la cookie con el nombre que nos han pasado
                    $cookies.usuario = data.USU_nombre;
                    $cookies.token = data.USU_token;

                    $rootScope.usuario = data.USU_nombre;
                    $rootScope.token = data.USU_token;
                    //mandamos a la home
                    if ($rootScope.ruta != undefined){
                        $location.path($rootScope.ruta);
                        
                    }else{
                        $location.path("/home");
                    }

                    $('html').removeClass('lockscreen');

                    // if (navigator.geolocation) {

                    //     navigator.geolocation.getCurrentPosition($rootScope.localidad, $rootScope.error);
                    //     console.log($rootScope.localidad);
                    //     console.log($rootScope.error);
                    // };

                }

            }).error( function (xhr,status,data){

                $rootScope.mensaje ='Existe Un Problema de Conexion Intente Cargar Nuevamente la Pagina';

            });

            
        },
        logout : function()
        {

            //al hacer logout eliminamos la cookie con $cookieStore.remove
            $cookieStore.remove("usuario"),
            $cookieStore.remove("password");
            $rootScope.usuario = "";
            //mandamos al login
            $location.path("/login");
        },
        checkStatus : function()
        {

            //creamos un array con las rutas que queremos controlar
            // console.log($location.path());
            // var rutasPrivadas = ["/","/login","/home"];

            if( $location.path() != "/login" && typeof($cookies.usuario) == "undefined")
            {   
                console.log('entro a login');
                $location.path("/login");

            }
            //en el caso de que intente acceder al login y ya haya iniciado sesión lo mandamos a la home
            if($location.path() == "/login" && typeof($cookies.usuario) != "undefined")
            {   
                $rootScope.usuario = $cookies.usuario;
                //$rootScope.id = $cookies.id;
                console.log($rootScope.usuario + " : " + $cookies.usuario);
                $location.path("/home");
            }
        },
        in_array : function(needle, haystack)
        {
            var key = '';
            for(key in haystack)
            {
                if(haystack[key] == needle)
                {
                    return true;
                }
            }
            return false;
        }
    }
});


//Todas las consultas generadas al api por un servicio llamada busquedas
app.factory("busquedas", function($http){
    return{
        afiliaciones:function(){
            return $http.get('/api/api.php?funcion=consultaAfiliacion');
        }
        
    }
});


//Todas las consultas generadas al api por un servicio llamada busquedas
app.factory("user", function($resource){

    var User = $resource('api.daseda.net/login/:user/:password', {}, {
                'get':    {method:'GET'},
                'save':   {method:'POST'},
                'query':  {method:'GET'},
                'remove': {method:'DELETE'},
                'delete': {method:'DELETE'}
            });

    return User;
});




app.directive('ngKeydown', function() {
    return {
        restrict: 'A',
        link: function(scope, elem, attrs) {
             // this next line will convert the string
             // function name into an actual function
             var functionToCall = scope.$eval(attrs.ngKeydown);
             elem.on('keydown', function(e){
                  // on the keydown event, call my function
                  // and pass it the keycode of the key
                  // that was pressed
                  // ex: if ENTER was pressed, e.which == 13
                  functionToCall(e);
             });
        }
    };
});


// directiva que convierte en mayusculas
app.directive('mayusculas', function() {
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
        var capitalize = function(inputValue) {
           var capitalized = inputValue.toUpperCase();
           if(capitalized !== inputValue) {
              modelCtrl.$setViewValue(capitalized);
              modelCtrl.$render();
            }         
            return capitalized;
         }
         modelCtrl.$parsers.push(capitalize);
         capitalize(scope[attrs.ngModel]);  // capitalize initial value
     }
   };
});

app.directive('numeros', function(){
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
       modelCtrl.$parsers.push(function (inputValue) {
           // this next if is necessary for when using ng-required on your input. 
           // In such cases, when a letter is typed first, this parser will be called
           // again, and the 2nd time, the value will be undefined
           if (inputValue == undefined) return '' 
           var transformedInput = inputValue.replace(/[^0-9]/g, ''); 
           if (transformedInput!=inputValue) {
              modelCtrl.$setViewValue(transformedInput);
              modelCtrl.$render();
           }         

           return transformedInput;         
       });
     }
   };
});


app.directive('decimales', function(){
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
       modelCtrl.$parsers.push(function (inputValue) {
           // this next if is necessary for when using ng-required on your input. 
           // In such cases, when a letter is typed first, this parser will be called
           // again, and the 2nd time, the value will be undefined
           if (inputValue == undefined) return '' 
           var transformedInput = inputValue.replace(/.[0-9]{5}$/, ''); 
           if (transformedInput!=inputValue) {
              modelCtrl.$setViewValue(transformedInput);
              modelCtrl.$render();
           }         

           return transformedInput;         
       });
     }
   };
});



