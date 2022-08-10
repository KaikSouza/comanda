$(document).ready(function(){

    $('#table-empresa').on('click', 'button.btn-delete', function(e){
        e.preventDefault()

        let ID = `ID=${$(this).attr('id')}`

        Swal.fire({
            title: 'Você tem certeza que deseja excluir este registro?',
            icon: 'question',
            showCancelButton: true,
            conffirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then(result => {
            if(result.value){
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    assync: true,
                    data: ID,
                    url: 'src/empresa/model/delete-empresa.php',
                    success: function(dados){
                          Swal.fire({
                            title: dados.mensagem,
                            icon: dados.tipo,
                            confirmButtonText: 'Ok'
                          })
                          $('#table-empresa').DataTable().ajax.reload()
                    }
                })
            }
        })
    })
})
