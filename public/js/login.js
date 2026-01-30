$(function(){
  $('#btnLogin').on('click', function(e){
    e.preventDefault();
    var user = $('#inputUser').val().trim();
    var pass = $('#inputPass').val().trim();
    var $error = $('#loginError');
    $error.text('');
    if(!user || !pass){
      $error.text('Ingrese usuario y contraseña');
      return;
    }
    $.ajax({
      url: window.BASE_URL + '/login?action=login',
      type: 'POST',
      dataType: 'json',
      data: {user: user, pass: pass},
      success: function(resp){
        if(resp.status === 'OK'){
          // Si el backend devuelve un redirect, úsalo
          if(resp.redirect){
            window.location.href = resp.redirect;
          }else{
            window.location.href = '/www.sistemaclinico2.com/home';
          }
        }else{
          $error.text(resp.message || 'Usuario o contraseña incorrectos');
        }
      },
      error: function(){
        $error.text('Error de conexión o servidor.');
      }
    });
  });
});
