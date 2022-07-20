$(document).ready(function(){

    $('#table-produto').on('click', 'button.btn-delete', function(e){
        e.preventDefault()

        let ID = `ID=${$(this).attr('id')}`

        Swal.fire({
            title: 'Você tem certeza que deseja excluir este produto?',
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
                    data: dados,
                    url: 'src/produto/model/delete-produto.php',
                    success: function(dados){
                          Swal.fire({
                            title: dados.mensagem,
                            icon: dados.tipo,
                            confirmButtonText: 'Ok'
                          })
                          $('#table-produto').DataTable().ajax.reload()
                    }
                })
            }
        })
    })
})