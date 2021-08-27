<template>
    <div>
        <div class="cookie">
            
                <img src="images/cookie.png " alt="lgpd" class="d-none d-sm-block" />
                <p class="d-none d-sm-block">Nós utilizamos cookies e outras tecnologias semelhantes para melhorar sua experiência em nossos serviços, personalizar nossa publicidade e recomendar conteúdo de seu interesse.</p>
                <p>Ao utilizar nossos serviços, você aceita a política de monitoramento de cookies. Para mais informações, consulte nossa <a href="https://casfpic.org.br/termos"> Política de cookies</a>. <button type="button" class="btn btn-primary" @click="setCookie">Ciente</button></p>
        </div>
    </div>
</template>

<script>
export default {
    methods: {

        setCookie(){
            $(".cookie").css('display','none');
        }
    }
    
}
</script>

<style scoped>

</style>