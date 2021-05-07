<template>
  <q-layout view="lHh Lpr lFf" style="background: #9045e8">
    <q-header style="background: #9045e8" class="no-padding">
      <q-toolbar class="justify-between">
        <q-btn to="/" class="row" rounded flat style="color: white; font-family: 'Leelawadee UI',serif" no-caps>
<!--          <q-img src="~/assets/simbolos/oie_transparent.png" style="width: 55px;margin-top: 12px;margin-right: -15px;"></q-img>-->
          <div style="font-size: 15px" class="q-mr-sm">G &nbsp; A &nbsp; M &nbsp; E</div>
          <q-separator vertical dark spaced/>
          <div style="font-family: 'Leelawadee UI', serif; font-size: 8px">J O G O &nbsp; S I N U C A</div>
        </q-btn>
        <div class="justify-end row">
          <q-btn to="/pontuacoes" class="row" rounded flat style="color: white; font-weight: bold; font-family: 'Leelawadee UI',serif" no-caps>
            <div>Pontuações</div>
          </q-btn>
          <q-btn to="/times" class="row" rounded flat style="color: white; font-weight: bold; font-family: 'Leelawadee UI',serif" no-caps>
            <div>Times</div>
          </q-btn>
          <q-btn to="/tabela" class="row" rounded flat style="color: white; font-weight: bold; font-family: 'Leelawadee UI',serif" no-caps>
            <div>Tabelas</div>
          </q-btn>
        </div>
      </q-toolbar>
    </q-header>
    <q-page-container>
        <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import { date } from 'quasar'

export default {
  name: 'MainLayout',

  data () {
    return {
      leftDrawerOpen: false
    }
  },
  computed: {
    todaysDate () {
      const timeStamp = Date.now()
      return date.formatDate(timeStamp, 'dddd, D MMMM')
    }
  }
}
</script>

<style lang="scss">
  .header-image {
    height: 100%;
    z-index: -1;
    opacity: 0.4;
  }
  .button-floating {
    position: fixed;
    top: 419.5px;
    width: 50px;
    height: 100px;
    border: none;
    border-radius: 0px 90px 90px 0px;
    z-index: 1003;
    background-color: rgb(102, 23, 203);
    cursor: pointer;
    display: table;
  }
  .button-floating-gift {
    color: rgb(255, 255, 255);
  }
</style>
