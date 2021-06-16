<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>
<html>
<head>
    <title>Admin Pannel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
    th{
        text-align:center;
    }
    .eee{
        width: 10%;
    }
  
            @import url(https://fonts.googleapis.com/css?family=Open+Sans);
            header img {
    height: 80px;
    margin-left: 40px;
}
body {
  
    /* background-image: url('https://i.ibb.co/TL00FC1/wpid-wp-1471262357823.jpg'); */
    background-size: cover;
    
    font-family: 'Open Sans', sans-serif;
    margin-top: 80px;
    padding-top: 30px;
}

main {
    color: white;
}

header {
    background-color: #18141c;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 100px;
    display: flex;
    align-items: center;
    box-shadow: 0 0 25px 0 black;
}

header * {
    display: inline;
}

header li {
    margin: 20px;
    color: white;
}

header li a {
    color: white;
    font-size: 15px;
    text-decoration: none;
}



.search {
  width: 100%;
  position: relative;
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 3px solid #00B4CC;
  border-right: none;

  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  width: 40px;
  height: 36px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius: 0 4px 4px 0;
  cursor: pointer;
  font-size: 20px;
}

/*Resize the wrap to see the search bar change!*/
.wrap{
  width: 15%;
  position: absolute;
  top: 44%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.result{
    color: white;
    position: absolute;
  top: 55%;
  left: 50%;
  font-size: 35;
  transform: translate(-50%, -50%);
}
.dd{
    padding-top: 35px;
    top:20%;
    left: 50%;
    font-size:50;
    color: white;
    font-family: Georgia, serif;
}
hr{
    margin-top:-10px;
    width: 100%;
    border-top: 2px solid red;
}
.rii{
    text-align: right;
}

    </style>
</head>
<body>
<header>

            <div> <a href="http://localhost:4200">
           <img src="https://i.ibb.co/GCCVB7r/logo.png">
           </a>
           </div>
            <nav>
                <ul >
                <li>   <a href="http://localhost:4200">Go to Yummient</a></li>
                    <!-- <li><a href="#">Contact Us</a></li> -->
                    <!-- <li><a href="http://localhost:4200/aboutus">About Us</a></li> -->
                    <!-- <li><a href="http://localhost:4200/terms">Terms & Conditions</a></li> -->
                    <!-- <li class="rii">  <a href="logout.php" class="btn btn-dark btn-xm m-3">Logout</a> </li> -->
                </ul>
      
            </nav>
            <

        <a href="logout.php" class="btn btn-danger btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>

        </header>
<?php if ($_SESSION['role'] == 'superadmin') {?>



    <div><a href="food.php" class="btn btn-primary btn-xm m-3">Food</a>
    <a href="accounts.php" class="btn btn-warning btn-xm ">Accounts</a> 
    <a href="food.php" class="btn btn-danger btn-xm m-3">FAQ</a> 
 
     </div>
    


    <?php }?>
<div style="margin-left: 10px; margin-right: 10px;" ng-app="liveApp" ng-controller="liveController" ng-init="fetchData()">
    <br />
    <h3 align="center">Confirmed Orders</h3><br />
    <div align="center"><a href="home.php" class="btn btn-primary btn-xm ">New Orders</a>
    <a href="confirmed.php" class="btn btn-primary btn-xm m-3">Confirmed</a>
    <a href="delivering.php" class="btn btn-primary btn-xm">Delivering</a>
    <a href="archive.php" class="btn btn-primary btn-xm m-3">Archive</a> </div>
    <div class="table-responsive" >

            <div class="alert alert-success alert-dismissible" ng-show="success" >
                    <a href="#" class="close" data-dismiss="alert" ng-click="closeMsg()" aria-label="close">&times;</a>
                    {{successMessage}}
                </div>

        <form name="testform" ng-submit="insertData()" >
            <table class="table table-bordered table-striped">

                <thead class="bg-dark text-light">
                <tr>
                    <th size="5%">Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th class="eee">Email</th>
                    <th>Adress</th>
                    <th>Country</th>
                    <th>Phone</th>
                    <th>Description</th>
                    <th>Oreder_details</th>
                    <th>Total Order</th>
                    <th>DATE</th>
                    <th>Statut</th>
                    <th>Action</th>
                
                </tr>
                </thead>
                <tbody>

                <tr ng-repeat="data in namesData" ng-include="getTemplate(data)">
                    
                </tr>
                </tbody>
            </table>
        </form>
        <script type="text/ng-template" id="display">
            <td>{{data.id}}</td>
            <td>{{data.fname}}</td>
            <td>{{data.lname}}</td>
            <td>{{data.email}}</td>
            <td>{{data.address}}</td>
            <td>{{data.country}}</td>
            <td>{{data.phone}}</td>
            <td>{{data.description}}</td>
            <td>{{data.order_details}}</td>
            <td>{{data.total_order}}</td>
            <td>{{data.date}}</td>
            <td>{{data.done}}</td>
            <td>
            <!-- <button type="button" class="btn btn-warning btn-xm m" ng-click="startit(data.id)">Start</button>&nbsp; -->
            <button type="button" class="btn btn-primary btn-xm" ng-click="deliver(data.id)">Deliver</button>
            <!-- <button type="button" class="btn btn-success btn-xm" ng-click="finish(data.id)">Finish </button> -->
            <button type="button" class="btn btn-danger btn-xm" ng-click="cancel(data.id)">Cancel</button>
            </td>

        </script>
        <script type="text/ng-template" id="edit" method="post" action="edit_ord.php">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>FINISHED
		    </td>

            <td>
                <input type="hidden" ng-model="formData.data.id" />
                <button type="button" class="btn btn-info btn-sm" ng-click="editData()">Save</button>
                <button type="button" class="btn btn-default btn-sm" ng-click="reset()">Cancel</button>
            </td>
        </script>
    </div>
</div>
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>
<script>
var app = angular.module('liveApp', []);

app.controller('liveController', function($scope, $http){
    $scope.fetchData = function(){
        $http.get('selectconf.php').success(function(data){
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

    

    $scope.showEdit = function(data){
        $scope.formData = angular.copy(data);
    };


    $scope.reset = function (){
        $scope.formData = {};

    };

    $scope.editData = function(){
        $http({
            method:"POST",
            url:"edit_ord.php",
            data:$scope.formData,
        }).success(function(data){
            $scope.success = true;
            $scope.successMessage = data.message;
            $scope.fetchData();
            $scope.formData = {};
        });
    };

    $scope.startit = function(id){
        if(confirm("Do you want to confirm the order and start it?"))
        {
            $http({
                method:"POST",
                url:"start.php",
                data:{'id':id}
            }).success(function(data){
                $scope.success = true;
                $scope.successMessage = data.message;
                $scope.fetchData();
            }); 
        }
    };
    $scope.deliver = function(id){
        if(confirm("Are you sure the order is ready for delivery?"))
        {
            $http({
                method:"POST",
                url:"deliver.php",
                data:{'id':id}
            }).success(function(data){
                $scope.success = true;
                $scope.successMessage = data.message;
                $scope.fetchData();
            }); 
        }
    };
    $scope.finish = function(id){
        if(confirm("Do you want to finish the order."))
        {
            $http({
                method:"POST",
                url:"finish.php",
                data:{'id':id}
            }).success(function(data){
                $scope.success = true;
                $scope.successMessage = data.message;
                $scope.fetchData();
            }); 
        }
    };
    $scope.cancel = function(id){
        if(confirm("Are you sure that you want to Cancel the order?"))
        {
            $http({
                method:"POST",
                url:"cancel.php",
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
