
export default {
    session_id(context){

        const newLocal = 'setSessionId';
    
        axios.get('/getsession').then(response => {
            if(response.data){
                console.log(response.data);
                context.commit(newLocal, response.data);
            }
        });           

    },
    get_plan(context, dados){
        const newLocal = 'getPlan';
        axios.get('/getplan/'+dados.plano+"/"+dados.periodo).then(response => {
            if(response.data){
                context.commit(newLocal, response.data[0]);
                console.log(response.data[0])
            }
        });           
    }    
}