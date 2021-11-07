
<template>
    <div>
        <div class="col-span-12 lg:col-span-10 bg-gray-100  lg:p-4">


            <div class="w-full shadow stats" v-if="balance.available">
                <div class="stat">
                    <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                    </svg>
                    </div> 
                    <div class="stat-title">Saldo atual</div> 
                    <div class="stat-value">{{balance.available.amount}}</div> 
                    
                </div> 
                <div class="stat">
                    <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">                
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>          
                    </svg>
                    </div> 
                    <div class="stat-title">A receber</div> 
                    <div class="stat-value">{{balance.waiting_funds.amount}}</div> 
                    
                </div> 
                <div class="stat">
                    <div class="stat-figure text-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-8 h-8 stroke-current">                 
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>         
                    </svg>
                    </div> 
                    <div class="stat-title">Transferido</div> 
                    <div class="stat-value">{{balance.transferred.amount}}</div> 
                    
                </div>
            </div>



        </div>
    </div>
</template>

<script>


export default {
    data: function(){
        return{
            balance:[],     
        }
    },    
    methods: {
        acao(){
            this.$store.dispatch('listaCadastros');
        },
        real(numero){
            
            return numero.toLocaleString('pt-br',{style: 'currency', currency: 'BRL', minimumFractionDigits: 1});
            // return new Intl.NumberFormat('pt-br', { style: 'currency', currency: 'BRL' }).format(numero);
        }
    },
    
    async mounted() {
        let set = this;
        axios.get('admin/dash/getbalance').then(response => {
            console.log(response.data);
            set.balance = response.data;
        });    
    },    
}
</script>

<style scoped>

</style>