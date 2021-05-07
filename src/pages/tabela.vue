<template>
  <q-page style="margin:auto; max-width:350px">
    <div class="section-page bg-white q-mt-lg" style="border-radius: 15px">
      <div class="full-width">
        <div class="text-center q-mt-xl">
          <img alt="Vieer" src="~assets/tabela.png" style="width:80px; max-height:190px; margin-top: 15px;" />
          <h5 class="no-margin text-primary">Cadastrar Tabela</h5>
        </div>
      </div>
      <div class="q-pa-md text-white" style="margin:auto;">
        <div class="text-h6 text-center"></div>
<!--        <q-form @submit="onSubmit">-->
          <q-form>

          <q-input
              class="q-mb-sm"
              outlined rounded
              bg-color="white" type="text"
              v-model="form.nomeTabela" label="Nome da tabela"
              :rules="[ val => val && val.length > 0 || 'Digite o nome da Tabela correspondente']"
              :error="formerro.nomeTabela.length > 0" :error-message="formerro.nomeTabela">
            <template v-slot:prepend>
              <q-icon name="las la-table" />
            </template>
          </q-input>

          <q-input
              class="q-mb-sm"
              outlined rounded
              bg-color="white" type="text"
              v-model="form.desc_premiacao" label="Premiação da Tabela (descrição)"
              :rules="[ val => val && val.length > 0 || 'Digite a descrição do Prêmio']"
              :error="formerro.desc_premiacao.length > 0" :error-message="formerro.desc_premiacao">
            <template v-slot:prepend>
              <q-icon name="las la-trophy" />
            </template>
          </q-input>

          <q-input
              class="q-mb-sm"
              outlined rounded
              bg-color="white" type="number"
              v-model="form.pontuacao" label="Pontuação do prêmio"
              :rules="[ val => val && val.length > 0 || 'Digite a pontuação do prêmio']"
              :error="formerro.pontuacao.length > 0" :error-message="formerro.pontuacao">
            <template v-slot:prepend>
              <q-icon name="las la-dice" />
            </template>
          </q-input>

          <q-input
              class="q-mb-sm"
              outlined rounded
              bg-color="white" type="text"
              v-model="form.desc_regras" label="Regra de Pontuação (descrição)"
              :rules="[ val => val && val.length > 0 || 'Digite a regra de pontuação']"
              :error="formerro.desc_regras.length > 0" :error-message="formerro.desc_regras">
            <template v-slot:prepend>
              <q-icon name="las la-edit" />
            </template>
          </q-input>

          <div class="q-pl-sm">
            <h6 class="text-primary no-margin">Times</h6>
            <div v-if="options.length === 0" class="q-pa-lg">
              <div class="text-primary">
                Sem times cadastrados!<br/>
               <q-btn outline rounded to="/times" color="primary">Cadastrar Time</q-btn>
              </div>
            </div>
            <q-option-group
                v-model="group"
                :options="options"
                color="primay"
                type="checkbox"
                class="text-primary"
            />
          </div>

        </q-form>
        <div class=" flex justify-around text-center q-gutter-lg">
          <div class="col">
            <transition appear enter-active-class="animated slideInRight" leave-active-class="animated fadeOut">
              <q-btn outline rounded color="primary" @click="setTabela()">Salvar</q-btn>
            </transition>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>
<script>
import RegisterCourse from "./courses/register";
import axios from "axios";
import {Loading, Notify} from "quasar";

export default {
  data () {
    return {
      allData: '',
      isPwd: true,
      form: {
        nomeTabela: '',
        desc_premiacao: '',
        pontuacao: '',
        desc_regras: '',
        times: []
      },
      formerro: {
        nomeTabela: '',
        desc_premiacao: '',
        pontuacao: '',
        desc_regras: '',
        times: []
      },
      group: [''],
      options: [],
      values: []
    }
  },
  mounted() {
    this.getTimes();
  },
  methods: {
    getTimes () {
      const t = this;
      axios.get('http://127.0.0.1/game-sinuca/php/get-times.php').then((response) => {
        for (let i = 0; i < response.data.length; i++) {
          t.options.push({
                label: response.data[i].nome,
                value: response.data[i].id
              });
        }
      })
    },
    setTabela() {
      const comp = this
      Loading.show();

      const data = {
        nomeTabela: this.form.nomeTabela,
        desc_premiacao: this.form.desc_premiacao,
        pontuacao: this.form.pontuacao,
        desc_regras: this.form.desc_regras,
        times: this.group.filter(function (el) {
          // el.replace(/[\\"]/g, '');
          return el !== "";
        }).toString()
      }

      if (this.form.nomeTabela === '' ||
          this.form.desc_premiacao === '' ||
          this.form.pontuacao === '' ||
          this.form.desc_regras === '') {
        Loading.hide()
        Notify.create({
          message: 'Preencha os campos!',
          icon: 'warning',
          color: 'orange',
          actions: [{ icon: 'close', color: 'white' }]
        })
      }
      if (data.times === '') {
        Loading.hide();
        Notify.create({
          message: 'Selecione ao menos um time!',
          icon: 'warning',
          color: 'orange',
          actions: [{ icon: 'close', color: 'white' }]
        })
      } else {
        axios.post('http://127.0.0.1/game-sinuca/php/cadastro-tabela.php', data).then((response) => {
          debugger;
          Loading.hide()
          const e = response.data
          if (response.statusText === 'ERRO') {
            Notify.create({
              message: 'Tabela não cadastrado!',
              icon: 'warning',
              color: 'orange',
              actions: [{icon: 'close', color: 'white'}]
            })
          } else {
            Notify.create({
              message: 'Tabela ' + e.nome + ' criado com sucesso!',
              icon: 'warning',
              color: 'positive',
              actions: [{icon: 'close', color: 'white'}]
            })
            setTimeout(function() {
              Notify.create({
                message: 'Visualize as pontuações!',
                icon: 'warning',
                color: 'orange',
                actions: [{icon: 'close', color: 'white'}]
              })
              comp.$router.push('/pontuacoes')
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
