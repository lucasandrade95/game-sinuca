<template>
  <q-page style="margin:auto; max-width:650px">
    <div class="section-page bg-white q-mt-lg" style="border-radius: 15px">
      <div class="full-width">
        <div class="text-center q-mt-xl q-pb-md">
          <img alt="Vieer" src="~assets/bilhar.png" style="width:100px; max-height:190px; margin:auto;" />
          <h5 class="no-margin text-primary">O Jogo</h5>
        </div>
        <q-card v-if="dados_tabela.length === 0 " class="text-primary text-center q-pa-lg">
          <div>Nenhuma tabela cadastrada :(</div>
          <div>
            <q-btn outline rounded color="primary" to="/tabela">Cadastrar Tabela</q-btn>
          </div>
        </q-card>
        <div class="q-pa-md">
          <q-table
              title="Times vinculado a tabela"
              :data="dados_tabela"
              :columns="columns"
              row-key="nome"
          />
        </div>

        <div class="q-pa-md">
          <q-table
              grid
              title="Tabela"
              :data="dados_tabela"
              :columns="columns"
              row-key="name"
              :filter="filter"
              hide-header
          >
            <template v-slot:top-right>
              <q-input borderless dense debounce="300" v-model="filter" placeholder="Procurar">
                <template v-slot:append>
                  <q-icon name="search" />
                </template>
              </q-input>
            </template>
          </q-table>
        </div>

      </div>
    </div>
  </q-page>
</template>

<script>
import axios from "axios";
import {Loading, Notify} from "quasar";

export default {
  data () {
    return {
      filter: '',
      columns: [
        {
          name: 'nome',
          required: true,
          label: 'Nome',
          align: 'left',
          field: row => row.nome,
          sortable: true
        },
        { name: 'desc_premiacao', align: 'center', label: 'Descrição da Premiação', field: row => row.desc_premiacao, sortable: true },
        { name: 'pontuacao', label: 'Pontuação do Prêmio', field: row => row.pontuacao, sortable: true },
        { name: 'desc_regras', label: 'Regras de Pontuação', field: row => row.desc_regras }
      ],
      dados_time: [],
      dados_tabela: []
    }
  },
  mounted() {
    this.getTimes();
    this.getTabelas();
  },
  methods: {
    getTimes () {
      const t = this;
      axios.get('http://127.0.0.1/game-sinuca/php/get-times.php').then((response) => {
        t.dados_time = response.data;
      })
    },
    getTabelas () {
      const t = this;
      axios.get('http://127.0.0.1/game-sinuca/php/get-tabela.php').then((response) => {
        t.dados_tabela = response.data;
        // response.data.filter( function (el) {
        //   for (let d = 0; d < t.dados_time.length; d++) {
        //     const result = el.includes(t.dados_time[t].id);
        //   }
        // });
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
