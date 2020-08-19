<template>
    <div>
        <div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Adicionar ítem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row pt-2">
                            <div class="col-md-8 mb-3">
                                <label for="item_nome">Nome</label>
                                <input type="text" class="form-control" id="item_nome" name="item_nome" placeholder="Digite um nome para o ítem" v-model="itemNome">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="item_preco">Preço</label>
                                <money-input class="form-control text-right" id="item_preco" name="item_preco" @update:text="textUpdate"></money-input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_descricao">Descrição</label>
                            <textarea class="form-control" id="item_descricao" name="item_descricao" rows="3" v-model="itemDescricao"></textarea>
                        </div>
                        <transition name="fade">
                            <div class="alert alert-danger" role="alert" v-if="errorMsg">
                                {{ errorMsg }}
                                <button type="button" class="close" @click="errorMsg=''">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </transition>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" @click="storeItem()">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        

        mounted() {
            
        },

        props: ['estabelecimento', 'apiToken'],

        data: function () {
            return {
                itemNome: '',
                itemDescricao: '',
                itemPreco: '0.00',
                maskedPreco: 'R$ 0,00',
                apiResponse: {requestObject: ''},
                errorMsg: '',
            }
        },

        methods: {

            textUpdate: function (value) {
                this.itemPreco = value.rawText;
                this.maskedPreco = value.maskedText;
            },

            getItem() {
                return {
                    estabelecimento: this.estabelecimento,
                    nome: this.itemNome,
                    preco: this.itemPreco,
                    descricao: this.itemDescricao,
                };
            },

            getAuthHeader() {
                return {
                    headers: {
                        'Authorization': 'Bearer ' + this.apiToken
                    }
                }
            },

            storeItem() {
                if (this.itemNome.trim().length == 0 ) {
                    this.errorMsg = 'Digite o nome do ítem';
                    return;
                }

                this.errorMsg = '';
                axios.post('/api/item', this.getItem())
                    .then(response => {
                        this.apiResponse = response.data.url;
                        window.history.go();
                    })
                    .catch(error => {
                        this.errorMsg = error.response.data.message;
                    });
            },
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .2s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>