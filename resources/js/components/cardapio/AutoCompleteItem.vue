<template>
    <div style="position: relative">
        <p class="pt-2 mt-2"><strong>Ítem selecionado:&nbsp;</strong><span v-text="selectedItem"></span></p>
        
        <label for="nome" class="col-form-label">Nome do item:</label>
        <input type="text" class="form-control" id="nome" name="nome" autocomplete="off" v-model="itemNome" @focus="modal = true">
        <input type="hidden" class="form-control" id="id" name="id" v-model="itemId">
        <ul class="list-group dropdown-menu" style="z-index: 10; width: 100%" v-if="filteredItems && modal">
            <li type="button" class="list-group-item list-group-item-action" v-for="filteredItem in filteredItems" @click="setItem(filteredItem)" v-bind:key="filteredItem.id">
                {{ filteredItem.nome }}
            </li>
        </ul>
        
    </div>
</template>

<script>
export default {
    props : ['estabelecimento', 'cardapio', 'categoria'],

    data: function() {
        return {
            itemNome: '',
            itemId: -1,
            modal: false,
            filteredItems: [],
            items: [],
            selectedItem: 'Selecione um ítem da lista'
        }
    },

    mounted() {
        this.getItems();
        this.filterItems();
    },

    methods: {

        filterItems() {
            if (this.itemNome.length == 0) {
                this.filteredItems = this.items;
            }

            this.filteredItems = this.items.filter(item => {
                return item.nome.toLowerCase().includes(this.itemNome.toLowerCase());
            });

            if (this.filteredItems.length != 1) this.itemId = -1;
        },

        setItem(item) {
            this.itemNome = item.nome;
            this.itemId = item.id;
            this.selectedItem = this.itemNome;
            this.modal = false;
        },

        getItems() {
            this.items= [];
            this.itemNome = 'Carregando...'
            axios.get('/api/items/autocomplete', {params: {
                                                    estabelecimento: this.estabelecimento, 
                                                    cardapio: this.cardapio,
                                                    categoria: this.categoria
                                                }})
                    .then(response => {
                        this.items = response.data.items;
                        console.log({estabelecimento: this.estabelecimento, cardapio: this.cardapio, categoria: this.categoria})
                        console.log(this.items);
                        this.itemNome = '';
                    })
                    .catch(error => {
                        console.log(error.response.data.message);
                        this.item.nome = error.response.data.message;
                    });

        },
    },

    watch: {
        itemNome() {
            this.filterItems();
        }
    }
}
</script>