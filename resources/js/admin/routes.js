import AppHome from './index'
import AppDash from './dash'
import AppPromotores from './promotores'
import AppSocios from './socios'
import AppSplit from './split'

// import AppEntidades from './models/lista_entidades'
// import AppEmails from './models/lista_emails'

export default[
    {
        path: '/admin', component: AppDash
    },

    {
        path: '/admin/promotores', component: AppPromotores
    },
    {
        path: '/admin/associados', component: AppSocios
    },

    {
        path: '/admin/splits', component: AppSplit
    },    
          
]


