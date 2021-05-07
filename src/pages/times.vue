<template>
  <q-page style="margin:auto; max-width:350px">
    <div class="section-page bg-white q-mt-lg" style="border-radius: 15px">
      <div class="full-width">
        <div class="text-center q-mt-xl">
          <img alt="Vieer" src="~assets/time-2.png" style="width:100px; max-height:190px; margin:auto;" />
          <h5 class="no-margin text-primary">Cadastrar Time</h5>
        </div>
      </div>
      <div class="q-pa-md text-white" style="margin:auto;">
        <div class="text-h6 text-center"></div>
        <q-form>
          <q-input
              class="q-mb-sm"
              outlined rounded
              bg-color="white" type="text"
              v-model="form.nomeTime" label="Nome do time"
              :rules="[ val => val && val.length > 0 || 'Digite o nome do Time correspondente']"
              :error="formerro.nomeTime.length > 0" :error-message="formerro.nomeTime">
            <template v-slot:prepend>
              <q-icon name="las la-users" />
            </template>
          </q-input>

          <q-input
              class="q-mb-sm"
              outlined rounded
              bg-color="white" type="text"
              v-model="form.jogador1" label="Primeiro jogador"
              :rules="[ val => val && val.length > 0 || 'Digite o nome do Primeiro Jogador']"
              :error="formerro.jogador1.length > 0" :error-message="formerro.jogador1">
            <template v-slot:prepend>
              <q-icon name="las la-user" />
            </template>
          </q-input>

          <q-input
              class="q-mb-sm"
              outlined rounded
              bg-color="white" type="text"
              v-model="form.jogador2" label="Segundo jogador"
              :rules="[ val => val && val.length > 0 || 'Digite o nome do Segundo Jogador']"
              :error="formerro.jogador2.length > 0" :error-message="formerro.jogador2">
            <template v-slot:prepend>
              <q-icon name="las la-user-friends" />
            </template>
          </q-input>
        </q-form>
        <div class=" flex justify-around text-center q-gutter-lg">
          <div class="col">
            <transition appear enter-active-class="animated slideInRight" leave-active-class="animated fadeOut">
              <q-btn outline rounded color="primary" @click="send()">Salvar</q-btn>
            </transition>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
import {Loading, Notify} from "quasar";
import axios from "axios";

export default {
  data () {
    return {
      allData: '',
      isPwd: true,
      form: {
        nomeTime: '',
        jogador1: '',
        jogador2: ''
      },
      formerro: {
        nomeTime: '',
        jogador1: '',
        jogador2: ''
      }
    }
  },
  methods: {
    send () {
      const comp = this
      Loading.show()

      const data = {
        nomeTime: this.form.nomeTime,
        jogador1: this.form.jogador1,
        jogador2: this.form.jogador2
      }

      if (this.form.nomeTime === '' || this.form.jogador1 === ''|| this.form.jogador2 === '') {
        Loading.hide()
        Notify.create({
          message: 'Preencha os campos!',
          icon: 'warning',
          color: 'orange',
          actions: [{ icon: 'close', color: 'white' }]
        })
      } else {
        axios.post('http://127.0.0.1/game-sinuca/php/cadastro-time.php', data).then((response) => {
          Loading.hide()
          const e = response.data
          if (response.statusText === 'ERRO') {
            Notify.create({
              message: 'Time não cadastrado!',
              icon: 'warning',
              color: 'orange',
              actions: [{icon: 'close', color: 'white'}]
            })
          } else {
            Notify.create({
              message: 'Time ' + e.name + ' criado com sucesso!',
              icon: 'warning',
              color: 'positive',
              actions: [{icon: 'close', color: 'white'}]
            })
            setTimeout(function() {
              Notify.create({
                message: 'Agora crie a sua tabela!',
                icon: 'warning',
                color: 'orange',
                actions: [{icon: 'close', color: 'white'}]
              })
              comp.$router.push('/tabela')
            }, 2000);

            }
        }).catch(function (error) {
          Loading.hide()
          Notify.create({
            message: 'Surgiu algum problema, tente novamente',
            icon: 'warning',
            color: 'orange',
            actions: [{icon: 'close', color: 'white'}]
          })
          console.log(error)
        })
      }
    }
  }
}
</script>
