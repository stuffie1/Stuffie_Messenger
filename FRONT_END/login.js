
function showlogin(){
 $login=document.getElementById("login");
 $register=document.getElementById("register");
 $login.style.display="block";
 $register.style.display="none";
}
function showregister(){
 $login=document.getElementById("login");
 $register=document.getElementById("register");
 $login.style.display="none";
 $register.style.display="block";
}
document.addEventListener('DOMContentLoaded', function() {
  var checkbox = document.querySelector('.ui-switch input');
  var body = document.querySelector('body');
  var login = document.querySelector('#login');
  var but = document.querySelector('#button');
  var but0 = document.querySelector('#button0');
  var but1 = document.querySelector('#button1');
  var but4 = document.querySelector('#button4');
  var register = document.querySelector('#register');
  var inp = document.querySelector('.form__field');

  checkbox.addEventListener('change', function() {
    if (this.checked) {
      body.style.backgroundColor = '#f4f0f4'; 
      login.style.backgroundColor = '#f4f0f4'; 
      login.style.boxShadow = '0px 0px 0px rgba(0, 0, 0, 0)'; 
      register.style.boxShadow = '0px 0px 0px rgba(0, 0, 0, 0)'; 
      but.classList.add("button2");
      but0.classList.add("button2");
      but1.classList.add("button3");
      but4.classList.add("button3");
      inp.classList.add("form__field1");
      inp.classList.remove("form__field");
      register.style.backgroundColor = '#f4f0f4'; 
    } else {
      but.classList.remove("button2");
      but0.classList.remove("button2");
      but1.classList.remove("button3");
      but4.classList.remove("button3");
      body.style.backgroundColor = '#0c1211'; 
      login.style.backgroundColor = '#0c1211'; 
      register.style.backgroundColor = '#0c1211'; 
      inp.classList.remove("form__field1");
      inp.classList.add("form__field");
    }
  });
});



