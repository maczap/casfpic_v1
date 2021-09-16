<template>

    <div class="grid grid-cols-12 relative" id="main1" >

        <div class="col-span-12 ">

          <div class="navbar mb-2 shadow-lg bg-neutral text-neutral-content rounded-box">
            <div class="flex-none hidden lg:flex">
              <button class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">           
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>               
                </svg>
              </button>
            </div> 
            <div class="flex-1 lg:flex  px-2 mx-2 ">
              <span class="text-lg font-bold hidden lg:block">
                      Gestão de Associados
              </span>
            </div> 
            <div class="flex-1 lg:flex-none">
              <div class="form-control">
                
              </div>
            </div> 
            <div class="flex-none">
              <button class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">             
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>             
                </svg>
              </button>
            </div> 
            <div class="flex-none">
              <button class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">     
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>                     
                </svg>
              </button>
            </div> 
            <div class="flex-none">
              <div class="avatar">
                <div class="rounded-full w-10 h-10 m-1">
                  <img src="https://i.pravatar.cc/500?img=32">
                </div>
              </div>
            </div>
            <div class="flex-none lg:hidden">
               
              <Burger ></Burger>
                
            </div>             
          </div>

        </div>
        

        <Menu></Menu>
   

        

        <div class="col-span-12 lg:col-span-10 bg-gray-100 lg:p-6">

            <router-view> 
               
            </router-view>
        </div>


    <Sidebar>
      <ul class="sidebar-panel-nav">
        <li>
          <a href="#home">Home</a>
        </li>
        <li>
          <a href="#about">About</a>
        </li>
        <li>
          <a href="#contact">Contact</a>
        </li>
      </ul>
    </Sidebar>        
 




    </div>    
</template>

<script>

import { VBreakpoint } from 'vue-breakpoint-component'

import Burger from './burger.vue'
import Menu from './menu.vue'
import Sidebar from './sidebar.vue'
export default {
     components:{
      Burger,
      Sidebar,
      Menu,
      VBreakpoint
     },        
}
</script>

<style scoped>
#main1{
  position: relative;
}

</style>