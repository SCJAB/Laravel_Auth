<template>
    <div class="bg-red-700 h-screen">
        <div>
            <form @submit.prevent="submitForm()">
                <div>
                    <label for="email_address">Email Address</label>
                    <div>
                        <input type="email" name="email" placeholder="email address" v-model="state.user.email">
                        <p>
                            {{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.email && state.errors._data.errors.email[0] }}
                        </p>
                    </div>
                </div>
                <div>
                    <label for="password">Password</label>
                    <div>
                        <input type="password" name="password" placeholder="password" v-model="state.user.password">
                        <p>
                            {{ state.errors && state.errors._data && state.errors._data.errors && state.errors._data.errors.password && state.errors._data.errors.password[0] }}
                        </p>
                    </div>
                </div>
                <div>
                    <button type="submit">Log in</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
const state = reactive({
    errors: null,
    isPageLoading: false,
    user: {
        email: null,
        password: null,
    }
})

async function submitForm(){
    const params = {
        email: state.user.email,
        password: state.user.password,
    } 
    try {
        const response = await $fetch (`http://127.0.0.1:8000/api/auth/login`, {
            method: 'POST',
            body: params
        })

        if (response.data) {
            localstorage.setItem('_token', response.data.token)
            navigateTo('/users')
        }
    } catch (error) {
        state.errors = error.response
        console.log('error', error)
    }
}
</script>

<style scoped>

</style> 