
<template>
    <div>
        <div class="col-span-12 lg:col-span-10 bg-gray-100  lg:p-4">
            <div class="grid grid-cols-2 gap-2 p-2 md:p-0 mb-0 md:mb-4 md:grid-cols-4 lg:grid-cols-4 md:gap-2 lg:gap-4">
                <div class="h-20 md:h-40 mb-4 md:mb-0 md:p-4 bg-white shadow rounded-md">
                
                </div>
                <div class="h-20 md:h-40 mb-4 md:mb-0 md:p-4 bg-white shadow rounded-md">
                        
                </div>
                <div class="h-20 md:h-40 mb-4 md:mb-0 md:p-4 bg-white shadow rounded-md">
                        
                </div>
                <div class="h-20 md:h-40 mb-4 md:mb-0 md:p-4 bg-white shadow rounded-md">
                        
                </div>
            </div>

            <div class="grid sm:grid-cols-1 md:p-0  lg:grid-cols-2 gap-4" >
                <div class="bg-white  md:p-0 overflow-hidden">
                    <div class="header">
                            <h2 class="bg-gray-500 p-2 text-white font-semibold w-full rounded-b-sm m-0" @click="acao">Cadastros</h2>    
                    </div>
                    <div class="overflow-x-auto h-60">
                      
                    </div>

                </div>
                <div class="bg-white h-60 md:p-4 ">
                    <h2>Pendentes</h2>
                </div>
            </div>

            <div class="flex-none md:flex container md:flex-wrap p-2 ">
                <div class="md:flex-1 bg-white h-60 p-4 rounded-md mb-4">1</div>
                <div class="md:flex-1 bg-white h-60 p-4 rounded-md mb-4">1</div>
            </div>
        </div>
    </div>
</template>

<script>


export default {

    methods: {
        acao(){
            this.$store.dispatch('listaCadastros');
        }
    },
    
    async mounted() {
    //   await this.$store.dispatch('listaCadastros');
    },    
}
</script>

<style scoped>

</style>