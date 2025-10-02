import Swal from 'sweetalert2';
const tombolSapa = document.getElementById('sapaButton');
tombolSapa.addEventListener('click', function(){
  //alert('Halo! Terima kasih sudah berkunjung!');

  Swal.fire({
    title: 'Hello!',
    text: 'This is a basic SweetAlert2 message.',
    icon: 'success', // 'success', 'error', 'warning', 'info', 'question'
    confirmButtonText: 'OK'
  });
});


