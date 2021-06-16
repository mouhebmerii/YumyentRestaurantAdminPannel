<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>
<html>
<head>
    <title>Super Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div><a href="logout.php" class="btn btn-dark btn-xm m-3">Logout</a> </div>
<?php if ($_SESSION['role'] == 'admin') {?>
      		<!-- For Admin -->

<div style="margin-left: 30px; margin-right: 30px;" ng-app="liveApp" ng-controller="liveController" ng-init="fetchData()">
    <br />
    <h3 align="center">Manage Products</h3><br />
    <div class="table-responsive" >

            <div class="alert alert-success alert-dismissible" ng-show="success" >
                    <a href="#" class="close" data-dismiss="alert" ng-click="closeMsg()" aria-label="close">&times;</a>
                    {{successMessage}}
                </div>

        <form name="testform" ng-submit="insertData()">
            <table class="table table-bordered table-striped">

                <thead class="bg-dark text-light">
                <tr>
                    <th size="5%">Id</th>
                    <th width="20%">Name</th>
                    <th width="30%">Description</th>
                    <th width="8%">Price</th>
                    <th width="10%">Category</th>
                    <th width="10%">Quantity</th>
                    <th>image link</th>
                    <th width="25%">Action</th>
                
                </tr>
                </thead>
                <tbody>
                <tr>
                <td> </td>
                <td><input type="text" ng-model="addData.title" class="form-control" placeholder="Enter item's name" ng-required="true" /></td>
                <td><input type="text" ng-model="addData.description" class="form-control" placeholder="Enter Description" ng-required="true" /></td>
                <td><input type="text" ng-model="addData.price" class="form-control" placeholder="Enter Price" ng-required="true" /></td>
                <td><input type="text" ng-model="addData.cat_id" class="form-control" placeholder="Enter Category ID" ng-required="true" /></td>
                <td><input type="text" ng-model="addData.quantity" class="form-control" placeholder="Enter Quantity" ng-required="true" /></td>
                <td><input type="text" ng-model="addData.image" class="form-control" placeholder="Enter item's Image link" ng-required="true" /></td>
                <td><button type="submit" class="btn btn-success btn-xm" ng-disabled="testform.$invalid">Add</button></td>
                     
                </tr>
                <tr ng-repeat="data in namesData" ng-include="getTemplate(data)">
                    
                </tr>
                </tbody>
            </table>
        </form>
        <script type="text/ng-template" id="display">
            <td>{{data.id}}</td>
            <td>{{data.title}}</td>
            <td>{{data.description}}</td>
            <td>{{data.price}}</td>
            <td>{{data.cat_id}}</td>
            <td>{{data.quantity}}</td>
            <td>{{data.image}}</td>
            <td>
                <button type="button" class="btn btn-primary btn-xm" ng-click="showEdit(data)">Edit</button>
                <button type="button" class="btn btn-danger btn-xm" ng-click="deleteData(data.id)">Delete</button>
            </td>

        </script>
        <script type="text/ng-template" id="edit">
            <td></td>
            <td><input type="text" ng-model="formData.title" class="form-control"  /></td>
            <td><input type="text" ng-model="formData.description" class="form-control" /></td>
            <td><input type="text" ng-model="formData.price" class="form-control" /></td>
            <td><input type="text" ng-model="formData.cat_id" class="form-control" /></td>
            <td><input type="text" ng-model="formData.quantity" class="form-control" /></td>
            <td><input type="text" ng-model="formData.image" class="form-control" /></td>

            <td>
                <input type="hidden" ng-model="formData.data.id" />
                <button type="button" class="btn btn-info btn-xm" ng-click="editData()">Save</button>
                <button type="button" class="btn btn-default btn-xm" ng-click="reset()">Cancel</button>
            </td>
        </script>
    </div>
</div>
<?php }?>
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>
<script>
var app = angular.module('liveApp', []);

app.controller('liveController', function($scope, $http){
    $scope.fetchData = function(){
        $http.get('select.php').success(function(data){
            $scope.namesData = data;
        })
    };
    $scope.formData = {};
    $scope.getTemplate = function(data){
        if(data.id == $scope.formData.id){
            return 'edit';
        }
        else {
            return 'display';
        }
    };

    $scope.addData = {};
    $scope.success = false;
    $scope.insertData = function(){
        $http({
            method:"POST",
            url:"insert.php",
            data: $scope.addData
        }).success(function(data){
    $scope.success = true;
    $scope.successMessage = data.message;
    $scope.fetchData();
    $scope.addData = {};
        });
    };

    $scope.showEdit = function(data){
        $scope.formData = angular.copy(data);
    };


    $scope.reset = function (){
        $scope.formData = {};

    };

    $scope.editData = function(){
        $http({
            method:"POST",
            url:"edit.php",
            data:$scope.formData,
        }).success(function(data){
            $scope.success = true;
            $scope.successMessage = data.message;
            $scope.fetchData();
            $scope.formData = {};
        });
    };
    $scope.deleteData = function(id){
        if(confirm("Are you sure you want to remove it?"))
        {
            $http({
                method:"POST",
                url:"delete.php",
                data:{'id':id}
            }).success(function(data){
                $scope.success = true;
                $scope.successMessage = data.message;
                $scope.fetchData();
            }); 
        }
    };
    });
</script>
