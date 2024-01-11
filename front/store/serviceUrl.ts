import { computed, reactive } from 'vue'

const state = reactive({ serviceUrl: import.meta.env.VITE_SERVICE_API_URL as string })

const setServiceUrl = (url: string) => {
  console.log('Updated Core API URL to:', url)
  state.serviceUrl = url
}

const serviceUrl = computed(() => state.serviceUrl)

export const useServiceUrl = () => ({
  serviceUrl,
  setServiceUrl,
})
