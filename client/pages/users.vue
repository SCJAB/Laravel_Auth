<template>
    <div>
        <div>
            {{ state.user }}
        </div>
    </div>
</template>

<script setup>
const state = reactive({
    user: null,
})

onMounted(() => {
    fetchUser()
})

async function fetchUser() {
    try {
        const response = await $fetch (`http://127.0.0.1:8000/api/user`, {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('_token')
            }
        })

        if (response.data) {
            state.user = response.data
        }
    } catch (error) {
        state.errors = error.response
        console.log('error', error)
    }
}
</script>

<style scoped>

</style>