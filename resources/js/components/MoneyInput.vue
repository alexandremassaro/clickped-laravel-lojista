<template>
    <input 
        type="text"
        placeholder="R$ 0,00"
        v-model="maskedText"
        :id = "id"
        :name = "name"
    >
</template>

<script>
    export default {
        mounted() {
            
        },

        props: ['id', 'name'],

        data: () => {
            return {
                maskedText: 'R$ 0,00',
                rawText: '0.00',
            }
        },

        methods: {
            textChanged: function (value) {
                this.$emit('update:text', {rawText: this.rawText, maskedText: this.maskedText});
            }
        },

        watch: {
            maskedText() {
                this.rawText = this.maskedText.replace(/[^0-9]/g, '').substr(0, 10);

                while (this.rawText.substr(0, 1) == '0')
                    this.rawText = this.rawText.substr(1, this.rawText.length - 1);

                while (this.rawText.length < 3)
                    this.rawText = '0' + this.rawText;
                
                this.rawText = this.rawText.substr(0, this.rawText.length - 2) + '.' + this.rawText.substr(this.rawText.length - 2, 2);
                    
                this.maskedText = this.rawText.replace('.', ',');
                this.maskedText = 'R$ ' + this.maskedText;
                this.textChanged(this.rawText);
                    
            }
        },

    }
</script>
