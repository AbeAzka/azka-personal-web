const tombolSapa = document.getElementById('sapaButton');
tombolSapa.addEventListener('click', function(){
  //alert('Halo! Terima kasih sudah berkunjung!');
  Swal.fire({
    title: 'Halo!',
    text: 'Terima kasih sudah berkunjung!',
    icon: 'success', // 'success', 'error', 'warning', 'info', 'question'
    confirmButtonText: 'OK'
  });
});


