$(document).ready(function(){

    $('.btn-save').click(function(e){
        e.preventDefault()

        let dados = $('#form-empresa').serialize()

        dados += `&operacao=${$('.btn-save').attr('data-operation')}`

        $.ajax({
            type: 'POST',
            dataType: 'json',
            assync: true,
            data: dados,
            url: 'src/empresa/model/save-empresa.php',
            success: function(dados){
                const Toast = Swal.mixin({
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
                    icon: dados.tipo,
                    title: dados.mensagem
                  })
                  $('#modal-empresa').modal('hide')
                  $('#table-empresa').DataTable().ajax.reload()
            }
        })
    })
})