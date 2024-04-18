
function excluirNoticia(idNoticia) {
  
  Swal.fire({
    title: 'Confirmar exclusao?',
    text: `Excluir noticia?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, deletar!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = URL_SITE+'/admin/noticias/excluir/'+idNoticia
    }
  })
}

$('[data-acao="deletar-noticia"]').on('click', function(e) {
  e.preventDefault();
  let id = $(this).attr('data-id');
  excluirNoticia(id)
});

$('[data-acao="deletar-fotoCapa"]').on('click', function(e) {
  e.preventDefault();
  let idNoticia   = $(this).attr('data-idNoticia')
  let nomeArquivo = '/foto-capa/'+$(this).attr('data-nome')
  let midia = $(this).closest('.noticia-img');
  Swal.fire({
    title: 'Confirmar exclusao?',
    text: `Excluir midia?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, deletar!'
  }).then((result) => {
    if (result.isConfirmed) {
      jQuery.ajax({
        type: "POST",
        data : {
          idNoticia,
          nomeArquivo
        },
        url: URL_SITE+"/app/servicos/noticias/excluir-midia.php",
        dataType : "json",
        success: function(data){
          if(data.sucesso){
            Swal.fire({
              title: data.mensagem, 
              icon: 'success'});
            //REMOVE O A BOX DA MÍDIA
            midia.remove();
          }else{
            alert(data.mensagem, 'error');
          }
        },
        error: function(data){
        }
      });
    }
  })
});

