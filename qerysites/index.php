<?php

//index.php

session_start();

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Авторизація</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
  
  <style>
    .none{display: none;}
  .form_style
  {
   width: 1000px;
   margin: 0 auto;
  }
  
.middle { 
        text-align: right; 
        font-size: 15px;
    } 

/* optional styles */
.left { 
        text-align: left; 
        font-size: 20px;
    } 


table tr th, table tr td{font-size: 1.2rem;}
.row{ margin:10px 20px 20px 20px;width: 100%;}
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
 </head>
 <body>
  <br />
   <h3 align="center">Адміністратор</h3>
  <br />

<div ng-app="login_register_app" ng-controller="login_register_controller" class="container">
   <?php
   if(!isset($_SESSION["name"]))
   {
   ?>
   <div class="alert {{alertClass}} alert-dismissible" ng-show="alertMsg">
    <a href="#" class="close" ng-click="closeMsg()" aria-label="close">&times;</a>
    {{alertMessage}}
   </div>

   <div class="panel panel-default" ng-show="login_form">
    <div class="panel-heading">
     <h3 class="panel-title">Авторизація</h3>
    </div>
    <div class="panel-body">
     <form method="post" ng-submit="submitLogin()">
      <div class="form-group">
       <label>Введи електрона пошта</label>
       <input type="text" name="email" ng-model="loginData.email" class="form-control" />
      </div>
      <div class="form-group">
       <label>Введи пароль</label>
       <input type="password" name="password" ng-model="loginData.password" class="form-control" />
      </div>
      <div class="form-group" align="center">
       <input type="submit" name="login" class="btn btn-primary" value="Увійти" />
       <br />
      </div>
     </form>
    </div>
   </div>
</div>
   <?php
   }
   else
   {
    ?>


<div ng-app="login_register_app" >
<div class="container" ng-controller="userController" ng-init="getRecords()">
    <div class="row">

        <tr> 
            <td id="leftcol">Відктрити інформацію за часом<a class="glyphicon glyphicon-eye-open" onClick='location.href="log.php"'></a></td>
            <td id="spacer"></td>
            <td id="rightcol"><input type="text" class="form-control"/></td>
           </tr>
        <div class="panel panel-default users-content">
            <div class="left">Адміністратор <a href="javascript:void(0);" onClick="$('.formData').slideToggle();document.getElementById('userForm').reset();"> <h1 class="middle">Додати співробітника</h1></a></div>
            <div class="alert alert-danger none"><p></p></div>
            <div class="alert alert-success none"><p></p></div>
            <div class="panel-body none formData">
                <form class="form" name="userForm" id="userForm">
                    <div class="form-group">
                        <label>Рівень доступу</label>
                        <input type="number" class="form-control" name="idlevel" ng-model="tempUserData.idlevel"/>
                    </div>
                    <div class="form-group">
                        <label>ПІБ</label>
                        <input type="text" class="form-control" name="name" ng-model="tempUserData.name"/>
                    </div>
                    <div class="form-group">
                        <label>UID</label>
                        <input type="text" class="form-control" name="uid" ng-model="tempUserData.uid"/>
                    </div>
                    <div class="form-group">
                        <label>Електрона пошта</label>
                        <input type="text" class="form-control" name="email" ng-model="tempUserData.email"/>
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" class="form-control" name="phone" ng-model="tempUserData.phone"/>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-warning" onClick="$('.formData').slideUp();">Відміна</a>
                    <a href="javascript:void(0);" class="btn btn-success" ng-hide="tempUserData.id" ng-click="addUser()">Додати</a>
                    <a href="javascript:void(0);" class="btn btn-success" ng-hide="!tempUserData.id" ng-click="updateUser()">Оновити</a>
                </form>
            </div>
            <table class="table table-striped">
                <tr>
                    <th width="5%">id</th>
                    <th width="5%">Рівень</th>
                    <th width="20%">ПІБ</th>
                    <th width="10%">UID</th>
                    <th width="16%">Email</th>
                    <th width="10%">Телефон</th>
                    <th width="13%">Час прибуття</th>
                    <th width="14%">Час вибуття</th>
                </tr>
                <tr ng-repeat="user in users | orderBy:'-created'">
                    <td>{{$index + 1}}</td>
                    <td>{{user.idlevel}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.uid}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.phone}}</td>
                    <td>{{user.created}}</td>
                    <td>{{user.modified}}</td>
                    <td>
                        <a href="javascript:void(0);" class="glyphicon glyphicon-edit" ng-click="editUser(user)"></a>
                        <a href="javascript:void(0);" class="glyphicon glyphicon-trash" ng-click="deleteUser(user)"></a>
                    </td>
                </tr>
            </table>
            
        </div>
        <div class="panel panel-default">
    
   
   <div class="panel-body">
     
     <a href="logout.php">Вийти</a>
     <input type="button" name="register_link" class="btn btn-primary btn-link" ng-click="showRegister()" value="Реєстрація нового адміністратора" />
     <div class="panel panel-default" ng-show="register_form">
    <div class="panel-heading">
     <h3 class="panel-title">Реєстрація нового адміністратора</h3>
    </div>
    <div class="panel-body">
     <form method="post" ng-submit="submitRegister()">
      <div class="form-group">
       <label>Введи ім'я</label>
       <input type="text" name="name" ng-model="registerData.name" class="form-control" />
      </div>
      <div class="form-group">
       <label>Введи електрону пошту</label>
       <input type="text" name="email" ng-model="registerData.email" class="form-control" />
      </div>
      <div class="form-group">
       <label>Введи пароль</label>
       <input type="password" name="password" ng-model="registerData.password" class="form-control" />
      </div>
      <div class="form-group" align="center">
       <input type="submit" name="register" class="btn btn-primary" value="Register" />
       <br />
      </div>
     </form>
    </div>
   </div>
    </div>
    </div>
    </div>
    
</div>

</div>




    <?php
   }
   ?>

  </div>
 </body>
</html>
<script src="login.js"></script>
