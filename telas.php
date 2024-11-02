<?php
function CarregaTelaInserir() {

    echo '<!-- Modal Adicionar -->

    <div class="modal fade" id="telaModalInserir" tabindex="-1" role="dialog" aria-labelledby="telaModalInserirLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="telaModalInserirLabel">Adicionar título</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate id="form_inserir">

                        <div class="input-group input-group-sm mb-3">
                            <span for="form_ins_descricao" class="input-group-text" id="inputGroup-sizing-sm">Descrição</span>
                            <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm" id="form_ins_descricao" name="form_ins_descricao" required>                            
                            <div class="invalid-tooltip">Informe a descrição.</div>
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <input class="form-check-input me-2" type="checkbox" 
                                id="form_ins_prefixado" name="form_ins_prefixado" />
                            <label class="form-check-label" for="prefixado_inserir">Taxa prefixada</label>
                        </div>

                        <div class="input-group input-group-sm mb-3" id="divpercent_cdi">
                            <span class="input-group-text" id="inputGroup-sizing-sm">% do CDI</span>
                            <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm"
                                id="form_ins_percent_cdi" name="form_ins_percent_cdi">
                        </div>

                        <div class="input-group input-group-sm mb-3" id="divtaxa_aa">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Taxa a.a.</span>
                            <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm"
                                id="form_ins_taxa_aa" name="form_ins_taxa_aa">
                        </div>

                        <div class="input-group input-group-sm mb-3">
                            <input class="form-check-input me-2" type="checkbox" 
                              id="form_ins_isento_ir" name="form_ins_isento_ir" />
                            <label class="form-check-label" for="isento_ir">Isento IR</label>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-lg btn-success btn-block btn-sm" type="submit"
                              id="Submit_Inserir"  name="Submit_Inserir">Salvar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Adicionar -->';
}

function CarregaTelaEditar() {

    echo '<!-- Modal Editar -->

    <div class="modal fade" id="telaModalEditar" tabindex="-1" role="dialog" aria-labelledby="telaModalEditarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="telaModalEditarLabel">Editar</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="TelaInternaDoEditarContainer">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-lg btn-success btn-block btn-sm" id="Submit_Editar" name="Submit_Editar">Salvar</button>
          </div>          
        </div>
      </div>
    </div>	

    <!-- Modal Editar -->';	
}

function CarregaTelaExcluir() {

  echo '<!-- Modal Excluir -->
  <div class="modal fade" id="telaModalExcluir" tabindex="-1" role="dialog" aria-labelledby="telaModalExcluirLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="telaModalExcluirLabel">Confirmação de Exclusão</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <h6 class="my-0 text-danger">Você tem certeza que deseja excluir este item?</h6>

              <div class="modal-footer">
                 <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                 <button type="button" class="btn btn-lg btn-success btn-block btn-sm" id="Submit_Excluir" name="Submit_Excluir">Confirmar</button>
              </div>
        </div>
      </div>
    </div>
  </div>	


    <!-- Modal Excluir -->';
}


function CarregaItensLista($user_data, $valor_investir, $prazo_meses, $taxa_selic){
    $idmodelo = $user_data['idmodelo'];
    $retorno = CalcularRendimentos($user_data, $valor_investir, $prazo_meses, $taxa_selic);

    $is_prefixado = $retorno['is_prefixado'];
    $is_isento_ir = $retorno['is_isento_ir'];    
    $taxa_aa = $retorno['taxa_aa'];
    $percent_cdi = $retorno['percent_cdi'];
    $valor_futuro = $retorno['valor_futuro'];
    $taxa_aplicada = $retorno['taxa_aplicada'];
    $lucro_bruto = $retorno['lucro_bruto'];
    $valor_ir = $retorno['valor_ir'];
    $lucro_liquido = $retorno['lucro_liquido'];
    $total_liquido = $retorno['total_liquido'];
    $status_ativo = $retorno['status_ativo'];
    $status_isento = $retorno['status_isento'];

    echo "<tr>";
    echo "<td>".$user_data['descricao']."</td>";
    echo "<td>".$percent_cdi."</td>";
    
    echo "<td>".number_format((float)$taxa_aplicada, 2)."</td>";    
    echo "<td>".number_format((float)$valor_futuro, 2)."</td>";    
    echo "<td>".number_format((float)$lucro_bruto, 2)."</td>";    
    echo "<td>".number_format((float)$valor_ir, 2)."</td>";    
    echo "<td>".number_format((float)$lucro_liquido, 2)."</td>";    
    echo "<td>".number_format((float)$total_liquido, 2)."</td>"; 
    

    echo '<td>                
    <button class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#telaModalEditar" data-id="'.$idmodelo.'" >Editar</button>		  			
    <button class="btn btn-danger  btn-sm" data-toggle="modal" data-target="#telaModalExcluir" data-id="'.$idmodelo.'">Excluir</button>
    </td>';		

    echo "</tr>";       
}

function CarregaTelaEditarSelic($taxa_selic) {

    echo '<!-- Modal Editar Selic -->

    <div class="modal fade" id="telaModalEditarSelic" tabindex="-1" role="dialog" aria-labelledby="telaModalEditarSelicLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="telaModalEditarSelicLabel">Atualizar Taxa Selic</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" id="form_taxa_AtualizaSelic">
              
                <div class="input-group input-group-sm mb-3" id="div_edit_taxa_selic">
                <span class="input-group-text" id="inputGroup-sizing-sm">Taxa Selic</span>
                <input type="text" class="form-control" aria-describedby="inputGroup-sizing-sm" id="form_edit_taxa_selic" name="form_edit_taxa_selic" value="'.$taxa_selic.'">
                </div>
				
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-lg btn-success btn-block btn-sm" type="submit" id="Submit_AtualizaSelic" name="Submit_AtualizaSelic">Salvar</button>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>	

    <!-- Modal Editar Selic -->';	
}



?>