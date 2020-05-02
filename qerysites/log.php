<?php

//log.php

session_start();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>AngularJS</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
/* required style*/ 
.none{display: none;}

/* optional styles */
table tr th, table tr td{font-size: 1.2rem;}
.row{ margin:50px 20px 20px 20px;width: 70%;}
.glyphicon{font-size: 20px;}
.glyphicon-plus{float: right;}
a.glyphicon{text-decoration: none;cursor: pointer;}
.glyphicon-trash{margin-left: 10px;}
.alert{
    width: 50%;
    border-radius: 0;
    margin-top: 10px;
    margin-left: 10px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>

<script src="login.js"></script>
</head>
<body ng-app="login_register_app">
<div class="container" ng-controller="userController" ng-init="getRecords()">
    <div class="row">
        <div>Закрити інформацію за часом<a class="glyphicon glyphicon-eye-close" onClick='location.href="index.php"'></a></div>
        <div class="panel panel-default users-content">
            
            <div class="panel-heading">Інформація за час</div>
            <div class="alert alert-danger none"><p></p></div>
            <div class="alert alert-success none"><p></p></div>
            <div class="panel-body none formData">

            </div>
            <table class="table table-striped">
                <tr>
                    <th width="20%">ПІБ</th>
                    <th width="13%">Час прибуття</th>
                    <th width="13%">Час вибуття</th>
                    <th width="4%">Статус</th>
                </tr>
                <tr ng-repeat="user in users | orderBy:'-created'">
                    <td>{{user.name}}</td>
                    <td>{{user.created}}</td>
                    <td>{{user.modified}}</td>
                    <td>{{user.status}}</td>
                    
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
