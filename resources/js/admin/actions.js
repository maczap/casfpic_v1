
export default {
    
    listaCadastros(context){

        const newLocal = 'setCadastros';
        axios.get('admin/dash/cadastros').then(response => {
            console.log(response.data);
            context.commit(newLocal, response.data);
        });
    },
  
    
}