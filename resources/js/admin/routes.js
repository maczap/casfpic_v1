import AppHome from './index'
import AppDash from './dash'
import AppPromotores from './promotores'
import AppSocios from './socios'

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
          
]


