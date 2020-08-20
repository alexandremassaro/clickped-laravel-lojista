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
                    <select class="form-control form-control-sm">
                        <option>Mostrar todos</option>
                        <option>Pendentes</option>
                        <option>Preparando</option>
                        <option>Entregando</option>
                        <option>Finalizados</option>
                        </select>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="text-center" v-if="loading">
                <img src="/images/loading.gif"/>
            </div>
            <div class="row justify-content-center" v-if="!loading">
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
                            <tr v-for="pedido in this.pedidos" v-bind:key="pedido.id"
                             data-toggle="modal" data-target="#pedidoModal" @click="selectedPedido = pedido">
                                <th class="text-center" scope="row" v-text="pedido.id"></th>
                                <td class="text-center" v-text="pedido.status"></td>
                                <td v-text="pedido.mesa"></td>
                                <td v-text="pedido.cliente"></td>
                                <td v-text="pedido.items[0].nome"></td>
                                <td class="text-center" v-text="pedido.items[0].quantidade">2</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-dark py-0 px-1" style="width: 1.5rem; height: 1.5rem"><i class="fas fa-print"></i></button>
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
                <h5 class="modal-title" id="pedidoModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Código do pedido: {{ selectedPedido.id }} - Local: {{ selectedPedido.mesa }}</p>
                <p>Cliente: {{ selectedPedido.cliente }}</p>
                <p>Status: {{ selectedPedido.status }}</p>
                <p>Ítens pedidos: </p>
                <ul>
                    <li v-for="item in selectedPedido.items" v-bind:key="item.id">
                        {{ item.quantidade }}x {{ item.nome }} - {{ getCurrencyString(item.preco) }} <br/> 
                        <div v-if="item.observacao">Observação: {{ item.observacao }} <br/></div>
                        <div v-if="item.opcaos">
                            Opcionais:
                            <ul>
                                <li v-for="opcao in item.opcaos" v-bind:key="opcao.id">
                                    {{ opcao.nome }} - {{ getCurrencyString(opcao.preco) }}
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
        }
    },

    mounted() {
        this.loading = true;
        this.getPedidos();
    },

    methods: {

        alerta(texto) {
            alert(texto);
        },

        getCurrencyString(valor) {
            //return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(parseFloat(valor));
            return parseFloat(valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
        },

        getPedidos() {
            axios.get('/api/pedidos/recentes', {params: {
                                                    estabelecimento: this.estabelecimento, 
                                                }})
                    .then(response => {
                        this.pedidos = response.data.pedidos;
                        this.loading = false;
                    })
                    .catch(error => {
                        //console.log(error.response.data.message);
                        //this.item.nome = error.response.data.message;
                        this.loading = false;
                    });
             
            setTimeout(() => { this.getPedidos(); }, 60000);

        },
    },
    
}
</script>