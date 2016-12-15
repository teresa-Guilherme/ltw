$(function (){
	//solucao para o chrome que não sabe preencher formularios
	 $('.fake-autofill-fields').show();
        // some DOM manipulation/ajax here
        window.setTimeout(function () {
            $('.fake-autofill-fields').hide();
        },1);
	
  $("#submit").on('click' , function(){
    var name=$('#name').val();
	var username=$('#username').val();
    var age=$('#age').val();
    var email=$('#email').val();
    var password=$('#password').val();
	if(!/[A-Za-z_0\-9.]@[A-Za-z.].[A-Za-z]/.test(email)){
		alert('email invalido');
	}
	else{
		if (name == "" ||username==""|| age == null||email=="" || password == "")
      alert("All fields must be filled for registration");
    else if (age<18) {
      alert('You must be 18 or older to register');
    }
    else {
    var userData =
    {
	  'dicionario':'createUser',
      'name':name,
	  'username':username,
      'age':age,
      'email':email,
      'password':password
    }
    $.ajax({
		type: "POST",
		url: "userController.php",
		contentType: "application/json",
		dataType: "json",
		data: JSON.stringify(userData)
		}).done(function(data) {
		 if(data.status == 'success'){
			document.location.href='index.php?page=login',true;
		 }
		 else if(data.status == 'userExists'){
			 alert('There is already an user registed with that username');
		 }
		 else if(data.status == 'serverIssues'){
			 alert('OOPS! It appears there is a problem with the server. We are trying to solve the issue as soon as possible');
		 }
		 
		}).fail(function(e) {
		console.log(e);
	});

  }
	}
    
  });

  $("#cancel").on('click' , function(){
    document.location.href='index.php?page=home',true;
  });
  
 
  
  
});