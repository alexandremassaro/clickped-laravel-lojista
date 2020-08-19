<template>
    <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="addComplementoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addComplementoModalLabel">Adicionar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form :action="form_action" method="POST">
                    <input type="hidden" name="_token" :value="csrf_token">
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <auto-complete-item :estabelecimento="estabelecimento" :cardapio="cardapio" :categoria="categoria"></auto-complete-item>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['id', 'form_action', 'csrf_token', 'estabelecimento', 'cardapio', 'categoria'],

    mounted: function() {
        
    },
    
}
</script>