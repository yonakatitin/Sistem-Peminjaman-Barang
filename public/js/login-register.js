$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
    var $this = $(this),
        label = $this.prev('label');
  
      if (e.type === 'keyup') {
        if ($this.val() === '') {
            label.removeClass('active highlight');
          } else {
            label.addClass('active highlight');
          }
      } else if (e.type === 'blur') {
        if( $this.val() === '' ) {
          label.removeClass('active highlight'); 
        } else {
          label.removeClass('highlight');   
        }   
      } else if (e.type === 'focus') {
        
        if( $this.val() === '' ) {
          label.removeClass('highlight'); 
        } 
        else if( $this.val() !== '' ) {
          label.addClass('highlight');
        }
      }
  
  });

  $(document).ready(function() {
    // Mengatur tab login atau sign up sebagai tab aktif berdasarkan halaman yang sedang diakses
    var currentUrl = window.location.href;

    if (currentUrl.indexOf('register/adminunit') !== -1) {
        // Jika halaman register/adminunit, aktifkan tab signupadmin
        var acttab = $('.tab .signupadmin');
    } else if (currentUrl.indexOf('register') !== -1) {
        // Jika halaman sign up, aktifkan tab sign up
        var acttab = $('.tab .signup');
    } else {
        // Jika halaman login atau halaman lainnya, aktifkan tab login
        var acttab = $('.tab .login');
    }

    // Menghapus class "active" dari tab yang tidak aktif
    $('.tab a').parent().removeClass('active');
    // Menambahkan class "active" pada tab yang aktif
    $(acttab).parent().addClass('active');

    // Menampilkan konten yang sesuai dengan tab yang aktif
    var target = $(acttab).attr('href');
    $('.tab-content > div').hide();
    $(target).fadeIn(600);
});

$('.tab a').on('click', function (e) {
    e.preventDefault();
    // Menghapus class "active" dari tab yang tidak aktif
    $('.tab a').parent().removeClass('active');
    // Menambahkan class "active" pada tab yang aktif
    $(this).parent().addClass('active');
    
    var target = $(this).attr('href');
    $('.tab-content > div').hide();
    $(target).fadeIn(600);
});






