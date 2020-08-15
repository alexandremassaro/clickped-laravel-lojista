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
                                    <option v-for="qtd in quantidade" v-bind:value="qtd.value">{{ qtd.text }}</option>
                                </select>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="obrigatorio" id="obrigatorio" title="Obrigatório" v-model="obrigatorio">
                                    <label class="form-check-label" for="obrigatorio">Obrigatório</label>
                                </div>
                            </div>
                            
                            <label class="col-form-label">Adicionar opções:</label>
                            
                            <div class="form-inline justify-content-between pt-2">
                                <input type="text" class="form-control" id="opcao_nome" name="opcao_nome" placeholder="Digite um nome para a opção" v-model="novaOpcaoNome" style="width: 17rem;">
                                
                                <money-input class="form-control text-right" id="opcao_preco" name="opcao_preco" @update:text="textUpdate" style="width: 9rem;"></money-input>
                                <button type="button" @click="addOpcao(novaOpcaoNome, novaOpcaoPreco, maskedPreco)" class="btn btn-primary">+</button>
                                
                            </div>
                            <div class="row" v-for="opcao in opcoes" v-bind:key="opcao.nome">
                                <div class="col">{{ opcao.nome }}</div>
                                <div class="col">{{ opcao.maskedPreco }}</div>
                            </div>
                            <p v-text="errorMsg"></p>
                            <p v-text="maskedPreco"></p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" @click="storeComplemento(complementoNome)">Salvar</button>
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

        props: ['component_route', 'item', 'estabelecimento', 'id'],

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
                this.opcoes.push({nome: nome, preco: preco, maskedPreco: maskedPreco});
                this.addQuantidade();
                this.novaOpcaoNome = '';
                this.novaOpcaoPreco = '0.00';
                this.maskedPreco = 'R$ 0,00'
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

            storeComplemento(nome) {
                axios.post(this.component_route, this.getComplemento())
                    .then(response => {
                        console.log(response.data);
                        this.apiResponse = response.data.url;
                        window.location.href = response.data.url;
                    })
                    .catch(error => {
                        console.log(error.response.data.message);
                        this.errorMsg = error.response.data.message;
                    });
            },
        }
    }
</script>