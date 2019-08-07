// Inicialização de Plugins
$('.select2').select2()

$('.date-picker').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
    todayBtn: true,
    language: 'pt-BR',
    todayHighlight: true
})

// Functions
function confirmDelete(itemId) {
    Swal.fire({
        title: 'Atenção',
        text: 'Deseja realmente excluir o registro selecionado?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, excluir!',
        reverseButtons: true
    }).then(result => {

        if (result.value) {
            $('#btn-delete-'+ itemId).submit()
        }
    })
}