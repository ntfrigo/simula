$(document).ready(function(){

  $('#Submit_AtualizaSelic').click(function(e){
    e.preventDefault();
    RotinaParaAtualizaTaxaSelic();
  });

  $('#Submit_Inserir').click(function(e){
    e.preventDefault();
    RotinaParaInserirTitulo();
  });
  
    
let itemId;

$('#telaModalEditar').on('show.bs.modal', function (event) {
  const button = $(event.relatedTarget);
  itemId = button.data('id');
  CarregaDadosEditar(itemId);
});

$('#Submit_Editar').on('click', function () {
  
  RotinaParaEditarTitulo();
  
  //EnviarParaTela('excluir.php', '#telaModalExcluir', { form_del_idmodelo: itemId });
});


function CarregaDadosEditar(itemId) {    
  $('#form_editar').remove();

  $.ajax({
    url: 'consulta.php',
    type: 'POST',
    data: { form_edit_idmodelo: itemId },
    success: function(data) {

      $idmodelo = itemId;
      $is_prefixado = data.prefixado;
      $descricao = data.descricao;
      $taxa_aa = data.taxa_aa;
      $percent_cdi = data.percent_cdi;
      $status_ativo = data.ativo == "S" ? 'checked' : '';
      $status_isento = data.isento_ir == "S" ? 'checked' : '';
    
      if ($is_prefixado == "S") 
      {
    $bloco = '            <div class="input-group input-group-sm mb-3" id="div_edit_taxa_aa">'+
    '            <span class="input-group-text" id="inputGroup-sizing-sm">Taxa a.a.</span>'+
    '            <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm" id="form_edit_taxa_aa" name="form_edit_taxa_aa" value=' + $taxa_aa + '>'+
    '            <input type="hidden" class="form-control" id="form_edit_percent_cdi" name="form_edit_percent_cdi" value=0>'+
    '            </div>';
      }
      else{
    $bloco = '            <div class="input-group input-group-sm mb-3" id="div_edit_percent_cdi">'+
    '            <span class="input-group-text" id="inputGroup-sizing-sm">% CDI</span>'+
    '            <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm" id="form_edit_percent_cdi" name="form_edit_percent_cdi" value=' +  $percent_cdi + '>'+
    '            <input type="hidden" class="form-control" id="form_edit_taxa_aa" name="form_edit_taxa_aa" value=0>'+
    '            </div>';
      }
    
      let Elm =
    '     <div id="form_editar">'+
    '            <input class="form-control" value="' + $idmodelo + '"     id="form_edit_idmodelo"  name="form_edit_idmodelo"  type="hidden"> 	'+
    '            <input class="form-control" value="' + $is_prefixado + '" id="form_edit_prefixado" name="form_edit_prefixado" type="hidden"> 	'+
    '            <div class="input-group input-group-sm mb-3">'+
    '                <span class="input-group-text" id="inputGroup-sizing-sm">Descrição</span>'+
    '                <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm" id="form_edit_descricao" name="form_edit_descricao" value="' + $descricao + '" required autofocus>'+
    '                <div class="invalid-feedback">Informe a descrição.</div>'+
    '            </div>'+
    $bloco +
    '            <div class="input-group input-group-sm mb-3">'+
    '                 <input class="form-check-input me-2" type="checkbox" name="form_edit_isento_ir" id="form_edit_isento_ir" ' + $status_isento + ' />'+
    '                 <label class="form-check-label" for="form_edit_isento_ir">Isento IR</label>'+
    '            </div>'+
    '            <div class="input-group input-group-sm mb-3">'+
    '                 <input class="form-check-input me-2" type="checkbox" name="form_edit_ativo" id="form_edit_ativo" ' + $status_ativo + ' />'+
    '                 <label class="form-check-label" for="form_edit_ativo">Ativo</label>'+
    '            </div>'+
    '      </div>';
    
    document.getElementById("TelaInternaDoEditarContainer").innerHTML = Elm;

    },
    error: function(data) {
        //$('#resultado').html('Erro ao buscar dados.');
        return;
    }
});









  //toastElm.append(Elm);
}




$('#telaModalExcluir').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    itemId = button.data('id');
});

$('#Submit_Excluir').on('click', function () {
  EnviarParaTela('excluir.php', '#telaModalExcluir', { form_del_idmodelo: itemId });
});



});






function RotinaParaEditarTitulo(){
  const edit_idmodelo = $('#form_edit_idmodelo').val();
  const edit_prefixado = $('#form_edit_prefixado').is(':checked') ? 'S' : 'N';
  
  const edit_descricao = $('#form_edit_descricao').val().trim();
  const edit_percent_cdi = $('#form_edit_percent_cdi').val();
  const edit_taxa_aa = $('#form_edit_taxa_aa').val();
  const edit_isento_ir = $('#form_edit_isento_ir').is(':checked') ? 'S' : 'N';
  const edit_ativo = $('#form_edit_ativo').is(':checked') ? 'S' : 'N';

  if (edit_descricao == "") {
    fireNotif(message = 'Informe a descrição do titulo', icon = 'error', delay = 5000)
  }
  else{
    EnviarParaTela('editar.php', '#telaModalEditar', { 
      form_edit_idmodelo: edit_idmodelo, 
      form_edit_prefixado: edit_prefixado, 
      form_edit_descricao: edit_descricao, 
      form_edit_percent_cdi: edit_percent_cdi, 
      form_edit_taxa_aa: edit_taxa_aa,
      form_edit_isento_ir: edit_isento_ir,
      form_edit_ativo: edit_ativo    
    } );
  }

}

function RotinaParaInserirTitulo(){
  const ins_descricao = $('#form_ins_descricao').val().trim();
  const ins_prefixado = $('#form_ins_prefixado').is(':checked') ? 'S' : 'N';
  const ins_percent_cdi = $('#form_ins_percent_cdi').val();
  const ins_taxa_aa = $('#form_ins_taxa_aa').val();
  const ins_isento_ir = $('#form_ins_isento_ir').is(':checked') ? 'S' : 'N';

  if (ins_descricao == "") {
    fireNotif(message = 'Informe a descrição do titulo', icon = 'error', delay = 5000)
  }
  else{
    EnviarParaTela('inserir.php', '#telaModalInserir', { 
      form_ins_descricao: ins_descricao, 
      form_ins_prefixado: ins_prefixado, 
      form_ins_percent_cdi: ins_percent_cdi, 
      form_ins_taxa_aa: ins_taxa_aa, 
      form_ins_isento_ir: ins_isento_ir  } );
  }

}

function RotinaPAraAtualizaTaxaSelic(){
  const valor_taxa_selic = $('#form_edit_taxa_selic').val().trim();
  if (valor_taxa_selic % 1 && valor_taxa_selic > 0.00) {
    EnviarParaTela('atualizar.php', '#telaModalEditarSelic', { form_edit_taxa_selic: valor_taxa_selic } );
  }
  else{
    fireNotif(message = 'Informe o valor da taxa da selic!', icon = 'error', delay = 5000)
  }
}



function EnviarParaTela(destino, tela, valor){
  $.ajax({
    type: 'POST',
    url: destino,
    data: valor,
    success: function (data) {
      $(tela).modal('hide');                  
      fireNotif(message = data.message, icon = data.icon, delay = 5000)
      recarrega();
    },
    error: function (data) {
        $(tela).modal('hide');
        fireNotif(message = data.message, icon = data.icon, delay = 5000)
    }
});
}





function recarrega(){
  setTimeout(function(){
    location.reload();
}, 3000);
}

(function () {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })




    var form = $('#form_inserir'),
    checkbox = $('#form_ins_prefixado'),
    divpercent_cdi = $('#divpercent_cdi'),
    divtaxa_aa = $('#divtaxa_aa');

    divpercent_cdi.show();
    divtaxa_aa.hide();

checkbox.on('click', function() {
    if($(this).is(':checked')) {
      divtaxa_aa.show();
      divtaxa_aa.find('input').attr('required', true);
      divpercent_cdi.hide();
      divpercent_cdi.find('input').attr('required', false);
    } else {
      divpercent_cdi.show();
      divpercent_cdi.find('input').attr('required', true);
      divtaxa_aa.hide();
      divtaxa_aa.find('input').attr('required', false);
    }
})

})()

