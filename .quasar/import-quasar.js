/**
 * THIS FILE IS GENERATED AUTOMATICALLY.
 * DO NOT EDIT.
 *
 * You are probably looking on adding startup/initialization code.
 * Use "quasar new boot <name>" and add it there.
 * One boot file per concern. Then reference the file(s) in quasar.conf.js > boot:
 * boot: ['file', ...] // do not add ".js" extension to it.
 *
 * Boot files are your "main.js"
 **/

import lang from 'quasar/lang/pt-br'

import iconSet from 'quasar/icon-set/line-awesome'


import Vue from 'vue'

import {Quasar,QTable,QTh,QTr,QTd,Loading,Notify,Dialog,Screen} from 'quasar'


Vue.use(Quasar, { config: {},lang: lang,iconSet: iconSet,components: {QTable,QTh,QTr,QTd},plugins: {Loading,Notify,Dialog,Screen} })
