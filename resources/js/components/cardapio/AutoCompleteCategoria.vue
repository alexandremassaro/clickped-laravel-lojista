<template>
    <div style="z-index: 0; position:relative">
        <input type="text" class="form-control" style="z-index: 10;" id="nome" name="nome" autocomplete="off" v-model="categoria" @focus="modal = true" >
        <ul class="list-group dropdown-menu" style="z-index: 10; width: 100%" v-if="filteredCategorias && modal">
            <li type="button" class="list-group-item list-group-item-action" v-for="filteredCategoria in filteredCategorias" @click="setCategoria(filteredCategoria)">
                {{ filteredCategoria }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props : ['estabelecimento', 'cardapio'],

    data: function() {
        return {
            categoria: '',
            modal: false,
            filteredCategorias: [],
            categorias: [],
        }
    },

    mounted() {
        this.getCategorias();
        this.filterCategorias();
    },

    methods: {

        filterCategorias() {
            if (this.categoria.length == 0) {
                this.filteredCategorias = this.categorias;
            }

            this.filteredCategorias = this.categorias.filter(categoria => {
                return categoria.toLowerCase().startsWith(this.categoria.toLowerCase());
            });
        },

        setCategoria(categoria) {
            this.categoria = categoria;
            this.modal = false;
        },

        getCategorias() {
            this.categorias= [];
            this.categoria = 'Carregando...'
            axios.get('/api/categorias/autocomplete', {params: {estabelecimento: this.estabelecimento, cardapio: this.cardapio}})
                    .then(response => {
                        this.categorias = response.data.categorias;
                        this.categoria = '';
                    })
                    .catch(error => {
                        console.log(error.response.data.message);
                    });

        },
    },

    watch: {
        categoria() {
            this.filterCategorias();
        }
    }
}
</script>