<template>
  <div id="micro-app">
    <router-view />
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { openCommunicationChannel } from 'bout'

import { useUser } from './store/user'
import { useIdentityToken } from './store/token'
import { useCoreApiUrl } from './store/coreApiUrl'

import { User } from './interfaces/User'
import { useServiceUrl } from './store/serviceUrl'

export default defineComponent({
  name: 'App',
  setup() {
    const { setUser } = useUser()
    const { setToken } = useIdentityToken()
    const { setCoreApiUrl } = useCoreApiUrl()
    const { setServiceUrl } = useServiceUrl()

    const mainChannel = openCommunicationChannel('Main')
    const tokenChannel = openCommunicationChannel('Token')

    mainChannel.on<{ coreUrl: string; serviceUrl: string; token: string; user: User }>(
      'init',
      ({ coreUrl, serviceUrl, token, user }) => {
        setCoreApiUrl(coreUrl)
        setServiceUrl(serviceUrl)
        setToken(token)
        setUser(user)
      },
    )

    tokenChannel.on('set', (newToken: string) => {
      setToken(newToken)
    })
  },
})
</script>

<style lang="scss">
$primary-color-500: #8f022c;

#micro-app {
  font-family: 'Inter', sans-serif;
  color: #303030;
  position: relative;
  padding: 24px;

  p {
    max-width: 100%;
    word-break: break-all;
  }

  a {
    color: $primary-color-500;
  }
}
</style>
