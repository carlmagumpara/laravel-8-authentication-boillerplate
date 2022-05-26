$(document).ready(function() {

  $(document).on("click", "#profileImage, .profile-photo-icon", function () {
    $("#imageUpload").click();
  });

  function fasterPreview(uploader) {
    if (uploader.files && uploader.files[0]) {
      $('#profileImage').attr('src', window.URL.createObjectURL(uploader.files[0]));
      $('#uploadPhotoButton').removeClass('d-none');
    }
  }

  $(document).on("change", "#imageUpload", function () {
    fasterPreview(this);
  });

  $(document).on("click", "#uploadPhotoButtonReset", function () {
    const profile_photo = $('#profileImage');
    profile_photo.attr('src', profile_photo.data('original'));
    $('#uploadPhotoButton').addClass('d-none');
    $('#imageUpload').val('');
  });

  $(function () {
    $('[data-toggle="popover"]').popover();
  });

  $(document).on("click", ".delete", function () {
     const url = $(this).data('url');
     const title = $(this).data('title');
     $('#title-delete').html(title);
     $('#confirm-delete').attr('href', url);
  });

  $(document).on("click", ".status", function () {
    const url = $(this).data('url');
    const title = $(this).data('title');
    $('#title-status').html(title);
    $('#confirm-status').attr('href', url);
  });

  $(document).on("keyup", ".search-data", async function (e) {
    e.preventDefault();
    const url = $(this).data('url');
    const target = $(this).data('target') || '#datas';
    const response = await axios.get(url+(window.location.href.indexOf('?archived=true') > -1 ? '&' : '?')+'search='+$(this).val());
    $(target).html(response.data);
  });

  $(document).on("click", ".pagination a", async function (e) {
    e.preventDefault();
    const target = $('.search-data').data('target') || '#datas';
    showLoader();
    const response = await axios.get(e.target.href);
    hideLoader();
    window.history.pushState("", "", e.target.href);
    window.scrollTo({ top: 0, behavior: 'smooth' });
    $(target).html(response.data);
  });

  $(document).on("click", ".as-link", function (e) {
    const url = $(this).data('url');
    window.location.href = url;
  });

  $(document).on("click", ".notification-toogle", async function (e) {
    e.preventDefault();
    const url = $(this).data('url');
    await axios.get(url);
    $(this).find($('.badge-counter')).html(0);
  });

  window.objectifyForm = function(formArray) {
    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
  }

  window.showLoader = function() {
    $('#loading').removeClass('d-none');
  };

  window.hideLoader = function() {
    $('#loading').addClass('d-none');
  };

  $(document).on("submit", "form", async function (e) {
    if ($(this).data('ajax')) {
      const submit_button = $(this).find($('button[type="submit"]'));
      const original_button_text = submit_button.html();
      submit_button.html('Loading...');
      submit_button.attr('disabled', 'disabled');
      $('input, select, textarea').removeClass('is-invalid');
      $('.invalid-feedback').remove();
      e.preventDefault();
      showLoader();
      const data = new FormData($(this)[0]);
      try {
        const response = await axios.post($(this).attr('action'), data);

        if (response.data.success) {
          if (response?.data?.dont_show_alert) {
            if (response.data.redirect_url) {
              if ($('.search-data').length) {
                updateTable();
              } else {
                window.location.href = response.data.redirect_url;
              }
            }
          } else {
            new swal({
              title: response.data?.title || 'Success!',
              text: response.data.message,
              icon: response.data?.icon || '',
              imageUrl: response.data?.imageUrl || '',
              imageWidth: 400,
              confirmButtonText: response.data?.confirmButtonText || 'OK',
            }).then(function() {
              if (response.data.redirect_url) {
                if ($('.search-data').length) {
                  updateTable();
                } else {
                  window.location.href = response.data.redirect_url;
                }
              }
            });
          }
        } else {
          new swal(
            response.data?.title || 'Error!',
            submit_button.data('validation') || response.data.message,
            response.data?.result || '',
          )
        }
        hideLoader();
        submit_button.html(original_button_text);
        submit_button.removeAttr('disabled');
      } catch (error) {
        console.log(error)
        if (error && error.response && error.response.status === 422) {
          if (submit_button.data('validation')) {
            new swal(
                submit_button.data('validation'),
                // 'question'
            )
          } else {
            const errors = error.response.data.errors;
            const formatter = new Intl.ListFormat('en', { style: 'long', type: 'conjunction' });
            Object.keys(errors).map(key => {
              const orig_key = key;
              if (orig_key.split('.').length !== 1) {
                key = key.split('.').map((_key, index) => index ? `[${_key}]` : _key).join('');
              }
              if ($('input[name="'+key+'"]') && !$('input[name="'+key+'"]').hasClass('no-error-validation')) {
                $('input[name="'+key+'"]').addClass('is-invalid');
                $('<div id="'+key+'" class="invalid-feedback">'+formatter.format(errors[orig_key])+'</div>').insertAfter($('input[name="'+key+'"]'));
              }
              if ($('textarea[name="'+key+'"]') && !$('textarea[name="'+key+'"]').hasClass('no-error-validation')) {
                $('textarea[name="'+key+'"]').addClass('is-invalid');
                $('<div id="'+key+'" class="invalid-feedback">'+formatter.format(errors[orig_key])+'</div>').insertAfter($('textarea[name="'+key+'"]'));
              }
              if ($('select[name="'+key+'"]') && !$('select[name="'+key+'"]').hasClass('no-error-validation')) {
                $('select[name="'+key+'"]').addClass('is-invalid');
                $('<div id="'+key+'" class="invalid-feedback">'+formatter.format(errors[orig_key])+'</div>').insertAfter($('select[name="'+key+'"]'));
              }
            });
          }
        }
        hideLoader();
        submit_button.html(original_button_text);
        submit_button.removeAttr('disabled');
      }
    }
  });
      
  async function updateTable() {
    const target = $('.search-data').data('target') || '#datas';
    showLoader();
    const response = await axios.get(window.location.href);
    hideLoader();
    $('.modal').modal('hide');
    $(target).html(response.data);
  };

  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    let w=window.open();
    w.document.write(printContents);
    w.print();
    w.close();
  };

  $(document).on("click", ".print", function (e) {
    printDiv('print-content');
  });

  $(document).on("click", "#confirm-reserve", function (e) {
    $('#reserve-form').submit();
  });

  $(document).on("change keyup paste", '.duplicate', function () {
    $('input[name="'+$(this).attr('name')+'"]').val($(this).val());
  });

  function fullHeight() {
    $('.js-fullheight').css('height', $(window).height());
    $(window).resize(function(){
      $('.js-fullheight').css('height', $(window).height());
    });
  };

  fullHeight();

  $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

  $('.copy-input').on('click', function () {
    const copyText = $($(this).data('target'));
    copyText.select();
    document.execCommand("copy");

    const Toast = swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: `${$(this).data('text')} Copied Successfully`,
    });

  });
});