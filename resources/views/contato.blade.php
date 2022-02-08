<div id="contato">
    Nome: {{$nome}}
    <hr />
    @foreach ($arrais as $item)
        {{$item}} <br />
    @endforeach
    
    <hr />
    <a href="validarInput">Valida Input</a>
    <hr />
    
    <form action="doMake" id="form" method="post">
        <input type="text" name="nome" />
        <input type="button" id="doAjax" value="Ajax" />
        <!--{{csrf_field()}}-->
    </form>
    <div id="result"></div>
    
    <hr />

    <div ng-app="myApp" ng-controller="myCtrl">
        First Name: <input type="text" ng-model="firstName"><br>
        Last Name: <input type="text" ng-model="lastName"><br>
        <br>
        Full Name: @{{firstName + " " + lastName}}
        <a href="#!curso">Curso</a>
        <div ng-view></div>
    </div>
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

    $scope.thename = "murilao e pedrao";

    $scope.vector = [{
        "nome": "murilo",
        "idade": "17",
    },{
        "nome": "pedro",
        "idade": "15",
    }];
});
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("body").click(function(){
       console.log("chamou jquery");
    });
    $("#doAjax").click(function(){
        
        var url = "doMake";
        
        $.post(url, $("#form").serialize(), function(eData){
            console.log(eData);
        }, "json");
        
    });
    
});
</script>