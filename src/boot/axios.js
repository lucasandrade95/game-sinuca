import axios from 'axios'

const axiosInstance = axios.create({
  baseUrl: 'http://127.0.0.1/vieer/'
})

export default async ({ Vue }) => {
  Vue.prototype.$axios = axiosInstance
}

export { axiosInstance }
