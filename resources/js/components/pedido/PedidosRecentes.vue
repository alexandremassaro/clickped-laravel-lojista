<template>
<div>
    <div class="card">
        <div class="card-header navbar">
            <div class="row w-100 justify-content-between">
                <div class="col-md-5">
                    <div class="h4 p-0 m-0">
                        Pedidos Recentes
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-control form-control-sm" v-model="selectedStatus">
                        <option value="All">Mostrar todos</option>
                        <option value="Pendente">Pendentes</option>
                        <option value="Preparando">Preparando</option>
                        <option value="Entregando">Entregando</option>
                        <option value="Finalizado">Finalizados</option>
                        <option value="Cancelado">Cancelados</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="text-center" v-if="loading">
                <img src="/images/loading.gif"/>
            </div>
            <div class="row justify-content-center" v-else>
                <div class="col">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col">Mesa</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Pedido</th>
                            <th scope="col" class="text-center">Quantidade</th>
                            <th scope="col" class="text-center">Imprimir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pedido in this.pedidos" v-bind:key="pedido.id" @click="selectedPedido = pedido">
                                <th class="text-center" scope="row" v-text="pedido.id"
                             data-toggle="modal" data-target="#pedidoModal" style="cursor:pointer;"></th>
                                <td class="text-center" v-text="pedido.status"
                             data-toggle="modal" data-target="#pedidoModal" style="cursor:pointer;"></td>
                                <td v-text="pedido.mesa"
                             data-toggle="modal" data-target="#pedidoModal" style="cursor:pointer;"></td>
                                <td v-text="pedido.cliente"
                             data-toggle="modal" data-target="#pedidoModal" style="cursor:pointer;"></td>
                                <td v-text="pedido.items[0].nome"
                             data-toggle="modal" data-target="#pedidoModal" style="cursor:pointer;"></td>
                                <td class="text-center" v-text="pedido.items[0].quantidade"
                             data-toggle="modal" data-target="#pedidoModal" style="cursor:pointer;">2</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-dark py-0 px-1" style="width: 1.5rem; height: 1.5rem" title="Imprimir Pedido"><i class="fas fa-print"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pedidoModal" tabindex="-1" role="dialog" aria-labelledby="pedidoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pedidoModalLabel">{{ selectedPedido.cliente }} - Local: {{ selectedPedido.mesa }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-2">Código:</dt>
                    <dd class="col-10">{{ selectedPedido.id }}</dd>
                    <dt class="col-2">Local:</dt>
                    <dd class="col-10">{{ selectedPedido.mesa }}</dd>
                    <dt class="col-2">Cliente:</dt>
                    <dd class="col-10">{{ selectedPedido.cliente }}</dd>
                    <dt class="col-2">Status:</dt>
                    <dd class="col-10">
                        <select class="form-control form-control-sm" v-model="selectedPedido.status">
                            <option v-for="(key, val) in selectedPedido.statusOptions" :key="val" :value="val"> {{key}} </option>
                        </select>
                    </dd>
                </dl>

                <div class="card">
                    <div class="card-header">
                        <div class="row w-100 justify-content-between align-middle">
                            <div class="col align-middle my-0 py-0">
                                <div class="h4 mt-2">
                                    Ítens pedidos:
                                </div>
                            </div>
                            <div class="col-1 my-0 py-0">
                                <button class="btn btn-outline-dark" title="Imprimir Pedido">
                                    <i class="fas fa-print"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-body">
                        <table class="table mb-0 pb-0">
                            <thead>
                                <tr>
                                <th scope="col">Qtde</th>
                                <th scope="col">Ítem</th>
                                <th scope="col">Preço Un.</th>
                                <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in selectedPedido.items" v-bind:key="item.id" class=" mb-0 pb-0">
                                    <th scope="row">{{ item.quantidade }}</th>
                                    <td>{{ item.nome }}</td>
                                    <td>{{ getCurrencyString(item.preco) }}</td>
                                    <td>{{ getCurrencyString(item.preco * item.quantidade) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-for="item in selectedPedido.items" v-bind:key="item.id">
                            <div v-if="item.opcaos">
                                <div class="row" v-for="opcao in item.opcaos" v-bind:key="opcao.id">
                                    <div class="col">{{ opcao.nome }}</div>
                                    <div class="col">{{ getCurrencyString(opcao.preco) }}</div>
                                </div>
                            </div>
                            <dl v-if="item.observacao" class="row mx-3">
                                <dt class="col-2">Obs:</dt>
                                <dd class="col">{{ item.observacao }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="changeStatus(selectedPedido.id, selectedPedido.status)">Save changes</button>
            </div>
            </div>
        </div>
    </div>
</div>    
</template>
<script>
export default {

    props: ['estabelecimento'],

    data: function() {
        return {
            pedidos: [],
            loading: true,
            errorMsg: '',
            selectedPedido: {},
            selectedStatus: 'All',
        }
    },

    mounted() {
        this.loading = true;
        this.getPedidos();
        this.timerReloadPedidos();
    },

    watch: {
        selectedStatus() {
            this.getPedidos();
        }
    },

    methods: {

        alerta(texto) {
            alert(texto);
        },

        getCurrencyString(valor) {
            //return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(parseFloat(valor));
            return parseFloat(valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        },

        timerReloadPedidos() {
            setTimeout(() => { 
                this.getPedidos(); 
                this.timerReloadPedidos();
            }, 60000);
        },

        getPedidos() {
            //setTimeout(() => {
            axios.get('/api/pedidos/recentes', {params: {
                                                    estabelecimento: this.estabelecimento,
                                                    selectedStatus: this.selectedStatus
                                                }})
                .then(response => {
                    this.pedidos = response.data.pedidos;
                    //this.pedidos = response.data;
                    //console.log(this.pedidos);
                    this.loading = false;
                })
                .catch(error => {
                    //console.log(error.response.data.message);
                    //this.item.nome = error.response.data.message;
                    console.log(error.response.data.message);
                    this.loading = false;
                });
            //},2000);
        },

        changeStatus(pedido_id, status) {
            axios.post('/api/pedido/status', { estabelecimento: this.estabelecimento, pedido: pedido_id, status: status})
                .then(response => {
                    var resposta = response.data.pedido;
                    this.getPedidos();
                    $('#pedidoModal').modal('hide')
                })
                .catch(error => {
                    console.log(error.response.data.message);
                    this.getPedidos();
                });
        },
    },
    
}
</script>