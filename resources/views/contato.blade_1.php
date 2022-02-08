<div id="contato">
    Aqui é o Contato {{$nome}}
    <hr />
    @foreach ($arrais as $item)
        {{$item}} <br />
    @endforeach
    
    <hr />
    
    <div ng-app="myApp" ng-controller="myCtrl">

First Name: <input type="text" ng-model="firstName"><br>
Last Name: <input type="text" ng-model="lastName"><br>
<br>
Full Name: @{{firstName + " " + lastName}}

</div>
        </div>
    
    <hr />
    <hr />
    
    <form action="doMake" id="form" method="post">
        <input type="text" name="nome" />
        <input type="button" id="doAjax" value="Ajax" />
        <!--{{csrf_field()}}-->
    </form>
    
    <div id="result"></div>
    <a href="#/curso">Sobre</a>

    <div ng-view></div>

</div>
<script>
    
    var app = angular.module('myApp', ["ngRoute"]);
    app.config(function($routeProvider) {
        $routeProvider
        .when("/curso", {
          controller  : 'CursoController',
          templateUrl : "curso"
        });
      });
    app.controller('myCtrl', function($scope) {
      $scope.firstName = "John";
      $scope.lastName = "Doe";
    });
    
    app.controller('CursoController', function($scope) {
      console.log("CursoController");
    });
    


$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#doAjax").click(function(){
        
        var url = "doMake";
        
        $.post(url, $("#form").serialize(), function(eData){
            console.log(eData);
        }, "json");
        
    });
    
});
</script>