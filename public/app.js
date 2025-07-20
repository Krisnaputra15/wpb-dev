$('.money-input').on('input', function() {
    let value = $(this).val();

    value = value.replace(/[^0-9]/g, '');

    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    $(this).val(value);
});

tinymce.init({
    selector: '.editor',
    license_key: 'gpl',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
});

function initializeSelect2(id, placeholder){
    $(`#${id}`).select2({
        placeholder: placeholder,
        width: '100%'
    });
}

// const quill = new Quill('.editor', {
//     theme: 'snow'
// });
function formatRupiah(angka) {
    return new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0
    }).format(angka);
  }

  function isHexColorLight(hex) {
    hex = hex.replace('#', '');

    if (hex.length == 3) {
      hex = hex.split('').map(c => c + c).join('');
    }

    const r = parseInt(hex.substr(0, 2), 16);
    const g = parseInt(hex.substr(2, 2), 16);
    const b = parseInt(hex.substr(4, 2), 16);

    const brightness = 0.299 * r + 0.587 * g + 0.114 * b;

    return brightness > 100;
  }
