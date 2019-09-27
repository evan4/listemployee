
import { minLenght, checkReg } from './checkForm';

const require = "Заполните поле";

$.ajaxSetup({
  dataType: "json",
  headers: {
    'X-CSRF-Token': $('input[name="_token"]').val()
  },
  type: "POST"
});

// изменение статуса задачи
$('.status').on('change', function(){
  const id = +$(this).attr('id').split('-')[1];
  const status = $(this).find(":selected").val();
  
  if(id >= 0){
    $.ajax({
      url: '/admin/task-update',
      data: {
        id,
        status
      },
      type: "PUT",
      beforeSend: function() {
        $(this).prop("disabled", true);
      }
    })
    .done((res) => {
      console.log(res);
      if(res.success){
        $('.alert-success').removeClass('d-none')
          .find('p').text('Статус задачи обновлен');
      }else{
        showDangerAlert();
      }
      $(this).prop("disabled", false);
      
    })
    .fail(()=> {
      showDangerAlert();
    })
  }
})

// создание новой звдачи
$('.newtask').on('submit', function (e) {
  e.preventDefault();

  let fValid = true;
  
});

// удаление задачи
$('.task-delete').on('click', function(e){
  e.preventDefault();
  const id = +$(this).attr('id').split('-')[1];
  console.log(id);
  if(id >= 0){
    $.ajax({
      url: `/admin/task-delete/${id}`,
      type: "DELETE",
      beforeSend: function() {
        $(this).prop("disabled", true);
      }
    })
    .done((res) => {
      console.log(res);
      if(res.success){
        $('.alert-success').removeClass('d-none')
          .find('p').text('Задача удалена');
        $(`#task-${res.id}`).closest('tr').remove();
      }else{
        showDangerAlert();
      }
      $(this).prop("disabled", false);
      
    })
    .fail(()=> {
      showDangerAlert();
    })
  }

});

function showDangerAlert() {
  $('.alert-danger').removeClass('d-none');
  setTimeout(() => {
    $('.alert-danger').addClass('d-none');
  }, 4000);
}
