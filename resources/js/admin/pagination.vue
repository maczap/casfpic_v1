<template>

    <div class="row" style='margin-top:-10px;'>
        <div class="col s12">
            <ul class="pagination right" >
                <li  v-if="currentPage > 0" class = 'grey lighten-3 '>
                    <a href = '#' class = 'btn grey lighten-3' @click.prevent="navigate1()" > < </a>
                </li>            

                <li class="waves-effect" :class="{active: n -1 == active}"  v-for="n in parseInt(totalPages)" v-if="Math.abs(n - currentPage) < 3 || n == totalPages - 1 || n == 0">
                    <a href="#!" @click.prevent="navigate(n -1)" >{{n}}</a>
                </li>

                <li  v-if="currentPage < totalPages - 1 " >
                    <a href = '#' class = 'btn grey lighten-3'  @click.prevent="navigate2()" >	> </a>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
    export default {

        props: [
            'totalPerPage',
            'resource',

        ],
        data: function (){

            return {
                active: 0,
                total: 4,
                            
            }
        },
        computed:{
            listaFiltered(){
                return this.$parent.listaFiltered
            },

            totalRegistries () {
                return this.$parent.listaFiltered.length
            },
            totalPages () {
            return Math.ceil(this.$parent.resultCount / this.$parent.itemsPerPage)


            },
            currentPage () {
                return this.$parent.currentPg
            }
        },
        methods:{
            navigate: function (n){

                this.active = n;
                this.$parent.currentPg = n;

            },
            navigate1: function (){

                this.active = this.$parent.currentPg - 1;
                this.$parent.currentPg = this.$parent.currentPg -1;

            },
            navigate2: function (){

                this.active = this.$parent.currentPg + 1;
                this.$parent.currentPg = this.$parent.currentPg +1;

            }                        
        }

        
    }
</script>
  
  <style scoped>
  .pagination li.active {
    background-color: #263238;
    }
  </style>