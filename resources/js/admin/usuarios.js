
function excluirUsuario(nome, idUsuario) {
  
  Swal.fire({
    title: 'Confirmar exclusao?',
    text: `Excluir ${nome}?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, deletar!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = window.location.origin+'/admin/usuarios/excluir/'+idUsuario
    }
  })
}

$('[data-acao="deletar-usuario"]').on('click', function(e) {
  e.preventDefault();
  let id = $(this).attr('data-id')
  let nome = $(this).attr('data-nome')
  excluirUsuario(nome, id)
});

