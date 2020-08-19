<template>
    <div>
        <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="addOpcaoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="addOpcaoModalLabel">Adicionar opção</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row pt-2">
                            <div class="col-md-8 mb-3">
                                <label for="opcao_nome">Nome</label>
                                <input type="text" class="form-control" id="opcao_nome" name="opcao_nome" placeholder="Digite um nome para a opção" v-model="novaOpcaoNome">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="opcao_preco">Preço</label>
                                <money-input class="form-control text-right" id="opcao_preco" name="opcao_preco" @update:text="textUpdate"></money-input>
                            </div>
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
                        <button type="button" class="btn btn-primary" @click="storeOpcao()">Salvar</button>
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

        props: ['complemento', 'estabelecimento', 'id'],

        data: function () {
            return {
                novaOpcaoNome: '',
                novaOpcaoPreco: '0.00',
                maskedPreco: 'R$ 0,00',
                apiResponse: {requestObject: ''},
                errorMsg: '',
            }
        },

        methods: {

            textUpdate: function (value) {
                this.novaOpcaoPreco = value.rawText;
                this.maskedPreco = value.maskedText;
            },

            getOpcao() {
                return {
                    estabelecimento: this.estabelecimento,
                    complemento: this.complemento,
                    nome: this.novaOpcaoNome,
                    preco: this.novaOpcaoPreco,
                };
            },

            storeOpcao() {
                if (this.novaOpcaoNome.trim().length == 0 ) {
                    this.errorMsg = 'Digite o nome da opção';
                    return;
                }

                this.errorMsg = '';
                axios.post('/api/opcao', this.getOpcao())
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