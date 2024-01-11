import { computed } from 'vue'
import { createApiInstance } from '../api'
import { useServiceUrl } from '../store/serviceUrl'

// inserted at build time
const FALLBACK_SERVICE_API_URL: string = import.meta.env.VITE_SERVICE_API_URL

export const useApi = () => {
  const store = useServiceUrl()

  const url = computed(() =>
    store.serviceUrl.value && !store.serviceUrl.value.includes('localhost')
      ? store.serviceUrl.value
      : FALLBACK_SERVICE_API_URL,
  )

  if (!url.value) console.error('[Microfront] Service API URL is not defined!')

  return computed(() => createApiInstance(url.value))
}
