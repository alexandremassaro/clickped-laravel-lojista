<template>
    <div>
        <div class="modal fade" :id="id" tabindex="-1" role="dialog" aria-labelledby="addComplementoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="addComplementoModalLabel">Adicionar complemento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome" class="col-form-label">Nome do complemento:</label>
                            <input type="text" class="form-control" id="nome" name="nome" v-model="complementoNome">

                            <div class="form-inline justify-content-between pt-2">
                                <label for="max">Quantas opções o cliente pode escolher?</label>
                                <select class="custom-select" id="max" v-model="max">
                                    <option disabled>Quantas opções o cliente pode escolher?</option>
                                    <option v-for="qtd in quantidade" v-bind:value="qtd.value" v-bind:key="qtd.value">{{ qtd.text }}</option>
                                </select>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="obrigatorio" id="obrigatorio" title="Obrigatório" v-model="obrigatorio">
                                    <label class="form-check-label" for="obrigatorio">Obrigatório</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="opcao_nome">Adicionar opções:</label>
                            <div class="form-inline justify-content-between pt-2">
                                <input type="text" class="form-control" id="opcao_nome" name="opcao_nome" placeholder="Digite um nome para a opção" v-model="novaOpcaoNome" style="width: 17rem;">
                                <money-input class="form-control text-right" id="opcao_preco" name="opcao_preco" @update:text="textUpdate" style="width: 9rem;"></money-input>
                                <button type="button" @click="addOpcao(novaOpcaoNome, novaOpcaoPreco, maskedPreco)" class="btn btn-primary">+</button>
                            </div>
                        </div>
                            <ul class="list-group py-2">
                                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="opcao in opcoes" v-bind:key="opcao.nome">
                                    {{ opcao.nome }}
                                    <div>
                                        <span class="badge badge-primary">{{ opcao.maskedPreco }}</span>
                                        <div class="btn-group btn-group-sm pl-2" role="group" aria-label="...">
                                            <button type="button" class="btn btn-outline-danger" @click="removeOpcao(opcao)"><i class="far fa-trash-alt"></i></button>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                            
                            <div class="alert alert-warning" role="alert" v-if="opcoes.length == 0">
                                Nenhuma opção foi adicionada!
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
                        <button type="button" class="btn btn-primary" @click="storeComplemento()">Salvar</button>
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

        props: ['item', 'estabelecimento', 'id'],

        data: function () {
            return {
                max: '1',
                complementoNome: '',
                novaOpcaoNome: '',
                novaOpcaoPreco: '0.00',
                maskedPreco: 'R$ 0,00',
                quantidade: [],
                opcoes: [],
                apiResponse: {requestObject: ''},
                obrigatorio: true,
                errorMsg: '',
            }
        },

        methods: {

            textUpdate: function (value) {
                this.novaOpcaoPreco = value.rawText;
                this.maskedPreco = value.maskedText;
            },

            addQuantidade: function() {
                this.quantidade.push({value: this.quantidade.length+1, text: this.quantidade.length+1});
                this.max = this.quantidade.length;
            },

            addOpcao: function(nome, preco, maskedPreco) {
                if (nome.trim().length == 0) {
                    this.errorMsg = 'Digite um nome para a opção';
                    return;
                }
                this.errorMsg = '';
                this.opcoes.push({nome: nome, preco: preco, maskedPreco: maskedPreco});
                this.addQuantidade();
                this.novaOpcaoNome = '';
                this.novaOpcaoPreco = '0.00';
                this.maskedPreco = 'R$ 0,00'
            },

            removeOpcao: function(opcao) {
                this.opcoes.splice(this.opcoes.indexOf(opcao), 1);
            },

            getMin() {
                return this.obrigatorio ? 1 : 0;
            },

            getComplemento() {
                return {
                    estabelecimento: this.estabelecimento,
                    item: this.item,
                    nome: this.complementoNome,
                    min: this.getMin(),
                    max: this.max,
                    opcoes: this.opcoes,
                };
            },

            storeComplemento() {
                if (this.complementoNome.trim().length == 0 ) {
                    this.errorMsg = 'Digite o nome do complemento';
                    return;
                } else if (this.opcoes.length == 0) {
                    this.errorMsg = 'Adicione ao menos uma opção para o complemento';
                    return;
                }

                this.errorMsg = '';
                axios.post('/api/complemento', this.getComplemento())
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